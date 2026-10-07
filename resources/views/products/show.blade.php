@extends('layouts.cafe')

@section('content')

<div class="container py-5">


<div id="cartToast">
Added to cart!
</div>



<div class="product-detail-card">


<div class="product-image-box">


@if($product->image)

<img src="{{asset('storage/'.$product->image)}}"
class="detail-image">

@else

<div class="detail-placeholder">
☕
</div>

@endif


</div>





<div class="product-info">


<span class="category-badge">
{{$product->category->icon}}
{{$product->category->name}}
</span>



<h1>
{{$product->name}}
</h1>



<h2 class="price">
₱{{number_format($product->price,2)}}
</h2>



@if($product->stock > 0)

<span class="stock available">
Available
</span>

@else

<span class="stock unavailable">
Out of Stock
</span>

@endif




<p class="description">

{{$product->description}}

</p>




@if($product->stock > 0)


<label class="fw-bold">
Quantity
</label>


<input type="number"
id="quantity"
value="1"
min="1"
max="{{$product->stock}}"
class="quantity-input">



<button onclick="addToCart({{$product->id}})"
class="cart-btn">

Add to Cart

</button>



@else

<button class="cart-btn disabled" disabled>
Currently Unavailable
</button>

@endif



</div>


</div>





<h2 class="section-title text-center mt-5 mb-4">
You May Also Like
</h2>



<div class="row">


@php

$recommendations=\App\Models\Product::where('id','!=',$product->id)
->inRandomOrder()
->limit(3)
->get();

@endphp



@foreach($recommendations as $related)


<div class="col-lg-4 mb-4">


<div class="product-card">


@if($related->image)

<img src="{{asset('storage/'.$related->image)}}"
class="product-image">

@else

<div class="product-placeholder">
☕
</div>

@endif


<div class="p-3">


<h4 class="fw-bold">
{{$related->name}}
</h4>


<p class="price">
₱{{number_format($related->price,2)}}
</p>


<a href="/products/{{$related->id}}"
class="btn btn-outline-custom w-100">

View

</a>


</div>


</div>


</div>


@endforeach


</div>




</div>





<script>

function addToCart(id){

let quantity=document.getElementById('quantity').value;


fetch('/cart/add/'+id,{

method:'POST',

headers:{

'X-CSRF-TOKEN':'{{csrf_token()}}',

'Accept':'application/json',

'Content-Type':'application/json'

},

body:JSON.stringify({

quantity:quantity

})

})

.then(res=>res.json())

.then(data=>{


let toast=document.getElementById('cartToast');

toast.innerHTML=data.message;

toast.classList.add('show');


setTimeout(()=>{

toast.classList.remove('show');

},2000);


});


}

</script>




<style>


.product-detail-card{

max-width:850px;

margin:auto;

background:white;

border-radius:25px;

padding:30px;

display:flex;

gap:35px;

align-items:center;

box-shadow:0 10px 30px rgba(0,0,0,.08);

}



.product-image-box{

width:45%;

}



.detail-image{

width:100%;

height:320px;

object-fit:cover;

border-radius:20px;

}



.detail-placeholder{

height:320px;

background:#f3e5d0;

border-radius:20px;

display:flex;

align-items:center;

justify-content:center;

font-size:90px;

}



.product-info{

flex:1;

}



.product-info h1{

font-size:38px;

font-weight:800;

margin:15px 0;

}



.price{

font-weight:800;

}



.stock{

display:inline-block;

padding:7px 15px;

border-radius:20px;

font-weight:700;

}



.available{

background:#d1e7dd;

color:#146c43;

}



.unavailable{

background:#f8d7da;

color:#842029;

}



.description{

color:#666;

margin:20px 0;

}



.quantity-input{

width:100px;

padding:10px;

border-radius:10px;

border:1px solid #ddd;

display:block;

margin-top:8px;

}



.cart-btn{

margin-top:20px;

background:#6f4e37;

color:white;

border:none;

padding:13px 35px;

border-radius:25px;

font-weight:700;

}



.cart-btn:hover{

background:#4b2e1f;

}



.disabled{

background:#999;

}



#cartToast{

position:fixed;

top:50%;

left:50%;

transform:translate(-50%,-50%) scale(.8);

background:#16a34a;

color:white;

padding:18px 30px;

border-radius:30px;

opacity:0;

pointer-events:none;

transition:.3s;

z-index:9999;

}



#cartToast.show{

opacity:1;

transform:translate(-50%,-50%) scale(1);

}




@media(max-width:768px){


.product-detail-card{

flex-direction:column;

padding:20px;

}



.product-image-box{

width:100%;

}



.detail-image,
.detail-placeholder{

height:280px;

}



.product-info h1{

font-size:30px;

}

}


</style>


@endsection