<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;

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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/shimpents',[ShipmentController::class,"index"]);

Route::get('/',[ShipmentController::class,"index"]);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('shipments',ShipmentController::class)->except(['index']);
    Route::get('shimpents/getprice/{weight}', [ShipmentController::class,"getPrice"]);
    Route::get('shimpents/setStatus/{id}/{status}', [ShipmentController::class,"setStatus"]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
