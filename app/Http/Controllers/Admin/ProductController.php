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
            ->when($request->search, fn($q)=>$q->where('name','like','%'.$request->search.'%'))
            ->when($request->category, fn($q)=>$q->where('category_id',$request->category))
            ->when($request->sort=='price_low', fn($q)=>$q->orderBy('price','asc'))
            ->when($request->sort=='price_high', fn($q)=>$q->orderBy('price','desc'))
            ->when($request->sort=='stock', fn($q)=>$q->orderBy('stock','asc'))
            ->when(!$request->sort, fn($q)=>$q->latest())
            ->get();

        return view('admin.products.index',compact('products','categories'));
    }


    public function create()
    {
        $categories=Category::all();

        return view('admin.products.create',compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id'=>'required|exists:categories,id',
            'name'=>'required|string|max:255',
            'price'=>'required|numeric|min:0',
            'stock'=>'required|integer|min:0',
        ]);


        $image=null;


        if($request->cropped_image){

            $imageData=explode(',',$request->cropped_image);

            if(isset($imageData[1])){

                $image='products/'.uniqid().'.jpg';

                Storage::disk('public')->put(
                    $image,
                    base64_decode($imageData[1])
                );
            }
        }


        Product::create([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'description'=>$request->description ?? '',
            'price'=>$request->price,
            'stock'=>$request->stock,
            'image'=>$image,
        ]);


        return redirect('/admin/products')
            ->with('success','Product added successfully');
    }



    public function edit(Product $product)
    {
        $categories=Category::all();

        return view('admin.products.edit',compact(
            'product',
            'categories'
        ));
    }



    public function update(Request $request, Product $product)
    {

        $request->validate([
            'category_id'=>'required|exists:categories,id',
            'name'=>'required|string|max:255',
            'price'=>'required|numeric|min:0',
            'stock'=>'required|integer|min:0',
        ]);


        $image=$product->image;


        if($request->cropped_image){

            if($product->image){
                Storage::disk('public')->delete($product->image);
            }


            $imageData=explode(',',$request->cropped_image);


            if(isset($imageData[1])){

                $image='products/'.uniqid().'.jpg';

                Storage::disk('public')->put(
                    $image,
                    base64_decode($imageData[1])
                );
            }
        }


        $product->update([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'description'=>$request->description ?? '',
            'price'=>$request->price,
            'stock'=>$request->stock,
            'image'=>$image,
        ]);


        return redirect('/admin/products')
            ->with('success','Product updated successfully');
    }



    public function destroy(Product $product)
    {

        if($product->image){
            Storage::disk('public')->delete($product->image);
        }


        $product->delete();


        return redirect('/admin/products')
            ->with('success','Product deleted successfully');
    }
}