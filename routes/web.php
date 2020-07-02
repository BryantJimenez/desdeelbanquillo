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
Route::get('/registro/email', 'UserController@emailVerify');

// ///////////////////////////////////////////// WEB ////////////////////////////////////////////////

// Inicio
Route::get('/', 'WebController@index')->name('home');
Route::get('/noticias', 'WebController@notices')->name('notices');
Route::get('/videos', 'WebController@videos')->name('videos');

Route::group(['middleware' => ['auth', 'admin']], function () {
	///// //////////////////////////////////ADMIN ///////////////////////////////////////////////////

	// Inicio
	Route::get('/admin', 'AdminController@index')->name('admin');

	// Administradores
	Route::get('/admin/administradores', 'AdministratorController@index')->name('administradores.index');
	Route::get('/admin/administradores/registrar', 'AdministratorController@create')->name('administradores.create');
	Route::post('/admin/administradores', 'AdministratorController@store')->name('administradores.store');
	Route::get('/admin/administradores/{slug}', 'AdministratorController@show')->name('administradores.show');
	Route::get('/admin/administradores/{slug}/editar', 'AdministratorController@edit')->name('administradores.edit');
	Route::put('/admin/administradores/{slug}', 'AdministratorController@update')->name('administradores.update');
	Route::put('/admin/administradores/{slug}/activar', 'AdministratorController@activate')->name('administradores.activate');
	Route::put('/admin/administradores/{slug}/desactivar', 'AdministratorController@deactivate')->name('administradores.deactivate');

	// Usuarios
	Route::get('/admin/usuarios', 'UserController@index')->name('usuarios.index');
	Route::get('/admin/usuarios/{slug}', 'UserController@show')->name('usuarios.show');
	Route::delete('/admin/usuarios/{slug}', 'UserController@destroy')->name('usuarios.delete');
	Route::put('/admin/usuarios/{slug}/activar', 'UserController@activate')->name('usuarios.activate');
	Route::put('/admin/usuarios/{slug}/desactivar', 'UserController@deactivate')->name('usuarios.deactivate');

	// Categorías
	Route::get('/admin/categorias', 'CategoryController@index')->name('categorias.index');
	Route::get('/admin/categorias/registrar', 'CategoryController@create')->name('categorias.create');
	Route::post('/admin/categorias', 'CategoryController@store')->name('categorias.store');
	Route::get('/admin/categorias/{slug}/editar', 'CategoryController@edit')->name('categorias.edit');
	Route::put('/admin/categorias/{slug}', 'CategoryController@update')->name('categorias.update');
	Route::delete('/admin/categorias/{slug}', 'CategoryController@destroy')->name('categorias.delete');

	// Noticias
	Route::get('/admin/noticias', 'NewController@index')->name('noticias.index');
	Route::get('/admin/noticias/registrar', 'NewController@create')->name('noticias.create');
	Route::post('/admin/noticias', 'NewController@store')->name('noticias.store');
	Route::get('/admin/noticias/{slug}/editar', 'NewController@edit')->name('noticias.edit');
	Route::put('/admin/noticias/{slug}', 'NewController@update')->name('noticias.update');
	Route::delete('/admin/noticias/{slug}', 'NewController@destroy')->name('noticias.delete');

	// Banners
	Route::get('/admin/banners', 'BannerController@index')->name('banners.index');
	Route::get('/admin/banners/registrar', 'BannerController@create')->name('banners.create');
	Route::post('/admin/banners', 'BannerController@store')->name('banners.store');
	Route::get('/admin/banners/{slug}/editar', 'BannerController@edit')->name('banners.edit');
	Route::put('/admin/banners/{slug}', 'BannerController@update')->name('banners.update');
	Route::delete('/admin/banners/{slug}', 'BannerController@destroy')->name('banners.delete');
	Route::put('/admin/banners/{slug}/activar', 'BannerController@activate')->name('banners.activate');
	Route::put('/admin/banners/{slug}/desactivar', 'BannerController@deactivate')->name('banners.deactivate');
});