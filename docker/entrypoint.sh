#!/bin/sh
set -e
cd /var/www/html

# Render / Railway memberi port lewat variabel PORT
PORT="${PORT:-80}"
sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Mode SQLite: pastikan file database ada
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
  DB_FILE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
  mkdir -p "$(dirname "$DB_FILE")"
  touch "$DB_FILE"
  chown www-data:www-data "$DB_FILE" "$(dirname "$DB_FILE")"
fi

php artisan config:clear
php artisan migrate --force

# Isi data contoh (project, sertifikat, foto) HANYA kalau RUN_SEED=true.
# Nyalakan sekali di deploy pertama, lalu hapus/ubah jadi false.
if [ "${RUN_SEED:-false}" = "true" ]; then
  php artisan db:seed --force || echo "Seeder gagal/duplikat, dilewati."
fi

# Buat/ubah akun admin kalau ADMIN_EMAIL & ADMIN_PASSWORD diisi
php /usr/local/bin/create-admin.php || echo "Gagal membuat admin."

php artisan storage:link 2>/dev/null || true
php artisan optimize || true

chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null || true
exec apache2-foreground
