<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function showCheckout()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->with('items.product')
            ->first();


        if(!$cart || $cart->items->count() == 0){

            return redirect('/cart');

        }


        $total = 0;


        foreach($cart->items as $item){

            $total += $item->product->price * $item->quantity;

        }


        return view('orders.checkout', compact(
            'cart',
            'total'
        ));
    }



    public function checkout()
    {

        $cart = Cart::where('user_id', Auth::id())
            ->with('items.product')
            ->first();



        if(!$cart || $cart->items->count() == 0){

            return redirect('/cart');

        }



        $total = 0;


        foreach($cart->items as $item){

            $total += $item->product->price * $item->quantity;

        }




        $order = Order::create([

            'user_id'=>Auth::id(),

            'total_amount'=>$total,

            'status'=>'Pending',

            'order_date'=>now()

        ]);




        foreach($cart->items as $item){

            OrderItem::create([

                'order_id'=>$order->id,

                'product_id'=>$item->product_id,

                'quantity'=>$item->quantity,

                'price'=>$item->product->price

            ]);

        }




        $cart->items()->delete();



        return redirect('/order-success/'.$order->id);

    }




    public function index()
    {

        $orders = Order::where('user_id',Auth::id())
            ->with('items.product')
            ->latest()
            ->get();


        return view('orders.index', compact('orders'));

    }




    public function success(Order $order)
    {

        return view('orders.success', compact('order'));

    }

}