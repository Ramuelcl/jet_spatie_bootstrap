<?php

use Illuminate\Support\Facades\Route;
// página de inicio
use App\Http\Controllers\HomeController;
// control de usuarios
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware'=>['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
});
