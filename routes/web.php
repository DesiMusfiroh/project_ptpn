<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ChangePasswordController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [WelcomeController::class, 'index']);

Auth::routes();

Route::group(['middleware' => ['auth']],function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/search', [HomeController::class, 'search'])->name('search');
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
        
        Route::group(['prefix' => 'faktur'],function(){
            Route::get('/', [FakturController::class, 'indexAdmin']);
            Route::patch('/update', [FakturController::class, 'update'])->name('faktur.update');
            Route::post('/delete', [FakturController::class, 'delete'])->name('faktur.delete');
            Route::post('/import/store', [FakturController::class, 'import'])->name('faktur.import');
            Route::get('/export', [FakturController::class, 'export']);
        });
        Route::get('/faktur_import', [FakturController::class, 'importForm']);
    });

    Route::get('change-password', [ChangePasswordController::class, 'index']);
    Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change.password');
});