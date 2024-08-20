@extends('layout.master')

@section('title', 'Cart')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-10 d-flex justify-content-end mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
    </div>
</div>
<div class="container mt-5">
    <h2 class="mb-4">Shopping Cart</h2>
    @if(count($cartItems) > 0)
        <div class="row">
            @php $grandTotal = 0; @endphp
            @foreach($cartItems as $item)
                @php
                    $totalPrice = $item->quantity * $item->product->price;
                    $grandTotal += $totalPrice;
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text">Quantity: {{ $item->quantity }}</p>
                            <p class="card-text">Price: ₹{{ number_format($item->product->price, 2) }}</p>
                            <p class="card-text">Total: ₹{{ number_format($totalPrice, 2) }}</p>
                            <form action="{{ route('cart.remove', $item->product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Invoice</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₹{{ number_format($item->product->price, 2) }}</td>
                                        <td>₹{{ number_format($item->quantity * $item->product->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Grand Total</th>
                                    <th>₹{{ number_format($grandTotal, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
