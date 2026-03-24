@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add to Cart</h2>

    <h4>{{ $product->name }}</h4>

    <form action="{{ route('cart.store', $product->id) }}" method="POST">
        @csrf

        <input type="number" name="quantity" class="form-control mb-3" placeholder="Enter quantity">

        <button class="btn btn-success">Add to Cart</button>
    </form>
</div>
@endsection