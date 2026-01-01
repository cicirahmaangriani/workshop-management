<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Landing page - Welcome
Route::get('/', function () {
    return view('welcome');
});

// Dashboard - All authenticated users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// ADMIN & RECEPTIONIST ROUTES
// ==========================================
Route::middleware(['auth', 'role:admin,receptionist'])->group(function () {
    // Customers
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');

    // Vehicles
    Route::get('vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');

    // Services - Create ONLY (Mechanic tidak bisa create)
    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('services.store');

    // Invoices
    Route::get('invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::get('invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');
});

// ==========================================
// ADMIN ONLY ROUTES
// ==========================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Delete operations
    Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::delete('vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    Route::delete('mechanics/{mechanic}', [MechanicController::class, 'destroy'])->name('mechanics.destroy');
    Route::delete('spare-parts/{sparePart}', [SparePartController::class, 'destroy'])->name('spare-parts.destroy');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

    // User Management (Admin only)
    Route::resource('users', UserController::class);

    // Mechanics - Full CRUD
    Route::get('mechanics/create', [MechanicController::class, 'create'])->name('mechanics.create');
    Route::post('mechanics', [MechanicController::class, 'store'])->name('mechanics.store');
    Route::get('mechanics/{mechanic}/edit', [MechanicController::class, 'edit'])->name('mechanics.edit');
    Route::put('mechanics/{mechanic}', [MechanicController::class, 'update'])->name('mechanics.update');

    // Spare Parts - Full CRUD
    Route::get('spare-parts/create', [SparePartController::class, 'create'])->name('spare-parts.create');
    Route::post('spare-parts', [SparePartController::class, 'store'])->name('spare-parts.store');
    Route::get('spare-parts/{sparePart}/edit', [SparePartController::class, 'edit'])->name('spare-parts.edit');
    Route::put('spare-parts/{sparePart}', [SparePartController::class, 'update'])->name('spare-parts.update');
});

// ==========================================
// ALL ROLES - READ & UPDATE ACCESS
// ==========================================
Route::middleware(['auth', 'role:admin,receptionist,mechanic'])->group(function () {
    // Customers - View only for mechanic
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');

    // Vehicles - View only for mechanic
    Route::get('vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');

    // Mechanics - View only
    Route::get('mechanics', [MechanicController::class, 'index'])->name('mechanics.index');
    Route::get('mechanics/{mechanic}', [MechanicController::class, 'show'])->name('mechanics.show');

    // Spare Parts - View only for mechanic
    Route::get('spare-parts', [SparePartController::class, 'index'])->name('spare-parts.index');
    Route::get('spare-parts/{sparePart}', [SparePartController::class, 'show'])->name('spare-parts.show');

    // Services - All can view and edit (authorization handled in controller)
    Route::get('services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');

    // Invoices - View only for mechanic
    Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
});

require __DIR__.'/auth.php';