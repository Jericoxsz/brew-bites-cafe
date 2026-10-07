<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('admin.categories.index', compact('categories'));
    }


    public function products(Request $request, Category $category)
    {
        $products = $category->products()

            ->when($request->search, function($query) use ($request){
                $query->where('name','like','%'.$request->search.'%');
            })

            ->when($request->sort == 'price_low', function($query){
                $query->orderBy('price','asc');
            })

            ->when($request->sort == 'price_high', function($query){
                $query->orderBy('price','desc');
            })

            ->when($request->sort == 'stock', function($query){
                $query->orderBy('stock','asc');
            })

            ->get();


        return view('admin.categories.products', compact(
            'category',
            'products'
        ));
    }


    public function create()
    {
        return view('admin.categories.create');
    }



    public function store(Request $request)
    {
        $request->validate([

            'name'=>[
                'required',
                'string',
                'max:255',
                'unique:categories,name'
            ],

            'icon'=>[
                'required',
                'string',
                'max:10'
            ]

        ],[

            'name.required'=>'Category name is required.',
            'icon.required'=>'Please choose an icon.'

        ]);


        Category::create([

            'name'=>$request->name,

            'icon'=>$request->icon

        ]);


        return redirect('/admin/categories')
            ->with('success','Category added successfully.');
    }




    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }




    public function update(Request $request, Category $category)
    {
        $request->validate([

            'name'=>[
                'required',
                'string',
                'max:255',
                'unique:categories,name,'.$category->id
            ],

            'icon'=>[
                'required',
                'string',
                'max:10'
            ]

        ]);


        $category->update([

            'name'=>$request->name,

            'icon'=>$request->icon

        ]);


        return redirect('/admin/categories')
            ->with('success','Category updated successfully.');
    }




    public function destroy(Category $category)
    {

        if($category->products()->count() > 0){

            return redirect('/admin/categories')

                ->with(
                    'error',
                    'Cannot delete category with existing products.'
                );

        }


        $category->delete();


        return redirect('/admin/categories')

            ->with(
                'success',
                'Category deleted successfully.'
            );
    }
}