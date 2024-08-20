@extends('layout.master')

@section('title')
    @if(isset($product->id))
        Update Product
    @else
        Create Product
    @endif
@endsection

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end mb-4">
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card border-0 shadow-lg mb-4">
            <div class="card-header bg-dark ">
              <h3 class="text-white">Create Product</h3>
            </div>
    @if(isset($product->id))
        <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="post">
            @method('PUT')
    @else
        <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="post">
    @endif
        @csrf
        @if(isset($product->id))
        @method('PUT')
        @endif
        <div class="card-body">
            <div class="mb-4">
                <label for="name" class="form-label h5">Name</label>
                <input value="{{ old('name', isset($product->id) ? $product->name : '') }}" type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Enter your name" name="name">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="category" class="form-label h5">Category</label>
                <input value="{{ old('category', isset($product->id) ? $product->category : '') }}" type="text" class="@error('category') is-invalid @enderror form-control form-control-lg" placeholder="Enter category" name="category">
                @error('category')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="price" class="form-label h5">Price</label>
                <input value="{{ old('price', isset($product->id) ? $product->price : '') }}" type="text" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Enter price" name="price">
                @error('price')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="form-label h5">Description</label>
                <textarea name="description" class="form-control" cols="30" rows="5" placeholder="Enter description">{{ old('description', isset($product->id) ? $product->description : '') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="img" class="form-label h5">Image</label>
                <input id="imgInput" type="file" class="form-control" placeholder="Upload image" name="img" accept="image/*">
                @if(isset($product->id))
                    @if ($product->image)
                        <img id="imgPreview" class="w-50 my-2" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                    @else
                        <img id="imgPreview" class="w-50 my-2" src="#" alt="No Image" style="display:none;">
                    @endif
                @else
                    <img id="imgPreview" class="w-50 my-2" src="#" alt="Image Preview" style="display:none;">
                @endif
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        document.getElementById('imgInput').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const imgPreview = document.getElementById('imgPreview');
                imgPreview.src = URL.createObjectURL(file);
                imgPreview.style.display = 'block';
            }
        });
    </script>
@endsection
