<?php

use App\Http\Controllers\Dev\ModelInspectorController;
use App\Http\Controllers\Dev\ModelBuilderController;
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
    Route::post('/model-builder', [ModelBuilderController::class, 'store'])->name('dev.model-builder.store');
});
