@extends('layouts.master')

@section('content')
<div class="col-md-12">
  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="col p-4 d-flex flex-column position-static">
      <strong class="d-inline-block mb-2 text-primary">World</strong>
      <h5 class="mb-0">{{$produit->title}}</h5>
      <div class="mb-1 text-muted">{{$produit->created_at->format('d/m/y')}}</div>
      <p class="card-text mb-auto">{{$produit->description}}.</p>
      <strong class="md-auto">{{$produit->getPrice()}}</strong>
      <form action="{{route('cart.store')}}" method="post">
        @csrf
        <input type="hidden" name="produit_id" value="{{$produit->id}}">
        <button type="submit" class="btn btn-dark">Ajouter au panier</button>
      </form>
    </div>
    <div class="col-auto d-none d-lg-block">
      <img src="{{$produit->image}}"/>
  </div>
</div>
</div>
@endsection