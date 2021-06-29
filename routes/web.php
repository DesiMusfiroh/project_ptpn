<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WilayahController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']],function(){
    Route::group(['prefix' => 'admin'],function(){
        Route::group(['prefix' => 'sales'],function(){
            Route::get('/', [SalesController::class, 'indexAdmin'])->name('sales');
            Route::post('/store',  [SalesController::class, 'store'])->name('sales.store');
            Route::patch('/update', [SalesController::class, 'update'])->name('sales.update');
            Route::post('/delete', [SalesController::class, 'delete'])->name('sales.delete');
            Route::post('/import', [SalesController::class, 'import'])->name('sales.import');
        });
    
        Route::group(['prefix' => 'wilayah'],function(){
            Route::get('/', [WilayahController::class, 'indexAdmin'])->name('wilayah');
            Route::post('/store',  [WilayahController::class, 'store'])->name('wilayah.store');
            Route::patch('/update', [WilayahController::class, 'update'])->name('wilayah.update');
            Route::post('/delete', [WilayahController::class, 'delete'])->name('wilayah.delete');
            Route::post('/import', [WilayahController::class, 'import'])->name('wilayah.import');
        });
        
        Route::group(['prefix' => 'penjualan'],function(){
            Route::get('/', [PenjualanController::class, 'indexAdmin']);
            Route::post('/import/store', [PenjualanController::class, 'import'])->name('penjualan.import');
            Route::get('/export', [PenjualanController::class, 'export']);
        });
        Route::get('/penjualan_import', [PenjualanController::class, 'importForm']);
        
    });
});