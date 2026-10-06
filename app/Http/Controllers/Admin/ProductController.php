<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with('category')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->when($request->sort == 'price_low', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($request->sort == 'price_high', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($request->sort == 'stock', function ($query) {
                $query->orderBy('stock', 'asc');
            })
            ->when(!$request->sort, function ($query) {
                $query->latest();
            })
            ->get();

        return view('admin.products.index', compact(
            'products',
            'categories'
        ));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $image = null;

        if ($request->cropped_image) {

            $imageData = explode(',', $request->cropped_image);

            $image = 'products/'.uniqid().'.jpg';

            Storage::disk('public')->put(
                $image,
                base64_decode($imageData[1])
            );
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description ?? '',
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image,
        ]);

        return redirect('/admin/products');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $image = $product->image;

        if ($request->cropped_image) {

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imageData = explode(',', $request->cropped_image);

            $image = 'products/'.uniqid().'.jpg';

            Storage::disk('public')->put(
                $image,
                base64_decode($imageData[1])
            );
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description ?? '',
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image,
        ]);

        return redirect('/admin/products');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect('/admin/products');
    }
}