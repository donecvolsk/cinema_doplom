<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SessionSeatController;

Route::group(['prefix' => 'api'], function () {
    Route::resource('films', 'App\Http\Controllers\FilmsController');
    Route::resource('sessions', 'App\Http\Controllers\SessionsController');
    Route::post('tickets', 'App\Http\Controllers\TicketsController@store');
    Route::get('/images/{filename}', [ImageController::class, 'show']); //получить линк ссылку на картинку к фильму
    Route::get('/sessions/hall-seats/{sessionId}', [SessionsController::class, 'getHallSeats']);//получить все кресла в зале по сессии
    Route::get('/seat-types-by-id', [SessionsController::class, 'getSeatTypesById']);//получить типы кресел по id
    Route::resource('/session-seats', SessionSeatController::class);//получить кресла в зале по шаблону
    Route::get('/session-seats-by-session-id', [SessionsController::class, 'getSessionSeatsBySessionId']);//получить занятые кресла в зале
});

