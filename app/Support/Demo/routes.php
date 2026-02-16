<?php

use App\Support\Demo\Http\Controllers\ApexChartsController;
use Illuminate\Support\Facades\Route;

// Demo Routes
Route::prefix('demo')->name('demo.')->group(function (): void {
    Route::get('/components', function () {
        return view('demo.components');
    })->name('components');

    // Alpine subpage
    Route::get('/components/alpine', function () {
        return view('demo.components.alpine');
    })->name('components.alpine');

    // Forms subpage
    Route::get('/components/forms', function () {
        return view('demo.components.forms');
    })->name('components.forms');

    // Diagrams subpage
    Route::get('/components/diagrams', function () {
        return view('demo.components.diagrams');
    })->name('components.diagrams');

    // Echarts subpage
    Route::get('/components/echarts', function () {
        return view('demo.components.echarts');
    })->name('components.echarts');

    // Tabulator subpage
    Route::get('/components/tabulator', function () {
        return view('demo.components.tabulator');
    })->name('components.tabulator');

    // ApexCharts subpage
    Route::get('/components/apexcharts', [ApexChartsController::class, 'index'])
        ->name('components.apexcharts');

    // Layouts demos
    Route::prefix('layouts')->name('layouts.')->group(function (): void {
        Route::get('/', function () {
            return view('demo.layouts.index');
        })->name('index');

        Route::get('/single-column', function () {
            return view('demo.layouts.single-column');
        })->name('single-column');

        Route::get('/two-columns', function () {
            return view('demo.layouts.two-columns');
        })->name('two-columns');

        Route::get('/three-columns', function () {
            return view('demo.layouts.three-columns');
        })->name('three-columns');

        Route::get('/grid', function () {
            return view('demo.layouts.grid');
        })->name('grid');

        Route::get('/dashboard', function () {
            return view('demo.layouts.dashboard');
        })->name('dashboard');

        Route::get('/list-detail', function () {
            return view('demo.layouts.list-detail');
        })->name('list-detail');
    });
});

Route::get('/demo/components/tabler', function () {
    return view('demo.components.tabler');
})->name('demo.components.tabler');
