@extends('layout.master')
@section('title', 'Product List')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-10 d-flex justify-content-end mb-4">
        <a href="{{ route('products.create') }}" class="btn btn-dark ml-2" onclick="return confirmCreate();">Create</a>
        <a href="{{ route('cart.show') }}" class="btn btn-primary ml-2">View Cart</a> 
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-10">
        @if (Session::has('success'))
        <div class="alert alert-success px-md-5">
            {{ Session::get('success') }}
        </div>
        @endif
        <div class="card border-0 shadow-lg mb-4">
            <div class="card-header bg-dark">
                <h3 class="text-white">Product List</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if ($product->image)
                                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" width="200">
                                @else
                                No Image
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <div class="btn-group" role="group">      
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning" onclick="return confirmEdit();">Edit</a>
                                    <a href="#" onclick="return deleteProduct({{ $product->id }});" class="btn btn-danger">Delete</a>
                                    <form id="delete-product-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No Record Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmCreate() {
        return confirm("Are you sure you want to create a new product?");
    }

    function confirmEdit() {
        return confirm("Are you sure you want to edit this product?");
    }

    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete the product?")) {
            document.getElementById('delete-product-form-' + id).submit();
        }
        return false;
    }
</script>
@endsection
