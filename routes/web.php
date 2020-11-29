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

Auth::routes(['register' => false]);
Route::get('/registro/email', 'UserController@emailVerify');
Route::post('/entrar', 'AuthController@login')->name('login.custom');
Route::post('/registro', 'AuthController@register')->name('register.custom');
Route::post('/recuperar', 'AuthController@recovery')->name('recovery.custom');
Route::post('/salir', 'AuthController@logout')->name('logout.custom');
Route::post('/recuperar', 'AuthController@recovery')->name('recovery.custom');
Route::post('/restaurar', 'AuthController@reset')->name('reset.custom');

Route::group(['middleware' => ['session_verify']], function () {
	Route::get('/restaurar/{slug}', 'AuthController@resetForm')->name('restaurar');
	
	// ///////////////////////////////////////////// WEB ////////////////////////////////////////////////
	Route::get('/', 'WebController@index')->name('home');
	Route::get('/buscar', 'WebController@search')->name('search');
	Route::get('/noticias/{category?}', 'WebController@news')->name('news');
	Route::get('/noticias/{category}/{slug}', 'WebController@new')->name('new');
	Route::get('/videos', 'WebController@videos')->name('videos');
	Route::get('/galeria/{category?}', 'WebController@galleries')->name('galleries');
	Route::get('/liga/{tournament}/calendario', 'WebController@calendar')->name('calendar');
	Route::post('/goles', 'WebController@goals')->name('goals');
	Route::get('/liga/{tournament}/clasificacion', 'WebController@classification')->name('classification');
	Route::get('/liga/{tournament}/equipos', 'WebController@teams')->name('teams');
	Route::get('/liga/{tournament}/equipos/{team}/jugadores', 'WebController@players')->name('players');
	Route::get('/liga/{tournament}/goleadores', 'WebController@scorers')->name('scorers');

	// Comentarios
	Route::post('/admin/comentarios', 'CommentController@store')->name('comentarios.store');

	// Goles
	Route::post('/admin/goles', 'WebController@goal')->name('goles.store');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
	///// //////////////////////////////////ADMIN ///////////////////////////////////////////////////

	// Inicio
	Route::get('/admin', 'AdminController@index')->name('admin');
	Route::get('/admin/perfil', 'AdminController@profile')->name('profile');
	Route::get('/admin/perfil/editar', 'AdminController@profileEdit')->name('profile.edit');
	Route::put('/admin/perfil/', 'AdminController@profileUpdate')->name('profile.update');
});

Route::group(['middleware' => ['auth', 'superadmin']], function () {
	// Administradores
	Route::get('/admin/administradores', 'AdministratorController@index')->name('administradores.index');
	Route::get('/admin/administradores/registrar', 'AdministratorController@create')->name('administradores.create');
	Route::post('/admin/administradores', 'AdministratorController@store')->name('administradores.store');
	Route::get('/admin/administradores/{slug}', 'AdministratorController@show')->name('administradores.show');
	Route::get('/admin/administradores/{slug}/editar', 'AdministratorController@edit')->name('administradores.edit');
	Route::put('/admin/administradores/{slug}', 'AdministratorController@update')->name('administradores.update');
	Route::put('/admin/administradores/{slug}/activar', 'AdministratorController@activate')->name('administradores.activate');
	Route::put('/admin/administradores/{slug}/desactivar', 'AdministratorController@deactivate')->name('administradores.deactivate');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
	// Usuarios
	Route::get('/admin/usuarios', 'UserController@index')->name('usuarios.index');
	Route::get('/admin/usuarios/{slug}', 'UserController@show')->name('usuarios.show');
	Route::delete('/admin/usuarios/{slug}', 'UserController@destroy')->name('usuarios.delete');
	Route::put('/admin/usuarios/{slug}/activar', 'UserController@activate')->name('usuarios.activate');
	Route::put('/admin/usuarios/{slug}/desactivar', 'UserController@deactivate')->name('usuarios.deactivate');

	// Categorías de Noticias
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
	Route::put('/admin/noticias/{slug}/activar', 'NewController@activate')->name('noticias.activate');
	Route::put('/admin/noticias/{slug}/desactivar', 'NewController@deactivate')->name('noticias.deactivate');

	//Visitas
	Route::get('/admin/visitas', 'VisitController@index')->name('visitas.index');
	Route::post('/admin/visitas', 'VisitController@data')->name('visitas.data');

	// Comentarios
	Route::get('/admin/comentarios', 'CommentController@index')->name('comentarios.index');
	Route::delete('/admin/comentarios/{slug}', 'CommentController@destroy')->name('comentarios.delete');
	Route::put('/admin/comentarios/{slug}/activar', 'CommentController@activate')->name('comentarios.activate');
	Route::put('/admin/comentarios/{slug}/desactivar', 'CommentController@deactivate')->name('comentarios.deactivate');
	Route::put('/admin/comentarios/usuarios/{slug}/activar', 'CommentController@userActivate')->name('comentarios.usuarios.activate');
	Route::put('/admin/comentarios/usuarios/{slug}/desactivar', 'CommentController@userDeactivate')->name('comentarios.usuarios.deactivate');

	// Videos
	Route::get('/admin/videos', 'VideoController@index')->name('videos.index');
	Route::get('/admin/videos/registrar', 'VideoController@create')->name('videos.create');
	Route::post('/admin/videos', 'VideoController@store')->name('videos.store');
	Route::get('/admin/videos/{slug}/editar', 'VideoController@edit')->name('videos.edit');
	Route::put('/admin/videos/{slug}', 'VideoController@update')->name('videos.update');
	Route::delete('/admin/videos/{slug}', 'VideoController@destroy')->name('videos.delete');
	Route::put('/admin/videos/{slug}/activar', 'VideoController@activate')->name('videos.activate');
	Route::put('/admin/videos/{slug}/desactivar', 'VideoController@deactivate')->name('videos.deactivate');

	// Categorias de Galeria
	Route::get('/admin/galeria/categorias', 'CategoryGalleryController@index')->name('galerias.categorias.index');
	Route::get('/admin/galeria/categorias/registrar', 'CategoryGalleryController@create')->name('galerias.categorias.create');
	Route::post('/admin/galeria/categorias', 'CategoryGalleryController@store')->name('galerias.categorias.store');
	Route::get('/admin/galeria/categorias/{slug}/editar', 'CategoryGalleryController@edit')->name('galerias.categorias.edit');
	Route::put('/admin/galeria/categorias/{slug}', 'CategoryGalleryController@update')->name('galerias.categorias.update');
	Route::delete('/admin/galeria/categorias/{slug}', 'CategoryGalleryController@destroy')->name('galerias.categorias.delete');

	// Galerias
	Route::get('/admin/galeria', 'GalleryController@index')->name('galerias.index');
	Route::get('/admin/galeria/registrar', 'GalleryController@create')->name('galerias.create');
	Route::post('/admin/galeria', 'GalleryController@store')->name('galerias.store');
	Route::get('/admin/galeria/{slug}/editar', 'GalleryController@edit')->name('galerias.edit');
	Route::put('/admin/galeria/{slug}', 'GalleryController@update')->name('galerias.update');
	Route::delete('/admin/galeria/{slug}', 'GalleryController@destroy')->name('galerias.delete');
	Route::put('/admin/galeria/{slug}/activar', 'GalleryController@activate')->name('galerias.activate');
	Route::put('/admin/galeria/{slug}/desactivar', 'GalleryController@deactivate')->name('galerias.deactivate');
});

Route::group(['middleware' => ['auth', 'superadmin']], function () {
	// Banners
	Route::get('/admin/banners', 'BannerController@index')->name('banners.index');
	Route::get('/admin/banners/registrar', 'BannerController@create')->name('banners.create');
	Route::post('/admin/banners', 'BannerController@store')->name('banners.store');
	Route::get('/admin/banners/{slug}/editar', 'BannerController@edit')->name('banners.edit');
	Route::put('/admin/banners/{slug}', 'BannerController@update')->name('banners.update');
	Route::delete('/admin/banners/{slug}', 'BannerController@destroy')->name('banners.delete');
	Route::put('/admin/banners/{slug}/activar', 'BannerController@activate')->name('banners.activate');
	Route::put('/admin/banners/{slug}/desactivar', 'BannerController@deactivate')->name('banners.deactivate');

	// Banners de Noticias
	Route::get('/admin/banners/noticias', 'BannerNewController@index')->name('banners.noticias.index');
	Route::get('/admin/banners/noticias/registrar', 'BannerNewController@create')->name('banners.noticias.create');
	Route::post('/admin/banners/noticias', 'BannerNewController@store')->name('banners.noticias.store');
	Route::get('/admin/banners/noticias/{slug}/editar', 'BannerNewController@edit')->name('banners.noticias.edit');
	Route::put('/admin/banners/noticias/{slug}', 'BannerNewController@update')->name('banners.noticias.update');
	Route::delete('/admin/banners/noticias/{slug}', 'BannerNewController@destroy')->name('banners.noticias.delete');
	Route::put('/admin/banners/noticias/{slug}/activar', 'BannerNewController@activate')->name('banners.noticias.activate');
	Route::put('/admin/banners/noticias/{slug}/desactivar', 'BannerNewController@deactivate')->name('banners.noticias.deactivate');

	// Torneos
	Route::get('/admin/ligas', 'TournamentController@index')->name('torneos.index');
	Route::get('/admin/ligas/registrar', 'TournamentController@create')->name('torneos.create');
	Route::post('/admin/ligas', 'TournamentController@store')->name('torneos.store');
	Route::get('/admin/ligas/{slug}/editar', 'TournamentController@edit')->name('torneos.edit');
	Route::put('/admin/ligas/{slug}', 'TournamentController@update')->name('torneos.update');
	Route::delete('/admin/ligas/{slug}', 'TournamentController@destroy')->name('torneos.delete');
	Route::put('/admin/ligas/{slug}/subir', 'TournamentController@up')->name('torneos.up');
	Route::put('/admin/ligas/{slug}/bajar', 'TournamentController@down')->name('torneos.down');

	// Equipos
	Route::get('/admin/ligas/{tournament}/equipos', 'TeamController@index')->name('equipos.index');
	Route::get('/admin/ligas/{tournament}/equipos/registrar', 'TeamController@create')->name('equipos.create');
	Route::post('/admin/ligas/{tournament}/equipos', 'TeamController@store')->name('equipos.store');
	Route::get('/admin/ligas/{tournament}/equipos/{slug}/editar', 'TeamController@edit')->name('equipos.edit');
	Route::put('/admin/ligas/{tournament}/equipos/{slug}', 'TeamController@update')->name('equipos.update');
	Route::delete('/admin/ligas/{tournament}/equipos/{slug}', 'TeamController@destroy')->name('equipos.delete');

	// Jugadores
	Route::get('/admin/ligas/{tournament}/equipos/{team}/jugadores', 'PlayerController@index')->name('jugadores.index');
	Route::get('/admin/ligas/{tournament}/equipos/{team}/jugadores/registrar', 'PlayerController@create')->name('jugadores.create');
	Route::post('/admin/ligas/{tournament}/equipos/{team}/jugadores', 'PlayerController@store')->name('jugadores.store');
	Route::get('/admin/ligas/{tournament}/equipos/{team}/jugadores/{slug}/editar', 'PlayerController@edit')->name('jugadores.edit');
	Route::put('/admin/ligas/{tournament}/equipos/{team}/jugadores/{slug}', 'PlayerController@update')->name('jugadores.update');
	Route::delete('/admin/ligas/{tournament}/equipos/{team}/jugadores/{slug}', 'PlayerController@destroy')->name('jugadores.delete');

	// Jornadas
	Route::get('/admin/ligas/{tournament}/jornadas/registrar', 'DayController@index')->name('jornadas.index');

	// Partidos
	Route::post('/admin/partidos', 'MatchController@store')->name('partidos.store');
	Route::post('/admin/partidos/estado', 'MatchController@matchState')->name('partidos.state');
	Route::delete('/admin/partidos/{slug}', 'MatchController@destroy')->name('partidos.delete');

	// Resultados
	Route::get('/admin/ligas/{tournament}/resultados/registrar', 'MatchController@index')->name('resultados.index');
	Route::post('/admin/resultados', 'MatchController@goals')->name('resultados.goals');
	Route::post('/admin/resultados/estado', 'MatchController@state')->name('resultados.state');
	Route::post('/admin/resultados/equipos', 'MatchController@teams')->name('resultados.teams');
	Route::post('/admin/resultados/goleadores', 'MatchController@players')->name('resultados.players');
	Route::get('/admin/ligas/{tournament}/resultados/clasificacion', 'MatchController@classification')->name('resultados.classification');

	// Colores
	Route::put('/admin/ligas/{tournament}/colores', 'MatchController@colors')->name('resultados.colors');
	
	// Estadios
	Route::get('/admin/estadios', 'StadiumController@index')->name('estadios.index');
	Route::get('/admin/estadios/registrar', 'StadiumController@create')->name('estadios.create');
	Route::post('/admin/estadios', 'StadiumController@store')->name('estadios.store');
	Route::get('/admin/estadios/{slug}/editar', 'StadiumController@edit')->name('estadios.edit');
	Route::put('/admin/estadios/{slug}', 'StadiumController@update')->name('estadios.update');
	Route::delete('/admin/estadios/{slug}', 'StadiumController@destroy')->name('estadios.delete');

	// Ajustes
	Route::get('/admin/resultados-en-directo', 'SettingController@results')->name('resultados.result');
	Route::get('/admin/ajustes', 'SettingController@edit')->name('ajustes.edit');
	Route::put('/admin/ajustes', 'SettingController@update')->name('ajustes.update');
});