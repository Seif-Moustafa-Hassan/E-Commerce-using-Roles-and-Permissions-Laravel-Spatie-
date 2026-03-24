@foreach ($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                
                <p class="card-text text-muted">
                    {{ $product->description }}
                </p>

                <p class="card-text">
                    <strong>Price:</strong> ${{ $product->price }}
                </p>

                <p class="card-text">
                    <strong>Quantity:</strong> {{ $product->quantity }}
                </p>
            </div>

            <div class="card-footer text-center">
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">
                    View
                </a>

                @can('update-product')
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                @endcan

                @can('add-to-cart')
                    <a href="{{ route('cart.create', $product->id) }}" class="btn btn-success btn-sm">
                        Add to Cart
                    </a>
                @endcan

                @can('delete-product')
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endcan
            </div>

        </div>
    </div>
@endforeach