<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', 'ContactController@index')->name('contacts');
Route::get('/contacts/create', 'ContactController@create')->name('contacts.create');
Route::get('/contacts/{contact}/edit', 'ContactController@create')->name('contacts.edit');
Route::post('/contacts/create', 'ContactController@store')->name('contacts.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
