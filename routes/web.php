<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\EmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('site.index');

// });

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::post('/enviar', [SiteController::class, 'enviar'])->name('site.enviar');


Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/email', [EmailController::class, 'teste'])->name('login.teste');

Route::get('/escola', [EscolaController::class, 'index'])->name('escola.index');

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/', function(){
        return view('admin.dashboard');
    })->name('admin.dashboard.index');

    Route::prefix('clientes')->group(function () {
        Route::get('/create', [ClientesController::class, 'create'])->name('admin.clientes.create');
        Route::post('/store', [ClientesController::class, 'store'])->name('admin.clientes.store');
    });

});
