<?php

use App\Http\Controllers\ProductController;
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
| Rotas de clientes adiiconadas
*/
Route::get('teste', 'ProductController@teste');
Auth::routes(['verify' => true]);

Route::get('products/list', 'FrontController@products');
Route::get('products/list/2', 'FrontController@products2');


Route::get('/', 'SiteController@index');
Route::get('produto/{slug}', 'SiteController@produto');
Route::get('categoria/{slug}', 'SiteController@categoria');

// Pages
Route::get('sobre/{page}', 'SiteController@sobre');
Route::get('contato/{page}', 'SiteController@contato');

// Consulta Endereço
Route::post('cep/{cep?}', 'SiteController@cepConsulta');

// Funções
Route::post('faleConosco', 'SiteController@faleConosco');

// Perfil
Route::prefix('perfil')->middleware(['auth', 'verified'])->group(function () {
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

Route::prefix('admin')->group(function () {
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
    Route::get('imageDestroy/{id}', 'ImagensController@destroy');

    // Catalogos
    Route::prefix('catalogos')->group(function () {
        Route::get('produtos', 'PainelController@produtos');
        Route::get('categorias', 'PainelController@categorias');

        // Categorias
        Route::get('categorieIndex/{id?}', 'CategorieController@index');
        Route::post('categorieStore', 'CategorieController@store');
        Route::get('categorieDestroy/{id}', 'CategorieController@destroy');
        Route::post('categorieUpdate', 'CategorieController@update');

        // Produtos
        Route::get('productIndex/{id?}', 'ProductController@index');
        Route::post('productStore', 'ProductController@store');
        Route::get('productDestroy/{id}', 'ProductController@destroy');
        Route::post('productUpdate', 'ProductController@update');

        // Tags
        Route::prefix('tags')->group(function(){
            // Catalogo de cores
            Route::get('cores', 'PainelController@cores');
            Route::get('colorIndex', 'TagsController@colorIndex');
            Route::post('colorStore', 'TagsController@colorStore');
            Route::get('colorDestroy/{id}', 'TagsController@colorDestroy');
            Route::post('colorUpdate', 'TagsController@colorUpdate');

            // Marcas dos produtos
            Route::get('marcas', 'PainelController@marcas');
            Route::get('brandIndex', 'TagsController@brandIndex');
            Route::post('brandStore', 'TagsController@brandStore');
            Route::get('brandDestroy/{id}', 'TagsController@brandDestroy');
            Route::post('brandUpdate', 'TagsController@brandUpdate');

            // Familia dos produtos
            Route::get('familia', 'PainelController@familia');
            Route::get('familyIndex', 'TagsController@familyIndex');
            Route::post('familyStore', 'TagsController@familyStore');
            Route::get('familyDestroy/{id}', 'TagsController@familyDestroy');
            Route::post('familyUpdate', 'TagsController@familyUpdate');
        });
    });

    // Clientes
    Route:: prefix('clientes')->group(function(){
        Route::get('clientes', 'PainelController@clientes');

        Route::get('clienteIndex', 'CustomerController@clienteIndex');
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

Route::resource('calculadora', 'CalculatorController');