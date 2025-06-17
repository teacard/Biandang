<?php

use App\Http\Controllers\Front\ShopCartController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'FrontUser', 'prefix' => '/shopcart'], function () {
    Route::get('/list', [ShopCartController::class, 'list']);
    Route::post('/add', [ShopCartController::class, 'add']);
    Route::post('/update', [ShopCartController::class, 'update']);
    Route::post('/delete', [ShopCartController::class, 'delete']);
});