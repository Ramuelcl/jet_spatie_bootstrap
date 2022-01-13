<?php

use Illuminate\Support\Facades\Auth;
// página de inicio
use Illuminate\Support\Facades\Route;
// control de usuarios
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\UsuarioController;

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

Route::get('/contact', function () {
    return view('contact.contact');
})->name('contact');

Route::get('/faker', function () {
    return view('pags.faker');
})->name('faker');

Route::get('/iconos', function () {
    return view('pags.iconos');
})->name('iconos');

Route::get('/bootstrap', function () {
    return view('pags.bootstrap');
})->name('bootstrap');


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

Route::resource('blog', BlogController::class);

Auth::routes();
// eliminar opciones en la pantalla de login
// Auth::routes(['register'=>false,'reset'=>false]);

Route::group(['middleware'=>['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
});
