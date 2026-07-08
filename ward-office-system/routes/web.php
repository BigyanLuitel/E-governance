<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\controllers\DocumentRequestController;
use App\Http\Controllers\OfficerRequestController;
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



Route::middleware(['auth', 'role:officer'])->group(function () {
    Route::get('/officer/requests', [OfficerRequestController::class, 'index'])->name('officer.requests.index');
    Route::get('/officer/requests/{documentRequest}', [OfficerRequestController::class, 'show'])->name('officer.requests.show');
    Route::patch('/officer/requests/{documentRequest}', [OfficerRequestController::class, 'update'])->name('officer.requests.update');
});

Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
