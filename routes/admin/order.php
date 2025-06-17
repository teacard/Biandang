<?php

use App\Http\Controllers\Admin\Order\AdminOrderController;
use App\Http\Controllers\Admin\Product\AdminProductController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'manager', 'prefix' => '/admin/order'], function () {
    Route::get('list', [AdminOrderController::class, 'list']);
    Route::get('add', [AdminOrderController::class, 'add']);
    Route::post('update', [AdminOrderController::class, 'update']);
    Route::post('delete', [AdminOrderController::class, 'delete']);
});
