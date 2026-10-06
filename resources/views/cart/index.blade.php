@extends('layouts.cafe')

@section('content')

<div class="container py-5">

<h1 class="fw-bold mb-4">🛒 Your Cart</h1>

@if(!$cart || $cart->items->count()==0)

<div class="empty-state text-center">
<div class="empty-icon">🛒</div>
<h2>Your Cart is Empty</h2>
<p class="text-muted">Looks like you haven't added anything yet.</p>
<a href="/products" class="btn btn-primary-custom mt-3">Browse Menu</a>
</div>

@else

<div class="receipt-cart">

<h2 class="fw-bold text-center mb-4">
Order Summary
</h2>

@foreach($cart->items as $item)

<div class="receipt-item">

<div>
<h4>{{$item->product->name}}</h4>
<p>{{$item->product->category->name}}</p>
</div>

<div class="text-end">
<p>Qty: {{$item->quantity}}</p>
<p class="fw-bold">₱{{number_format($item->product->price*$item->quantity,2)}}</p>
</div>

</div>


<div class="receipt-actions">

<form action="/cart/update/{{$item->id}}" method="POST">
@csrf
@method('PUT')

<input type="number" name="quantity" value="{{$item->quantity}}" min="1">

<button class="btn btn-primary-custom">
Update
</button>

</form>


<form action="/cart/remove/{{$item->id}}" method="POST">
@csrf
@method('DELETE')

<button class="btn btn-outline-danger">
Remove
</button>

</form>

</div>

@endforeach


<hr>


<div class="receipt-total">

<h3>Total</h3>

<h3 class="price">
₱{{number_format($total,2)}}
</h3>

</div>


<div class="checkout-buttons">

<a href="/products" class="btn btn-outline-custom">
← Continue Shopping
</a>


<a href="/checkout" class="btn btn-primary-custom">
Proceed to Checkout →
</a>

</div>


</div>

@endif

</div>


<style>

.receipt-cart{
background:white;
max-width:800px;
margin:auto;
padding:35px;
border-radius:25px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.receipt-item{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 0;
border-bottom:1px dashed #ddd;
}

.receipt-item h4{
margin:0;
}

.receipt-item p{
margin:5px 0;
color:#777;
}

.receipt-actions{
display:flex;
justify-content:flex-end;
gap:10px;
margin:15px 0 25px;
}

.receipt-actions form{
display:flex;
gap:8px;
}

.receipt-actions input{
width:70px;
border:1px solid #ddd;
border-radius:10px;
padding:8px;
}

.receipt-total{
display:flex;
justify-content:space-between;
align-items:center;
}

.checkout-buttons{
display:flex;
gap:15px;
margin-top:25px;
}

.checkout-buttons a{
flex:1;
text-align:center;
}


@media(max-width:768px){

.receipt-item{
flex-direction:column;
align-items:flex-start;
}

.receipt-actions,
.checkout-buttons{
flex-direction:column;
}

.receipt-actions form,
.checkout-buttons a{
width:100%;
}

}

</style>

@endsection