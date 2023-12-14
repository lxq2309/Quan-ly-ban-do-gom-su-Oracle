<?php

use App\Http\Controllers\user\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/product/search/{searchText}', [\App\Http\Controllers\admin\ProductController::class, 'searchProduct']);
Route::get('/product/{id}', [\App\Http\Controllers\admin\ProductController::class, 'getById']);
