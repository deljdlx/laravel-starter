<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Livewire\Counter;

Route::get('/compteur', function () {
    return view('livewire.counter-page');
});
