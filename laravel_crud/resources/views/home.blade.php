@extends('layout.master')
@section('title','Home')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Home</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        @forelse ($products as $product)
                        <div class="card mx-2 my-2" style="width: 18rem;">
                            <div class="card-body">
                                @if ($product->image)
                                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid card-img-top">
                                @else
                                <img src="{{ asset('no-image.png') }}" alt="No Image" class="img-fluid card-img-top">
                                @endif
                                <h4 class="mt-2">{{ $product->name }}</h4>
                                <p><strong>Category:</strong> {{ $product->category }}</p>
                                <p><strong>Price:</strong> ₹{{ $product->price }}</p>
                                <p><strong>Description:</strong> {{ Str::limit($product->description, 50) }}</p>
                            </div>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">View</a>
                        </div>
                        @empty
                        <h2>No Record Found</h2>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
