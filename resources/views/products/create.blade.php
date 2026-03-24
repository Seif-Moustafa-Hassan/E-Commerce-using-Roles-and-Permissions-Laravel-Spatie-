@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">Add Product</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <input type="text" name="name" class="form-control mb-2" placeholder="Name">

        <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>

        <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price">

        <input type="number" name="quantity" class="form-control mb-2" placeholder="Quantity">

        <button class="btn btn-success">Create</button>
    </form>
</div>
@endsection