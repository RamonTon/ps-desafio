<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;

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

Route::middleware('locale')->group(function () {

    Route::put('/locale', [LocaleController::class, 'setLocale'])->name('locale');

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Auth::routes();

    Route::middleware('auth')->group(function () {

        //Rota para dashboard
        Route::any('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //Rotas para log
        Route::any('log', [LogController::class, 'index'])->name('log.index');

        //Rotas para CRUD usuário
        Route::resource('user', UserController::class, ['except' => ['show']]);
        Route::resource('categoria', CategoriaController::class, ['except' => ['show']]);
        Route::resource('produto', ProdutoController::class);


        //Rotas para perfil do usuário
        Route::controller(ProfileController::class)->name('profile.')->group(function () {
            Route::get('profile', 'edit')->name('edit');
            Route::put('profile', 'update')->name('update');
            Route::put('profile/password', 'password')->name('password');
        });
    });
});

//Route::get('index',[SiteController::class, 'index'])->name('site.index');
//Route::get('categorias',[SiteController::class, 'categorias'])->name('site.categorias');
Route::get('produtos',[SiteController::class, 'index'])->name('site.produtos');
Route::get('Procura',[SiteController::class, 'Procura'])->name('Procura');

//Route::get('prod/{id}',[SiteController::class, 'produto'])->name('site.produto.unico');