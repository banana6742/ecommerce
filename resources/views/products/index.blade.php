@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">Products</div>

    <div class="card-body">

        <table class="table">
            <thead>
                <th>Name</th>
                <th>Price</th>
                <th colspan=3>Action</th>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <a href="{{ route('products.show', ['id' => $product->id ]) }}" class="btn btn-primary btn-sm">View</a></td>
                        <td>
                            <a href="{{ route('products.edit', ['id' => $product->id ]) }}" class="btn btn-warning btn-smg">Edit</a>
                        </td>
                        <td>
                            <form action="{{route('products.destroy',['id' => $product->id])}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    

    </div>

@endsection