<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MenuController;

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

Route::get('/', function () {
    return view('auth.login');
});

//Route::get('/pedido/create',[PedidoController::class,'create']);

Route::resource('producto', ProductoController::class)->middleware('auth');
Route::resource('pedido', PedidoController::class)->middleware('auth');
Route::resource('menu', MenuController::class)->middleware('auth');
Auth::routes([/*'register'=>false,'reset'=>false*/]);

Route::get('/home', [MenuController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/', [MenuController::class,'index'])->name('home');
});

