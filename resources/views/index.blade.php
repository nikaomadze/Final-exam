@extends('master')

@section('title', 'Home')

@section('content')
    <h1>Products</h1>
    <div class="product-container">
        @foreach($products as $product)
            @include('product', $product)
        @endforeach
    </div>
    <div class="bottom-nav">
        {{ $products->links() }}
    </div>
@endsection