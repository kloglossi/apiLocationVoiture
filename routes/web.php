<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('api/agence','AgenceController')->middleware('cors');
Route::resource('api/client','ClientController')->middleware('cors');
Route::resource('api/contrat','ContratController')->middleware('cors');
Route::resource('api/facture','FactureController')->middleware('cors');
Route::resource('api/vehicule','VehiculeController')->middleware('cors');
Route::resource('api/retourVoiture','retourVoitureController')->middleware('cors');
Route::get('api/login','ClientController@login')->name('login')->middleware('cors');
Route::post('api/login_in','ClientController@login_in')->name('login_in')->middleware('cors');
Route::get('api/test','vehiculeController@test');