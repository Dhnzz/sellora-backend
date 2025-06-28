<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ProductGroupController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('me', [AuthController::class, 'me'])->name('me');
        Route::get('permissions', [AuthController::class, 'getPermissions'])->name('getPermissions');
    });

    Route::prefix('user')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('active_users', [UserController::class, 'getActiveUser'])->name('active_user');
    });

    // CRUD
    // Admin CRUD
    Route::prefix('admin')->group(function () {
        Route::get('get_admin', [AdminController::class, 'index'])->middleware('permission:view-admin')->name('admin.index');
        Route::get('show_admin/{id}', [AdminController::class, 'show'])->name('admin.show');
        Route::post('create_admin', [AdminController::class, 'store'])->name('admin.store');
        Route::put('update_admin/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('destroy_admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });

    Route::prefix('product_group')->group(function () {
        Route::get('product_groups', [ProductGroupController::class, 'index'])->middleware('permission:view-product-group')->name('product_groups');
        Route::get('product_groups/{productGroup}', [ProductGroupController::class, 'show'])->name('product_groups.show');
        Route::post('product_groups', [ProductGroupController::class, 'store'])->name('product_groups.store');
        Route::put('product_groups/{productGroup}', [ProductGroupController::class, 'update'])->name('product_groups.update');
        Route::delete('product_groups/{productGroup}', [ProductGroupController::class, 'destroy'])->name('product_groups.destroy');
    });
});
