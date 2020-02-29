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
// routes/web.php
Route::namespace('\App\Sections\Leads\Controllers')->prefix('leads')->group(function () {
    Route::get('/', 'LeadController@index')->name('leads.index');
    Route::get('scope', 'LeadController@scope')->name('leads.scope');
    Route::post('/', 'LeadController@store')->name('leads.store');
    Route::patch('/{id}', 'LeadController@update')->name('leads.update');
});

Route::get('/', function () {
    return view('welcome');
});

AwesAuth::routes();
