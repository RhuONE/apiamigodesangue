<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Controllers
use App\Http\Controllers\HemocentroController;
use App\Http\Controllers\UsuarioController;

//AuthController
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


//Auth login hemocentro e adm
Route::post('/login', [AuthController::class, 'login']);

//Hemocentro
//Hemocentro Cadastro
Route::post('/hemocentro', [HemocentroController::class, 'store']);
//hemocentro Dados de Perfil
Route::middleware('auth:sanctum')->get('/hemocentro/perfil', [HemocentroController::class, 'show']);
//Hemocentro Update
Route::middleware('auth:sanctum')->put('/hemocentro/update', [HemocentroController::class, 'update']);
//Hemocentro "Delete"
Route::middleware('auth:sanctum')->put('/hemocentro/delete', [HemocentroController::class, 'delete']);

//Adm
//Cadastrar adm, rota apenas utilizada pelo o back para fins de desenvolvimento
Route::post('/adm', [UsuarioController::class, 'storeAdm']);
//Listar Hemocentros
Route::middleware('auth:sanctum')->get('/hemocentros', [HemocentroController::class, 'index']);
//Aceitar Hemocentro
Route::middleware('auth:sanctum')->put('/hemocentro/aceitar/{idHemocentro}', [HemocentroController::class, 'aceitar']);
//Arquivar Hemocentro
Route::middleware('auth:sanctum')->put('/hemocentro/arquivar/{idHemocentro}', [HemocentroController::class, 'arquivar']);


//Usuario Cadastro
Route::post('/usuario', [UsuarioController::class, 'store']);
//Usuario Login
Route::post('/usuario/login', [UsuarioController::class, 'login']);
//Usuario Perfil
Route::middleware('auth:sanctum')->get('/usuario/perfil', [UsuarioController::class, 'show']);
//Usuario Update
Route::middleware('auth:sanctum')->put('/usuario/update', [UsuarioController::class, 'update']);
//Usuario "Delete"
Route::middleware('auth:sanctum')->put('/usuario/delete', [UsuarioController::class, 'delete']);
