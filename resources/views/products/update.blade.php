@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $product->name }}" class="form-control mb-2">

        <textarea name="description" class="form-control mb-2">{{ $product->description }}</textarea>

        <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="form-control mb-2">

        <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control mb-2">

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection