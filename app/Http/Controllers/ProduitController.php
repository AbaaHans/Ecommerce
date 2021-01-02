<?php

namespace App\Http\Controllers;

use App\Produit;
use Facade\FlareClient\View;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        
        $produits = Produit::inRandomOrder()->take(6)->get();
        return View('produit.index')->with('produits' , $produits);
    }

    public function show($slug)
    {
        $produit = Produit::where('slug', $slug)->firstOrFail();
        return View('produit.show')->with('produit' , $produit);
    }
}
