<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\controllers\DocumentRequestController;
use App\Http\Controllers\OfficerRequestController;
use App\Http\Controllers\Admin\WardOfficeController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\RequestOversightController;



use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/citizen/dashboard', [DashboardController::class, 'citizen'])
    ->middleware(['auth', 'role:citizen'])
    ->name('citizen.dashboard');
Route::middleware(['auth', 'role:citizen'])->group(function () {
    Route::get('/requests/create', [DocumentRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests/store', [DocumentRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{documentRequest}', [DocumentRequestController::class, 'show'])->name('requests.show');
});
Route::get('/officer/dashboard', [DashboardController::class, 'officer'])
    ->middleware(['auth', 'role:officer'])
    ->name('officer.dashboard');



Route::middleware(['auth', 'role:officer'])->group(function () {
    Route::get('/officer/requests', [OfficerRequestController::class, 'index'])->name('officer.requests.index');
    Route::get('/officer/requests/{documentRequest}', [OfficerRequestController::class, 'show'])->name('officer.requests.show');
    Route::patch('/officer/requests/{documentRequest}', [OfficerRequestController::class, 'update'])->name('officer.requests.update');
    Route::post('/officer/requests/{documentRequest}/issue-letter', [OfficerRequestController::class, 'issueLetter'])->name('officer.requests.issue-letter');
});

Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

use App\Http\Controllers\Admin\OfficerController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/officers', [OfficerController::class, 'index'])->name('officers.index');
    Route::get('/officers/create', [OfficerController::class, 'create'])->name('officers.create');
    Route::post('/officers', [OfficerController::class, 'store'])->name('officers.store');

    Route::get('/ward-offices', [WardOfficeController::class, 'index'])->name('ward-offices.index');
    Route::get('/ward-offices/create', [WardOfficeController::class, 'create'])->name('ward-offices.create');
    Route::post('/ward-offices', [WardOfficeController::class, 'store'])->name('ward-offices.store');


    Route::get('/document-types', [DocumentTypeController::class, 'index'])->name('document-types.index');
    Route::patch('/document-types/{documentType}/toggle', [DocumentTypeController::class, 'toggle'])->name('document-types.toggle');
    Route::get('/requests', [RequestOversightController::class, 'index'])->name('requests.index');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
