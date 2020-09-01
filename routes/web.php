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


Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();


Route::resource('users','UserController');
Route::get('/', 'HomeController@index')->name('home');

Route::prefix('empleados')->group(function () {
    Route::get('biometria', 'EmpleadosController@step1')->name('biometria');
    Route::get('salud', 'EmpleadosController@salud')->name('salud');
    Route::get('personal', 'EmpleadosController@personal')->name('personal');
    Route::get('cargo', 'EmpleadosController@cargo')->name('cargo');
    Route::get('formacion', 'EmpleadosController@formacion')->name('formacion');


    Route::post('salud', 'EmpleadosController@ssalud')->name('empleados.ssalud');
    Route::post('personal', 'EmpleadosController@spersonal')->name('empleados.spersonal');




});


Route::get('datatable/users','UserController@anyUsers')->name('datatable.users');


