<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryDriverController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderTypeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

// Redirect to appropriate dashboard based on role
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    return redirect()->route('employee.dashboard');
})->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('users', UserManagementController::class);
        
        // Original resources for admin
        Route::resource('governorates', GovernorateController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('delivery-drivers', DeliveryDriverController::class);
        Route::resource('order-types', OrderTypeController::class);
        Route::resource('orders', OrderController::class);
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    });

    // Employee Routes
    Route::middleware('role:employee')->group(function () {
        Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
        
        // Limited access to orders and customers
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update']);
        Route::resource('customers', CustomerController::class)->only(['index', 'show']);
    });
    
    // Shared resources for authenticated users
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
});

// Auth routes are included via Breeze
require __DIR__.'/auth.php';
