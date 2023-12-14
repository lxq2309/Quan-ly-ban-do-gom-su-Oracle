<?php

use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\ProductController;
use App\Http\Controllers\user\CategoryController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\user\AccountController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\user\CouponController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [\App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [\App\Http\Controllers\AdminAuthController::class, 'login']);

Route::group(['middleware' => 'admin'], function () {
Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin-dashboard');
Route::post('/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');
Route::post('/change-password', [\App\Http\Controllers\AdminController::class, 'changePassword'])->name('admin.change_password');
Route::resource('/color', \App\Http\Controllers\admin\ColorController::class);
Route::resource('/glaze', \App\Http\Controllers\admin\GlazeController::class);
Route::resource('/category', \App\Http\Controllers\admin\CategoryController::class);
Route::resource('/size', \App\Http\Controllers\admin\SizeController::class);
Route::resource('/job', \App\Http\Controllers\admin\JobController::class);
Route::resource('/country', \App\Http\Controllers\admin\CountryController::class);
Route::resource('/supplier', \App\Http\Controllers\admin\SupplierController::class);
Route::resource('/customer', \App\Http\Controllers\admin\CustomerController::class);
Route::resource('/employee', \App\Http\Controllers\admin\EmployeeController::class);
Route::resource('/product', \App\Http\Controllers\admin\ProductController::class);
Route::resource('/productset', \App\Http\Controllers\admin\ProductsetController::class);
Route::resource('/purchase-order', \App\Http\Controllers\admin\PurchaseOrderController::class);
Route::resource('/sales-invoice', \App\Http\Controllers\admin\SalesInvoiceController::class);
});
