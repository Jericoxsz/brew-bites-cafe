<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();


        $products = Product::with('category')

            ->when($request->search, function ($query) use ($request) {

                $query->where('name','like','%' . $request->search . '%');

            })


            ->when($request->category, function ($query) use ($request) {

                $query->where('category_id',$request->category);

            })


            ->when($request->sort == 'price_low', function ($query){

                $query->orderBy('price','asc');

            })


            ->when($request->sort == 'price_high', function ($query){

                $query->orderBy('price','desc');

            })


            ->when(!$request->sort, function ($query){

                $query->latest();

            })


            ->get();



        return view('products.index', compact(
            'products',
            'categories'
        ));
    }



   public function show(Product $product)
{
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->limit(3)
        ->get();


    return view('products.show', compact(
        'product',
        'relatedProducts'
    ));
}
}