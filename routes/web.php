<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Customer Routes
    Route::resource('customers', CustomerController::class);
    
    // Vehicle Routes
    Route::resource('vehicles', VehicleController::class);
    
    // Mechanic Routes
    Route::resource('mechanics', MechanicController::class);
    
    // Spare Part Routes
    Route::resource('spare-parts', SparePartController::class);
    
    // Service Routes
    Route::resource('services', ServiceController::class);
    
    // Invoice Routes
    Route::resource('invoices', InvoiceController::class);
    
    // Profile Routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes (from Breeze)
require __DIR__.'/auth.php';