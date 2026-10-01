<?php
// Membuat / memperbarui akun admin dari variabel ADMIN_EMAIL & ADMIN_PASSWORD.
require '/var/www/html/vendor/autoload.php';
$app = require '/var/www/html/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$email = getenv('ADMIN_EMAIL');
$pass  = getenv('ADMIN_PASSWORD');
if (!$email || !$pass) {
    echo "ADMIN_EMAIL/ADMIN_PASSWORD kosong, lewati pembuatan admin.\n";
    exit(0);
}

$user = App\Models\User::firstOrNew(['email' => $email]);
$user->forceFill([
    'name' => $user->name ?: 'Admin',
    'password' => $pass,            // di-hash otomatis oleh cast 'hashed'
    'email_verified_at' => now(),
])->save();
echo "Admin siap: {$email}\n";
