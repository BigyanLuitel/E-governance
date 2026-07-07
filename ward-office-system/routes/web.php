<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\controllers\DocumentRequestController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/citizen/dashboard', [DashboardController::class, 'citizen'])
    ->middleware(['auth', 'role:citizen'])
    ->name('citizen.dashboard');
Route::middleware(['auth', 'role:citizen'])->group(function () {
    Route::get('/requests/create', [DocumentRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests/store', [DocumentRequestController::class, 'store'])->name('requests.store');
});
Route::get('/officer/dashboard', [DashboardController::class, 'officer'])
    ->middleware(['auth', 'role:officer'])
    ->name('officer.dashboard');

Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
