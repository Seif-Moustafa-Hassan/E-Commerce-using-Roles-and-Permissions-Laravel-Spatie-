@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">My Cart</h2>

    @foreach($cartItems as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $item->product->name }}</h5>
                <p>Quantity: {{ $item->quantity }}</p>
                <p>Price: ${{ $item->product->price }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection