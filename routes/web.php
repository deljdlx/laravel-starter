<?php

use Illuminate\Support\Facades\Route;
use ApiPlatform\GraphQL\Action\EntrypointAction;
use ApiPlatform\GraphQL\Action\GraphiQlAction;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/compteur', function () {
    return view('livewire.counter-page');
});

Route::get('/form', function () {
    return view('form');
});
