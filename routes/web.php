<?php

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

use Gloudemans\Shoppingcart\Facades\Cart;

Route::get('/', function () {
    return view('welcome');
});
//La route des produits
Route::get('/boutique', 'ProduitController@index')->name('produit.index');
Route::get('/boutique/{slug}', 'ProduitController@show')->name('produit.show');

//Route de la cart

Route::post('/panier/ajouter', 'CartController@store')->name('cart.store');


Route::get('/videpanier', function() {
    Cart::destroy();
});
