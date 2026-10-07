@extends('layouts.cafe')

@section('content')

<div class="container py-5">

<div class="text-center mb-5">
<h1 class="fw-bold">☕ Our Menu</h1>
<p class="text-muted">Choose your favorite coffee, pastries, and meals.</p>
</div>



<div class="menu-filter mb-5">

<div class="row g-3">


<div class="col-lg-5">

<input type="text"
id="searchProduct"
class="form-control"
placeholder="Search products...">

</div>



<div class="col-lg-4">

<select id="categoryFilter"
class="form-select">

<option value="">
All Categories
</option>

@foreach($categories as $category)

<option value="{{$category->name}}">
{{$category->icon}} {{$category->name}}
</option>

@endforeach

</select>

</div>



<div class="col-lg-3">

<select id="sortProduct"
class="form-select">

<option value="">
Recommended
</option>

<option value="low">
Price Low - High
</option>

<option value="high">
Price High - Low
</option>

</select>

</div>


</div>

</div>





<div class="row"
id="productList">


@foreach($products as $product)


<div class="col-lg-4 col-md-6 mb-4 product-item"

data-name="{{$product->name}}"

data-category="{{$product->category->name}}"

data-price="{{$product->price}}">



<div class="product-card h-100">


@if($product->image)

<img src="{{asset('storage/'.$product->image)}}"
class="product-image">

@else

<div class="product-placeholder">
☕
</div>

@endif



<div class="p-4 d-flex flex-column">


<span class="category-badge">
{{$product->category->icon}}
{{$product->category->name}}
</span>



<h3 class="fw-bold mt-3">
{{$product->name}}
</h3>



<h4 class="price">
₱{{number_format($product->price,2)}}
</h4>



@if($product->stock > 0)

<button type="button"
onclick="addToCart({{$product->id}})"
class="btn btn-primary-custom w-100 mb-2">

Add to Cart

</button>

@else

<button class="btn btn-secondary w-100 mb-2"
disabled>

Out of Stock

</button>

@endif



<a href="/products/{{$product->id}}"
class="btn btn-outline-custom w-100">

View Details

</a>


</div>


</div>


</div>


@endforeach


</div>


</div>





<div id="cartToast">
Added to cart!
</div>





<script>


function addToCart(id){

fetch('/cart/add/'+id,{

method:'POST',

headers:{

'X-CSRF-TOKEN':'{{csrf_token()}}',

'Accept':'application/json',

'Content-Type':'application/json'

}

})

.then(response=>response.json())

.then(data=>{


let toast=document.getElementById('cartToast');


toast.innerHTML=data.message;


toast.classList.add('show');


setTimeout(()=>{

toast.classList.remove('show');

},2000);


})

.catch(error=>{

console.log(error);

});

}






const search=document.getElementById('searchProduct');

const category=document.getElementById('categoryFilter');

const sort=document.getElementById('sortProduct');

const items=document.querySelectorAll('.product-item');




function filterProducts(){


let text=search.value.toLowerCase();

let cat=category.value.toLowerCase();



let list=[...items];



list.forEach(item=>{


let name=item.dataset.name.toLowerCase();

let itemCategory=item.dataset.category.toLowerCase();



item.style.display=

name.includes(text)

&&

(!cat || itemCategory===cat)

?

"block"

:

"none";


});



if(sort.value){


list.sort((a,b)=>{


let priceA=parseFloat(a.dataset.price);

let priceB=parseFloat(b.dataset.price);



if(sort.value==="low")

return priceA-priceB;



if(sort.value==="high")

return priceB-priceA;


});


let parent=document.getElementById('productList');


list.forEach(item=>parent.appendChild(item));


}


}




search.addEventListener('input',filterProducts);

category.addEventListener('change',filterProducts);

sort.addEventListener('change',filterProducts);


</script>





<style>


.menu-filter{

background:white;

padding:20px;

border-radius:20px;

box-shadow:0 8px 20px rgba(0,0,0,.08);

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



@media(max-width:768px){

.menu-filter{

padding:15px;

}

}

</style>


@endsection