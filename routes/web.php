<?php

use Illuminate\Support\Facades\Route;
// página de inicio
use App\Http\Controllers\HomeController;
// control de usuarios
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\EmpleadoController;

// paginas del sistema ...
// ...

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
/*
Route::get(
    '/empleado',
    function () {
        return view('empleado.index');
    }
);

Route::get(
    '/empleado/create',
    [EmpleadoController::class,'create']
);
*/
// cambiamos por resource
Route::resource('empleado', EmpleadoController::class);
// si quisieramos con autenticacion usamos...
// Route::resource('empleado', EmpleadoController::class)->middleware('auth');

Auth::routes();
// eliminar opciones en la pantalla de login
// Auth::routes(['register'=>false,'reset'=>false]);

Route::group(['middleware'=>['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
});
