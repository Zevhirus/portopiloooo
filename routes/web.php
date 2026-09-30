<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home', [
    'featured' => Project::where('is_featured', true)->latest()->take(3)->get(),
]))->name('home');

Route::get('/about', fn () => Inertia::render('About'))->name('about');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/hasil-foto', [PhotoController::class, 'index'])->name('photos.index');

Route::get('/sertifikat', [CertificateController::class, 'index'])->name('certificates.index');

Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

// Bawaan Breeze
Route::get('/dashboard', fn () => Inertia::render('Dashboard'))
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('projects', Admin\ProjectController::class)->except('show');
    Route::get('messages', [Admin\MessageController::class, 'index'])->name('messages.index');
});

require __DIR__.'/auth.php';
