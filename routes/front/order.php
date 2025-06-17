<?php

use App\Http\Controllers\Front\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'FrontUser', 'prefix' => '/order'], function () {
    Route::get('/list', [OrderController::class, 'list']);
    Route::post('/add', [OrderController::class, 'add']);
    Route::post('/update', [OrderController::class, 'update']);
    Route::post('/delete', [OrderController::class, 'delete']);
});