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
    Route::get('/', 'AgentesController@index')->name('agentes.index');
    Route::get('biometrico/{id}', 'EmpleadosController@biometrico')->name('biometrico');
    Route::get('salud/{id}', 'EmpleadosController@salud')->name('salud');
    Route::get('personal/{id}', 'EmpleadosController@personal')->name('personal');

    Route::get('revista/{id}', 'EmpleadosController@revista')->name('revista');
    Route::get('formacion/{id}', 'EmpleadosController@formacion')->name('formacion');


    Route::post('salud', 'EmpleadosController@ssalud')->name('empleados.ssalud');
    Route::post('salud/update', 'EmpleadosController@usalud')->name('empleados.usalud');


    Route::post('personal', 'EmpleadosController@spersonal')->name('empleados.spersonal');
    Route::post('personal/update', 'EmpleadosController@upersonal')->name('empleados.upersonal');

    Route::post('revista', 'EmpleadosController@srevista')->name('empleados.srevista');
    Route::post('revista/update', 'EmpleadosController@urevista')->name('empleados.urevista');


    Route::post('biometrico/{id}', 'EmpleadosController@sbiometrico')->name('empleados.sbiometrico');
    Route::post('biometrico/image/delete', 'EmpleadosController@removeImage')->name('empleados.removeImage');

    Route::get('formacion/delete/{id}', 'EmpleadosController@deleteCargo')->name('delete.formacion');


});

Route::get('datatable/agentes','AgentesController@agentes')->name('datatable.agentes');
Route::get('datatable/users','UserController@anyUsers')->name('datatable.users');


//dropzone
Route::post('dropzone/upload', 'DropzoneController@upload')->name('dropzone.upload');
Route::get('dropzone/fetch', 'DropzoneController@fetch')->name('dropzone.fetch');
Route::get('dropzone/delete', 'DropzoneController@delete')->name('dropzone.delete');
