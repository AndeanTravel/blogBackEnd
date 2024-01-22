<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use Laravel\Passport\Http\Controllers\AccessTokenController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//USERS
// Ruta para crear y guardar el formulario de creación de usuarios
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

// Ruta para mostrar un usuario específico
Route::get('/usuarios/{usuario}', [UserController::class, 'show'])->name('usuarios.show');

// Ruta para mostrar el formulario de edición de usuarios
Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');

// Ruta para procesar el formulario de edición de usuarios
Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');

// Ruta para eliminar un usuario
Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');

Route::post('/oauth/token', [AccessTokenController::class, 'issueToken']);
Route::delete('/oauth/token', [AccessTokenController::class, 'revokeToken']);

Route::post('/register', [RegisterController::class, 'register']);


//RUTAS PROTEGIDAS PARA AUTENTICACIÓN
/* Route::middleware('auth:api')->group(function () {
    // Rutas protegidas que requieren autenticación
    Route::get('/profile', 'UserController@profile');
}); */

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout']);
//->middleware('auth:api')

//COMENTARIOS
// Ruta para crear y guardar el formulario de creación de comentarios
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store')->middleware('auth:api');

// Ruta para procesar el formulario de edición de comentarios
Route::put('/comentarios/update', [ComentarioController::class, 'update'])->name('comentarios.update');

// Ruta para eliminar un comentario
Route::delete('/comentarios/delete', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');


Route::get('/prueba', function (Request $request) {
	return "Prueba realizada";
});

// PUBLICACIÓN
// Ruta para procesar el formulario de creación de publicaciones
Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');


/* Route::middleware('auth:api')->group(function () {
    Route::post('/publicaciones', [PublicacionController::class, 'store']);
}); */

Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
// Ruta para mostrar una publicación específica
//Route::get('/publicaciones/{id}', [PublicacionController::class, 'show'])->name('publicaciones.show');

// Ruta para mostrar el formulario de edición de publicaciones
//Route::get('/publicaciones/{id}/edit', [PublicacionController::class, 'edit'])->name('publicaciones.edit');

// Ruta para procesar el formulario de edición de publicaciones
Route::put('/publicaciones/update', [PublicacionController::class, 'update'])->name('publicaciones.update');

// Ruta para eliminar una publicación
Route::delete('/publicaciones/delete/{id}', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy');
