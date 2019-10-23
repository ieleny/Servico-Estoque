<?php

use App\Constants\RouteConstants;

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

Route::get(RouteConstants::BASE, function () {
    return view('welcome');
});

Route::GET(RouteConstants::ESTOQUES, 'EstoqueController@getById');
Route::POST(RouteConstants::ESTOQUE, 'EstoqueController@create');
