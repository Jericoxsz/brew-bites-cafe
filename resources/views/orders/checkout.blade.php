@extends('layouts.cafe')

@section('content')

<div class="container py-5">

<h1 class="checkout-title">💳 Checkout</h1>

<div class="receipt">

<div class="receipt-header">
<h2>Brew & Bites Café</h2>
<p>Order Receipt</p>
</div>


<div class="customer-box">

<h4>Customer</h4>

<p><b>Name:</b> {{auth()->user()->name}}</p>
<p><b>Email:</b> {{auth()->user()->email}}</p>

</div>


<div class="divider"></div>


<h3 class="mb-4">
Order Details
</h3>


@foreach($cart->items as $item)

<div class="receipt-item">

<div>
<h5>{{$item->product->name}}</h5>
<span>Qty: {{$item->quantity}}</span>
</div>

<strong>
₱{{number_format($item->product->price*$item->quantity,2)}}
</strong>

</div>

@endforeach



<div class="divider"></div>


<div class="receipt-total">

<h3>Total</h3>

<h2>
₱{{number_format($total,2)}}
</h2>

</div>



<div class="payment-box">

<h4>
Payment Method
</h4>

<label>
<input type="radio" checked>
Cash on Delivery
</label>

</div>



<form action="/checkout" method="POST">

@csrf

<button class="btn btn-primary-custom w-100 place-order">
☕ Place Order
</button>

</form>



<a href="/cart" class="back-cart">
← Back to Cart
</a>


</div>

</div>



<style>

.checkout-title{
font-size:48px;
font-weight:800;
margin-bottom:35px;
}

.receipt{
background:white;
max-width:750px;
margin:auto;
padding:40px;
border-radius:30px;
box-shadow:0 15px 35px rgba(0,0,0,.12);
}

.receipt-header{
text-align:center;
padding-bottom:20px;
}

.receipt-header h2{
font-weight:800;
color:#4b2e1f;
}

.receipt-header p{
color:#777;
}


.customer-box{
background:#f8f1e7;
padding:20px;
border-radius:20px;
}


.divider{
border-top:2px dashed #ddd;
margin:25px 0;
}


.receipt-item{
display:flex;
justify-content:space-between;
align-items:center;
padding:15px 0;
}


.receipt-item h5{
margin:0;
font-weight:700;
}


.receipt-item span{
color:#777;
}


.receipt-total{
display:flex;
justify-content:space-between;
align-items:center;
}


.receipt-total h2{
color:#6f4e37;
font-weight:800;
}


.payment-box{
background:#f8f1e7;
padding:20px;
border-radius:20px;
margin:25px 0;
}


.place-order{
font-size:18px;
padding:15px;
}


.back-cart{
display:block;
text-align:center;
margin-top:20px;
color:#6f4e37;
font-weight:600;
}


@media(max-width:768px){

.checkout-title{
font-size:34px;
}

.receipt{
padding:25px;
}

.receipt-item{
gap:15px;
}

}

</style>

@endsection