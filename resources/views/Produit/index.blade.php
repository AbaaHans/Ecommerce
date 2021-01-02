@extends('layouts.master')

@section('content')
  @foreach ($produits as $produit)
  <div class="col-md-6">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h5 class="mb-0">{{$produit->title}}</h5>
          <div class="mb-1 text-muted">{{$produit->created_at->format('d/m/y')}}</div>
          <p class="card-text mb-auto">{{$produit->subtitle}}.</p>
          <a href="{{route('produit.show', $produit->slug)}}" class="stretched-link btn btn-info">Voir article</a>
          <strong class="md-auto">{{$produit->getPrice()}}</strong>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="{{$produit->image}}"/>
      </div>
    </div>
  </div>
@endforeach
@endsection