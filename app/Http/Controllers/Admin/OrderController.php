<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items.product','user');

        if($request->search){

            $query->whereHas('user', function($q) use ($request){

                $q->where('name','like','%'.$request->search.'%');

            });

        }


        if($request->status){

            $query->where('status',$request->status);

        }


        if($request->sort == 'oldest'){

            $query->oldest();

        }else{

            $query->latest();

        }


        $orders = $query->get();


        $counts = [

            'total' => Order::count(),

            'pending' => Order::where('status','Pending')->count(),

            'preparing' => Order::where('status','Preparing')->count(),

            'completed' => Order::where('status','Completed')->count(),

            'cancelled' => Order::where('status','Cancelled')->count(),

        ];


        return view('admin.orders.index', compact(
            'orders',
            'counts'
        ));
    }


    public function show(Order $order)
    {
        $order->load('items.product','user');

        return view('admin.orders.show', compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status'=>'required|in:Pending,Preparing,Completed,Cancelled'
        ]);


        $oldStatus = $order->status;

        $newStatus = $request->status;


        // Deduct stock only when order becomes Completed
        if($oldStatus != 'Completed' && $newStatus == 'Completed'){

            foreach($order->items as $item){

                $product = $item->product;

                $product->stock -= $item->quantity;

                $product->save();

            }

        }


        $order->update([
            'status'=>$newStatus
        ]);


        return redirect('/admin/orders');
    }
}