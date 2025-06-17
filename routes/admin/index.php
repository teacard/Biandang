<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/home', [AdminController::class, 'home'])->middleware('manager');
Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/cklogin', [AdminController::class, 'cklogin']);
Route::get('/admin/logout', [AdminController::class, 'logout']);

require "products.php";
require "order.php";