<?php

namespace App\Http\Controllers;

use App\Produit;
use Gloudemans \ Shoppingcart \ Facades \ Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $duplicate = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->produit_id;
        });

        if ($duplicate->isNotEmpty()) {
            return redirect()->route('produit.index')->with('success','le produit a déjà en  été  ajouter.');

        }
        $produit = Produit::find($request->produit_id);

        Cart::add($produit->id, $produit->title, 1, $produit->price)
        ->associate('App\Produit');
        return redirect()->route('produit.index')->with('success','le produit a bien  été  ajouter.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return back()->with('success', 'le produit a été supprimé.');
    }
}
