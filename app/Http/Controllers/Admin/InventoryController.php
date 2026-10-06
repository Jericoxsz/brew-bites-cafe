<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\OrderItem;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->get();


        $sales = OrderItem::whereHas('order', function($query){

                $query->where('status','Completed');

            })
            ->selectRaw('product_id, SUM(quantity) as total_sold, SUM(quantity * price) as revenue')
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total_sold')
            ->get();



        $totalRevenue = OrderItem::whereHas('order', function($query){

                $query->where('status','Completed');

            })
            ->sum(\DB::raw('quantity * price'));



        return view('admin.inventory.index', compact(
            'products',
            'sales',
            'totalRevenue'
        ));
    }
}