<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PesanController;
use App\Http\Middleware\CheckIsUser;
use App\Http\Middleware\CheckIsAdmin;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/Barang', [BarangController::class, 'index']);
    Route::get('/Barang/{id}', [BarangController::class, 'show']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/chatting', [PesanController::class, 'index']);
    


    Route::middleware([CheckIsAdmin::class])->group(function (){
        Route::post('/Barang', [BarangController::class, 'store']);
        Route::put('/Barang/{id}', [BarangController::class, 'update']);
        Route::delete('/Barang/{id}', [BarangController::class, 'destroy']);
        Route::put('/chatting/balas/{id}',[PesanController::class, 'update']);
    });

    Route::middleware([CheckIsUser::class])->group(function (){
        Route::post('/transaksi', [TransaksiController::class, 'store']);
        Route::put('/chatting',[PesanController::class, 'store']);
    });
});
