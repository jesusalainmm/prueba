<?php

use Illuminate\Support\Facades\Route;
Route::get('/cache', ['App\Http\Controllers\CacheController', 'index']);
Route::resource('/', App\Http\Controllers\HomeController::class)->names([
    'index' => 'home',
    'create' => 'home.create',
    'destroy' => 'home.destroy',
]);
Route::post('/store', ['App\Http\Controllers\HomeController', 'store'])->name('home.store');
Route::get('/edit/{id}', ['App\Http\Controllers\HomeController', 'edit'])->name('home.edit');
Route::post('/update/{id}', ['App\Http\Controllers\HomeController', 'update'])->name('home.update');

