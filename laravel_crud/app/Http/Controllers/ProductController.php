<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::simplePaginate(2);
        return view('products.list', compact('products'));
    }

    public function home()
    {
        $products=Product::all();
        return view('home',compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('img')) {
            Log::info('Image file detected.');
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            Log::info('Image uploaded successfully', ['imageName' => $imageName]);
        }

        $product = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName
        ]);

        if ($product) {
            Log::info('Product created successfully', ['product' => $product]);
        } else {
            Log::error('Failed to create product');
        }

        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.details', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.create', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $imageName = $product->image;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            Log::info('Image uploaded successfully', ['imageName' => $imageName]);

            if (File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }
        }

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName
        ]);

        if ($product) {
            Log::info('Product updated successfully', ['product' => $product]);
            return redirect()->route('products.index')
                             ->with('success', 'Product updated successfully.');
        } else {
            Log::error('Failed to update product');
            return redirect()->back()
                             ->with('error', 'Failed to update product.');
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
            File::delete(public_path('uploads/products/' . $product->image));
        }

        if ($product->delete()) {
            Log::info('Product deleted successfully', ['product' => $product]);
            return redirect()->route('products.index')
                             ->with('success', 'Product deleted successfully.');
        } else {
            Log::error('Failed to delete product');
            return redirect()->route('products.index')
                             ->with('error', 'Failed to delete product.');
        }
    }
}
