<?php

use App\Http\Controllers\Api\HistorialController;
use App\Http\Controllers\Api\InteraccionController;
use App\Http\Controllers\Api\PuntoController;
use App\Http\Controllers\Api\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Agrega un punto geografico donde estuvo el usuario
Route::post('/gps', [PuntoController::class, "store"]);
// Se muestra un punto donde un usuario haya interactuado con otro en un rango de 15 metros
Route::post('/interaccion',[InteraccionController::class, "getInteraccion"]);
// Muestra todos los puntos donde un usuario interactuo con otro
Route::post('/historial_interaccion',[InteraccionController::class, "historialInteraccion"]);
// Muestra todos los puntos que presentaron interacciones con otros usuarios
Route::post('/puntos_interacciones',[PuntoController::class, "interacciones"]);
// Muestra los puntos de un usuario en el dia
Route::post('/puntos_dia', HistorialController::class);

// Usuario 360


Route::post("/web-interaccion",[InteraccionController::class,"web_interaccion"]);
Route::post("/interaccion_dia",[InteraccionController::class,"interaccionDia"]);
// Para  consumir los puntos de la vista mapa
Route::get("/web-interaccion/{interaccion}",[InteraccionController::class,"interaccion"]);
Route::get('user360/{usuario_id}',UsuarioController::class);