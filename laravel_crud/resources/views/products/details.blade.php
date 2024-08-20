@extends('layout.master')

@section('title', 'Product Details')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Product Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if ($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                            @else
                            <img src="{{ asset('no-image.png') }}" alt="No Image" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $product->name }}</h4>
                            <p><strong>Category:</strong> {{ $product->category }}</p>
                            <p><strong>Price:</strong> ${{ $product->price }}</p>
                            <p><strong>Description:</strong> {{ $product->description }}</p>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
