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


    //? ===========INICIAL============

    // TODO: USUARIOS
    
    route::put('usuario/cambiar/{id}','Usuario\UsuarioController@cambiarEstado')->name('usuario.cambiar');
    
    route::get('usuario/listar','Usuario\UsuarioController@listarUsuarios')->name('usuario.listar');
    route::resource('usuario', 'Usuario\UsuarioController');
    

    //? ===========USUARIOS============

    // TODO: CLIENTES
    
    route::get('cliente/listar','Cliente\ClienteController@listarClientes')->name('cliente.listar');
    route::resource('cliente', 'Cliente\ClienteController');
    

    //? ===========OPCIONES============

    // TODO: PISOS
        
    route::get('piso/listar','Piso\PisoController@listarPisos')->name('piso.listar');
    route::resource('piso', 'Piso\PisoController');

    // TODO: TIPOS
        
    route::get('tipo/listar','Tipo\TipoController@listarTipos')->name('tipo.listar');
    route::resource('tipo', 'Tipo\TipoController');


    //? ===========OTROS============

    // TODO: RESERVA
        
    route::get('reserva/listar','Reserva\ReservaController@listarReservas')->name('reserva.listar');
    route::resource('reserva', 'Reserva\ReservaController');

    // TODO: HABITACION
        
    route::get('habitacion/listar','Habitacion\HabitacionController@listarHabitaciones')->name('habitacion.listar');
    route::resource('habitacion', 'Habitacion\HabitacionController');

});