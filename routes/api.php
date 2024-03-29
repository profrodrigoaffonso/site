<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\ComandosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('cep', [SiteController::class, 'cep']);
Route::post('contagem-link', [SiteController::class, 'contagemLink']);

Route::get('atual', [ComandosController::class, 'atual']);
Route::post('financas', [ComandosController::class, 'financas']);
Route::post('alterar', [ComandosController::class, 'alterarComando']);
