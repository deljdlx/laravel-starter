<?php

use App\Support\DevTools\Http\Controllers\ModelBuilderController;
use App\Support\DevTools\Http\Controllers\ModelInspectorController;
use App\Support\DevTools\Http\Controllers\SchemaEditorController;
use App\Support\DevTools\Http\Controllers\SchemaMermaidController;
use Illuminate\Support\Facades\Route;

// Developer Tools Routes
Route::prefix('dev')->group(function (): void {
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
