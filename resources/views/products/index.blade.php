@extends('layouts.cafe')

@section('content')

<div class="container py-5">

<div class="text-center mb-5">
<h1 class="fw-bold">☕ Our Menu</h1>
<p class="text-muted">Choose your favorite coffee, pastries, and meals.</p>
</div>


<form method="GET" class="menu-filter mb-5">

<div class="row g-3">

<div class="col-lg-5">
<input type="text" name="search" class="form-control" placeholder="Search products..." value="{{request('search')}}">
</div>

<div class="col-lg-3">
<select name="category" class="form-select">
<option value="">All Categories</option>

@foreach($categories as $category)

<option value="{{$category->id}}" {{request('category')==$category->id?'selected':''}}>
{{$category->icon}} {{$category->name}}
</option>

@endforeach

</select>
</div>


<div class="col-lg-3">
<select name="sort" class="form-select">
<option value="">Recommended</option>
<option value="price_low" {{request('sort')=='price_low'?'selected':''}}>Price Low - High</option>
<option value="price_high" {{request('sort')=='price_high'?'selected':''}}>Price High - Low</option>
</select>
</div>


<div class="col-lg-1">
<button class="btn btn-primary-custom w-100">Go</button>
</div>

</div>

</form>



<div class="row">

@foreach($products as $product)

<div class="col-lg-4 col-md-6 mb-4">

<div class="product-card h-100">

@if($product->image)

<img src="{{asset('storage/'.$product->image)}}" class="product-image">

@else

<div class="product-placeholder">☕</div>

@endif


<div class="p-4 d-flex flex-column">

<span class="category-badge">
{{$product->category->icon}} {{$product->category->name}}
</span>


<h3 class="fw-bold mt-3">
{{$product->name}}
</h3>


<h4 class="price">
₱{{number_format($product->price,2)}}
</h4>


@if($product->stock > 0)

<button onclick="addToCart({{$product->id}})" class="btn btn-primary-custom w-100 mb-2">
🛒 Add to Cart
</button>

@else

<button class="btn btn-secondary w-100 mb-2" disabled>
Out of Stock
</button>

@endif


<a href="/products/{{$product->id}}" class="btn btn-outline-custom w-100">
View Details
</a>


</div>

</div>

</div>

@endforeach

</div>

</div>



<div id="cartToast">
🛒 Added to cart!
</div>



<script>
function addToCart(id){

fetch('/cart/add/'+id,{
method:'POST',
headers:{
'X-CSRF-TOKEN':'{{csrf_token()}}',
'Accept':'application/json'
}
})
.then(response=>response.json())
.then(data=>{

let toast=document.getElementById('cartToast');

toast.innerHTML=''+data.message;

toast.classList.add('show');

setTimeout(()=>{
toast.classList.remove('show');
},2000);

});

}
</script>



<style>
#cartToast{
position:fixed;
top:50%;
left:50%;
transform:translate(-50%,-50%) scale(.8);
background:#16a34a;
color:white;
padding:18px 30px;
border-radius:30px;
font-weight:600;
box-shadow:0 10px 25px rgba(0,0,0,.15);
opacity:0;
pointer-events:none;
transition:.3s;
z-index:9999;
}

#cartToast.show{
opacity:1;
transform:translate(-50%,-50%) scale(1);
}
</style>

@endsection