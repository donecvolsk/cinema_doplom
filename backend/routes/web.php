<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;


Route::group(['prefix' => 'api'], function () {
    Route::resource('films', 'App\Http\Controllers\FilmsController');
    Route::resource('sessions', 'App\Http\Controllers\SessionsController');
    Route::post('tickets', 'App\Http\Controllers\TicketsController@store');
    Route::get('/images/{filename}', [ImageController::class, 'show']);
});

