<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// // --- ROUTE UNTUK JOBS ---

// // SEMUA ORANG bisa lihat daftar dan detail lowongan (TANPA auth)
// Route::get('/jobs', [JobListingController::class, 'index'])->name('jobs.index');
// Route::get('/jobs/{job}', [JobListingController::class, 'show'])->name('jobs.show');

// // Hanya ADMIN yang bisa membuat, edit, hapus lowongan
// Route::middleware(['auth', 'isAdmin'])->group(function () {
//     Route::get('/jobs/create', [JobListingController::class, 'create'])->name('jobs.create');
//     Route::post('/jobs', [JobListingController::class, 'store'])->name('jobs.store');
//     Route::get('/jobs/{job}/edit', [JobListingController::class, 'edit'])->name('jobs.edit');
//     Route::put('/jobs/{job}', [JobListingController::class, 'update'])->name('jobs.update');
//     Route::delete('/jobs/{job}', [JobListingController::class, 'destroy'])->name('jobs.destroy');
// });

// // --- ROUTE UNTUK APPLICATIONS (LAMARAN) ---

// // User melamar pekerjaan (harus login)
// Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
//     ->name('applications.store')
//     ->middleware('auth');

// // Admin melihat daftar pelamar
// Route::get('/applications', [ApplicationController::class, 'index'])
//     ->name('applications.index')
//     ->middleware(['auth', 'isAdmin']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== JOBS ROUTES =====

// 1. CREATE harus didefinisikan SEBELUM {job} parameter
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/jobs/create', [JobListingController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobListingController::class, 'store'])->name('jobs.store');
});

// 2. Lalu route lainnya
Route::get('/jobs', [JobListingController::class, 'index'])->name('jobs.index');

// 3. EDIT/DELETE (admin only)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/jobs/{job}/edit', [JobListingController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobListingController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobListingController::class, 'destroy'])->name('jobs.destroy');
});

// 4. SHOW detail lowongan (semua bisa akses)
Route::get('/jobs/{job}', [JobListingController::class, 'show'])->name('jobs.show');

// ===== APPLICATIONS =====
Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
    ->name('applications.store')
    ->middleware('auth');

// Route::get('/applications', [ApplicationController::class, 'index'])
//     ->name('applications.index')
//     ->middleware(['auth', 'isAdmin']);

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])
        ->name('applications.index');
    
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])
        ->name('applications.update');
});

// Untuk user biasa melihat lamaran mereka
Route::get('/my-applications', [ApplicationController::class, 'myApplications'])
    ->name('applications.my')
    ->middleware('auth');


Route::get('/applications/export', [ApplicationController::class, 'export'])->name('applications.export')->middleware('isAdmin');
Route::post('/jobs/import', [JobListingController::class, 'import'])->name('jobs.import')->middleware('isAdmin');
Route::get('/applications/{id}/download-cv', [ApplicationController::class, 'downloadCV'])->name('download.cv')->middleware('isAdmin');

// require __DIR__.'/auth.php';
require __DIR__.'/auth.php';