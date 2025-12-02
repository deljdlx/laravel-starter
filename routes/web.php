<?php

use App\Http\Controllers\Dev\ModelInspectorController;
use App\Http\Controllers\Dev\ModelBuilderController;
use App\Http\Controllers\Dev\SchemaMermaidController;
use App\Http\Controllers\Dev\SchemaEditorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReteJsDemoController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/compteur', function () {
    return view('livewire.counter-page');
});

Route::get('/form', function () {
    return view('form');
});

Route::get('/retejs-demo', [ReteJsDemoController::class, 'index'])->name('retejs.demo');

// Developer Tools Routes
Route::prefix('dev')->group(function () {
    // Model Inspector UI
    Route::get('/models', function () {
        return view('dev.models.index');
    })->name('dev.models.index');

    // Model Inspector API
    Route::get('/api/models', [ModelInspectorController::class, 'index'])->name('dev.api.models.index');
    Route::get('/api/models/{model}', [ModelInspectorController::class, 'show'])->name('dev.api.models.show');
    
    // Model Builder
    Route::get('/model-builder', [ModelBuilderController::class, 'show'])->name('dev.model-builder.index');
    Route::post('/model-builder/preview', [ModelBuilderController::class, 'preview'])->name('dev.model-builder.preview');
    Route::post('/model-builder', [ModelBuilderController::class, 'store'])->name('dev.model-builder.store');
    
    // Schema Mermaid Diagram
    Route::get('/schema-mermaid', [SchemaMermaidController::class, 'show'])->name('dev.schema-mermaid.index');
    
    // Schema Editor
    Route::get('/schema-editor', [SchemaEditorController::class, 'index'])->name('dev.schema-editor.index');
});

// Permissions Management Routes
Route::prefix('permissions')->name('permissions.')->group(function () {
    // UI
    Route::get('/', function () {
        return view('permissions.index');
    })->name('index');

    // API Routes for Roles
    Route::prefix('api/roles')->name('api.roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('show');
        Route::put('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    });

    // API Routes for Permissions
    Route::prefix('api/permissions')->name('api.permissions.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::post('/', [PermissionController::class, 'store'])->name('store');
        Route::get('/{permission}', [PermissionController::class, 'show'])->name('show');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('update');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
    });
});
