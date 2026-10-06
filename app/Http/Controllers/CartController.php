<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $cart=Cart::firstOrCreate(['user_id'=>Auth::id()]);
        $quantity=$request->quantity ?? 1;

        $item=CartItem::where('cart_id',$cart->id)
            ->where('product_id',$product->id)
            ->first();

        if($item){
            $item->quantity += $quantity;
            $item->save();
        }else{
            CartItem::create([
                'cart_id'=>$cart->id,
                'product_id'=>$product->id,
                'quantity'=>$quantity
            ]);
        }

        return response()->json([
            'message'=>$product->name.' added to your cart!'
        ]);
    }

    public function index()
    {
        $cart=Cart::where('user_id',Auth::id())
            ->with('items.product.category')
            ->first();

        $total=0;

        if($cart){
            foreach($cart->items as $item){
                $total += $item->product->price*$item->quantity;
            }
        }

        return view('cart.index',compact('cart','total'));
    }

    public function update(Request $request,$item)
    {
        CartItem::findOrFail($item)->update([
            'quantity'=>$request->quantity
        ]);

        return redirect('/cart');
    }

    public function remove($item)
    {
        CartItem::findOrFail($item)->delete();

        return redirect('/cart');
    }
}