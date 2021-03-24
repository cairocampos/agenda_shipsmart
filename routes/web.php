<?php

use App\Http\Controllers\ContatosController;
use App\Http\Controllers\EstadosController;
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
    return view('index');
});

Route::get('/estados', [EstadosController::class, 'index']);

Route::apiResource("contatos", ContatosController::class);
