<?php

use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'login']);
Route::post('/login', [FrontController::class, 'cklogin']);
Route::get('/register', [FrontController::class, 'register']);
Route::post('/ckregister', [FrontController::class, 'ckregister']);
Route::get('/succ', [FrontController::class, 'success']);
Route::get('/logout', [FrontController::class, 'logout']);

Route::get('/home', [FrontController::class, 'index'])->middleware('FrontUser');

require "shopcart.php";
require "order.php";