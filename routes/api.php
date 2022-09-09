<?php

use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\RateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([], function () {

    Route::group(['prefix' => 'imdb'], function () {
        Route::get('movies', [MovieController::class, 'index']);
        Route::get('movie/{id}', [MovieController::class, 'show']);
    });

    Route::apiResource('movie-rates', RateController::class)->only([
        'show', 'store'
    ]);
});
