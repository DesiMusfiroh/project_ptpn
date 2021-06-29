<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SalesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin/sales', [SalesController::class, 'indexAdmin']);
Route::post('/admin/sales/store',  [SalesController::class, 'store']);
Route::patch('/admin/sales/update', [SalesController::class, 'update']);
Route::post('/admin/sales/delete', [SalesController::class, 'delete']);
Route::post('/admin/sales/import', [SalesController::class, 'import'])->name('sales.import');

Route::get('/admin/penjualan', [PenjualanController::class, 'indexAdmin']);
Route::get('/admin/penjualan_import', [PenjualanController::class, 'importForm']);
Route::post('/admin/penjualan/import/store', [PenjualanController::class, 'import'])->name('penjualan.import');
Route::get('/admin/penjualan/export', [PenjualanController::class, 'export']);

Route::get('/template', function() {
    return view('layouts.master');
});