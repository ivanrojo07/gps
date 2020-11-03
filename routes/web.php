<?php

use App\Http\Controllers\Web\MapaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/mapa', function () {
    return view('mapa');
})->name('mapa');

Route::middleware(['auth:sanctum','verified'])->group(function(){
	Route::get('/mapa', [MapaController::class,"showMapa"])->name('mapa');

	Route::post('/mapa',[MapaController::class,"setPuntos"])->name('buscar_puntos');
});

