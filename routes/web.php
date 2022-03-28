<?php

use App\Http\Controllers\bankingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:bapi')->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});
Route::get('/', function () {
    return view('welcome');
});


Route::get('/cliente', [App\Http\Controllers\bankingController::class, 'index'])->name('clienteIndex');
Route::get('/cliente/nuevo', [App\Http\Controllers\bankingController::class, 'create'])->name('clienteNuevo');
Route::post('/cliente', [App\Http\Controllers\bankingController::class, 'store'])->name('clienteStore');
Route::get('/cliente/edit/{idCliente}', [App\Http\Controllers\bankingController::class, 'edit'])->name('clienteEdit');
Route::get('/cliente/{idCliente}', [App\Http\Controllers\bankingController::class, 'destroy'])->name('clienteDelete');
Route::put('/cliente/edit/{idCliente}', [App\Http\Controllers\bankingController::class, 'update'])->name('usersUpdate');

Auth::routes();

//Route::get('/login', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
