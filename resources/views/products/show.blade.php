@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">Product: {{$product->name }}</div>

    <div class="card-body">
                <div>Name:</div>{{ $product->name }}
                <div>Price: </div>{{ $product->price }}
                <div>Image: 
                <img src="{{$product->image}}" alt="{{$product->name}}" width="100px" height="60px">
                </div>
                <div>Description: {{ $product->Description }} </div>

          </div>
    </div>

@endsection