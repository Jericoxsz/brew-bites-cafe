<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::count();

        $orders = Order::count();

        $customers = User::where('role','customer')->count();


        $sales = Order::where('status','Completed')
            ->sum('total_amount');


        $completedOrders = Order::where('status','Completed')
            ->count();



        $todaySales = Order::where('status','Completed')
            ->whereDate('created_at', today())
            ->sum('total_amount');



        // Low stock (may laman pa pero konti na)
        $lowStock = Product::where('stock','>',0)
            ->where('stock','<=',5)
            ->get();


        $lowStockCount = $lowStock->count();



        // Wala nang stock
        $outOfStock = Product::where('stock',0)
            ->get();


        $outOfStockCount = $outOfStock->count();



        $topProduct = OrderItem::whereHas('order', function($query){

                $query->where('status','Completed');

            })
            ->selectRaw('product_id, SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product')
            ->first();



        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();



        return view('admin.dashboard', compact(
            'products',
            'orders',
            'customers',
            'sales',
            'completedOrders',
            'todaySales',
            'lowStock',
            'lowStockCount',
            'outOfStock',
            'outOfStockCount',
            'topProduct',
            'recentOrders'
        ));
    }
}