<?php


use Illuminate\Support\Facades\Route;


use App\Http\Controllers;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\FacturaController;
use App\Models\Producto;
use App\Models\Factura;
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

Route::get('/', 'App\Http\Controllers\FacturaController@index');

Route::get('/factura', 'App\Http\Controllers\FacturaController@index');

Route::get('/factura/crear', 'App\Http\Controllers\FacturaController@create');

Route::get('/factura/asignar', 'App\Http\Controllers\ItemController@create');

Route::get('/factura/detalle/{uuidFactura}','App\Http\Controllers\FacturaController@show');

Route::post('/item/crear', [ItemController::class, 'store']);

Route::post('/factura/crear', [FacturaController::class, 'store']);


