@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-center my-4">All Products</h2>

    <div class="row">
        <div class="row" id="products-container">
            @include('products.partials.products')
        </div>

        <div class="text-center my-4" id="loading" style="display: none;">
            <h5>Loading more products...</h5>
        </div>
    </div>
</div>


<script>
let page = 1;
let loading = false;
let lastPage = {{ $products->lastPage() }};

window.addEventListener('scroll', function () {
    if (loading) return;

    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {
        if (page < lastPage) {
            loadMoreProducts();
        }
    }
});

function loadMoreProducts() {
    loading = true;
    page++;

    document.getElementById('loading').style.display = 'block';

    fetch("?page=" + page, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('products-container').insertAdjacentHTML('beforeend', data);
        document.getElementById('loading').style.display = 'none';
        loading = false;
    })
    .catch(() => {
        loading = false;
    });
}
</script>

@endsection