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

/////////////////////////////////////// AUTH ////////////////////////////////////////////////////

Auth::routes();
// Route::get('/registro/email', 'UserController@emailVerify');

// ///////////////////////////////////////////// WEB ////////////////////////////////////////////////

// Inicio
Route::get('/', 'WebController@index')->name('home');
Route::get('/noticias', 'WebController@notices')->name('notices');
Route::get('/videos', 'WebController@videos')->name('videos');

Route::group(['middleware' => ['auth']], function () {
	///// //////////////////////////////////ADMIN ///////////////////////////////////////////////////

	// Inicio
	Route::get('/admin_panel/', 'AdminController@index')->name('admin');

	// Administradores
	Route::get('/admin_panel/administradores', 'AdministratorController@index')->name('administradores.index');
	Route::get('/admin_panel/administradores/registrar', 'AdministratorController@create')->name('administradores.create');
	Route::post('/admin_panel/administradores', 'AdministratorController@store')->name('administradores.store');
	Route::get('/admin_panel/administradores/{slug}', 'AdministratorController@show')->name('administradores.show');
	Route::get('/admin_panel/administradores/{slug}/editar', 'AdministratorController@edit')->name('administradores.edit');
	Route::put('/admin_panel/administradores/{slug}', 'AdministratorController@update')->name('administradores.update');
	Route::put('/admin_panel/administradores/activar/{slug}', 'AdministratorController@activate')->name('administradores.activate');
	Route::put('/admin_panel/administradores/desactivar/{slug}', 'AdministratorController@deactivate')->name('administradores.deactivate');
});