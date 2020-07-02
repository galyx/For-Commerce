<?php

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

Auth::routes();

Route::get('/', 'SiteController@index');
Route::get('/minhaconta', 'SiteController@minhaconta');
Route::get('/contato', 'SiteController@contato');
Route::get('/carrinho', 'SiteController@carrinho');
Route::get('/sobrenos', 'SiteController@sobrenos');

// Route::post('/pesquisa', 'SiteController@pesquisa')->name('pesquisa');

// Route::get('/categoria/{slug}', 'SiteController@categoria');
// Route::get('/categoria/produto/{slug}', 'SiteController@categoriaProduto');
// Route::get('/produto/{slug}', 'SiteController@produtoD');
// Route::get('/produtos-todos', 'SiteController@produtoall');

Route::prefix('admin')->group(function(){
    // Rotas de login para o administrador
    Route::get('login', 'Auth\LoginController@showAdminLoginForm');
    Route::get('register', 'Auth\RegisterController@showAdminRegisterForm');
    Route::post('login', 'Auth\LoginController@adminLogin');
    // Route::post('register', 'Auth\RegisterController@createAdmin');

    // Painel
    Route::get('', 'PainelController@index');
    Route::get('admins', 'PainelController@admins');
    Route::get('perfil', 'PainelController@perfil');

    // Admins Edits
    Route::get('adminIndex', 'AdminController@index');
    Route::post('adminStore', 'AdminController@store');
    Route::get('adminDestroy/{id}', 'AdminController@destroy');
    Route::post('adminPassword', 'AdminController@password');
    Route::post('adminUpdate', 'AdminController@update');
    // Perfil Edit
    Route::post('perfilUpdate', 'AdminController@perfilUpdate');
});