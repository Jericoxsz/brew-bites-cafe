@extends('layouts.cafe')
@section('content')

<div class="container py-5">

@if(session('success'))
<div class="cart-alert">
    <span>🛒</span>
    {{session('success')}}
    <button onclick="this.parentElement.style.display='none'">OK</button>
</div>
@endif

<div class="row align-items-center">

<div class="col-lg-6 mb-4">
@if($product->image)
<img src="{{asset('storage/'.$product->image)}}" class="detail-image">
@else
<div class="detail-placeholder">☕</div>
@endif
</div>

<div class="col-lg-6">

<span class="category-badge">
{{$product->category->icon}} {{$product->category->name}}
</span>

<h1 class="fw-bold mt-3">
{{$product->name}}
</h1>

<h2 class="price">
₱{{number_format($product->price,2)}}
</h2>

@if($product->stock > 0)
<span class="badge bg-success">🟢 Available</span>
@else
<span class="badge bg-danger">🔴 Out of Stock</span>
@endif

<p class="mt-4 fs-5 text-muted">
{{$product->description}}
</p>

@if($product->stock > 0)

<form action="/cart/add/{{$product->id}}" method="POST">
@csrf

<label class="fw-bold mb-2">
Quantity
</label>

<input type="number"
name="quantity"
value="1"
min="1"
max="{{$product->stock}}"
class="form-control quantity-input">

<button class="btn btn-primary-custom mt-4">
🛒 Add to Cart
</button>

</form>

@else

<button class="btn btn-secondary mt-4" disabled>
Currently Unavailable
</button>

@endif

</div>

</div>


<hr class="my-5">


<h2 class="section-title text-center mb-4">
You May Also Like
</h2>


<div class="row">

@php
$recommendations=\App\Models\Product::where('id','!=',$product->id)->inRandomOrder()->limit(3)->get();
@endphp

@foreach($recommendations as $related)

<div class="col-lg-4 col-md-6 mb-4">

<div class="product-card">

@if($related->image)
<img src="{{asset('storage/'.$related->image)}}" class="product-image">
@else
<div class="product-placeholder">☕</div>
@endif

<div class="p-3">

<h4 class="fw-bold">
{{$related->name}}
</h4>

<p class="price">
₱{{number_format($related->price,2)}}
</p>

<a href="/products/{{$related->id}}" class="btn btn-outline-custom w-100">
View
</a>

</div>

</div>

</div>

@endforeach

</div>

</div>


<style>
.cart-alert{
background:#e8f7ef;
color:#15803d;
padding:15px 20px;
border-radius:20px;
margin-bottom:25px;
display:flex;
align-items:center;
gap:10px;
font-weight:600;
}

.cart-alert button{
margin-left:auto;
border:none;
background:#6f4e37;
color:white;
padding:6px 18px;
border-radius:20px;
}

.detail-image{
width:100%;
height:550px;
object-fit:cover;
border-radius:30px;
box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.detail-placeholder{
height:550px;
background:#f3e5d0;
border-radius:30px;
display:flex;
align-items:center;
justify-content:center;
font-size:150px;
}

.quantity-input{
width:120px;
}
</style>

@endsection