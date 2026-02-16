<?php

use App\Domain\Administration\Http\Controllers\AdminController;
use App\Domain\Administration\Http\Controllers\PermissionController;
use App\Domain\Administration\Http\Controllers\RoleController;
use App\Domain\Administration\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (): void {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Users Management Routes within Admin
    Route::prefix('users')->name('users.')->group(function (): void {
        // UI
        Route::get('/', function () {
            return view('users.index');
        })->name('index');

        // API Routes for Users (must be before /{user} wildcard)
        Route::prefix('api')->name('api.')->group(function (): void {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/search', [UserController::class, 'search'])->name('search');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}', [UserController::class, 'show'])->name('show');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::get('/{user}', [UserController::class, 'showView'])->name('show');
    });

    // Permissions Management Routes within Admin
    Route::prefix('permissions')->name('permissions.')->group(function (): void {
        // UI
        Route::get('/', function () {
            return view('permissions.index');
        })->name('index');

        // API Routes for Roles
        Route::prefix('api/roles')->name('api.roles.')->group(function (): void {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::post('/', [RoleController::class, 'store'])->name('store');
            Route::get('/{role}', [RoleController::class, 'show'])->name('show');
            Route::put('/{role}', [RoleController::class, 'update'])->name('update');
            Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
        });

        // API Routes for Permissions
        Route::prefix('api/permissions')->name('api.permissions.')->group(function (): void {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::post('/', [PermissionController::class, 'store'])->name('store');
            Route::get('/{permission}', [PermissionController::class, 'show'])->name('show');
            Route::put('/{permission}', [PermissionController::class, 'update'])->name('update');
            Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
        });

        // API Routes for Users in Permissions
        Route::prefix('api/users')->name('api.users.')->group(function (): void {
            Route::get('/', [PermissionController::class, 'users'])->name('index');
        });
    });
});
