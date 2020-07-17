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

Auth::routes(['verify' => true]);

Route::get('/', 'SiteController@index');
Route::get('produto/{slug}', 'SiteController@produto');
Route::get('categoria/{slug}', 'SiteController@categoria');

// Consulta Endereço
Route::post('cep/{cep?}', 'SiteController@cepConsulta');

// Perfil
Route::prefix('perfil')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/', 'SiteController@perfil');

    // Dsdos do Perfil
    Route::get('showPerfil', 'PerfilController@showPerfil');
    Route::post('editPerfil', 'PerfilController@editPerfil');

    // Senha do Perfil
    Route::get('showPerfilReset', 'PerfilController@showPerfilReset');
    Route::post('editPerfilReset', 'PerfilController@editPerfilReset');

    // Dados de Endereço
    Route::get('showAddress/{id?}', 'PerfilController@showAddress');
    Route::post('editAddress/{id}', 'PerfilController@editAddress');
    Route::post('createAddress', 'PerfilController@createAddress');
    Route::get('destroyAddress/{id}', 'PerfilController@destroyAddress');
});

// Pages
Route::get('sobre/{page}', 'SiteController@sobre');
Route::get('contato/{page}', 'SiteController@contato');

// Funções
Route::post('faleConosco', 'SiteController@faleConosco');

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
    Route::get('imagens', 'PainelController@imagens');

    // Imagens
    Route::get('imageIndex', 'ImagensController@index');
    Route::post('imageStore', 'ImagensController@store');
    // Route::get('imageDestroy', 'ImagensController@destoy');
    
    // Catalogos
    Route::prefix('catalogos')->group(function(){
        Route::get('categorias', 'PainelController@categorias');

        // Categorias
        Route::get('categorieIndex/{slug?}', 'CategorieController@index');
        Route::post('categorieStore', 'CategorieController@store');
        Route::get('categorieDestroy/{id}', 'CategorieController@destroy');
        Route::post('categorieUpdate', 'CategorieController@update');
    });

    // Admins Edits
    Route::get('adminIndex', 'AdminController@index');
    Route::post('adminStore', 'AdminController@store');
    Route::get('adminDestroy/{id}', 'AdminController@destroy');
    Route::post('adminPassword', 'AdminController@password');
    Route::post('adminUpdate', 'AdminController@update');
    // Perfil Edit
    Route::post('perfilUpdate', 'AdminController@perfilUpdate');
});