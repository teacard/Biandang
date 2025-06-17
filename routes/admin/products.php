<?php

use App\Http\Controllers\Admin\Product\AdminProductController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'manager', 'prefix' => '/admin/product'], function () {
    Route::get('list', [AdminProductController::class, 'list']);
    Route::get('add', [AdminProductController::class, 'add']);
    Route::post('insert', [AdminProductController::class, 'insert']);
    Route::get('edit/{id}', [AdminProductController::class, 'edit']);
    Route::post('update', [AdminProductController::class, 'update']);
    Route::post('delete', [AdminProductController::class, 'delete']);
});
