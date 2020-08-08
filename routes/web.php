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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['web']], function () {

    // TODO: USUARIOS
    
    route::get('usuario/listar','Usuario\UsuarioController@listarUsuarios')->name('usuario.listar');
    route::resource('usuario', 'Usuario\UsuarioController');
          
});