@extends('layouts.admin')

@section('content')

<div class="container-fluid">


<div class="product-header mb-4">


<div>

<h1 class="fw-bold">
Product Management
</h1>

<p class="text-muted mb-0">
Manage your café products and inventory.
</p>

</div>



<a href="/admin/products/create"
class="add-btn">

+ Add Product

</a>


</div>




<div class="filter-box mb-4">


<div class="row g-3">


<div class="col-md-5">

<input type="text"
id="searchProduct"
class="form-control"
placeholder="Search product...">

</div>



<div class="col-md-4">

<select id="categoryFilter"
class="form-select">

<option value="">
All Categories
</option>


@foreach($categories as $category)

<option value="{{$category->name}}">

{{$category->name}}

</option>

@endforeach


</select>

</div>



<div class="col-md-3">

<select id="sortProduct"
class="form-select">


<option value="">
Latest
</option>


<option value="low">
Price Low - High
</option>


<option value="high">
Price High - Low
</option>


<option value="stock">
Stock
</option>


</select>

</div>


</div>


</div>





<div class="row g-4"
id="productList">


@foreach($products as $product)


<div class="col-lg-4 col-md-6 product-item"

data-name="{{$product->name}}"

data-category="{{$product->category->name}}"

data-price="{{$product->price}}"

data-stock="{{$product->stock}}">


<div class="product-card">


@if($product->image)

<img src="{{asset('storage/'.$product->image)}}"
class="product-image">

@else

<div class="product-placeholder">
No Image
</div>

@endif




<div class="product-body">



<span class="category-badge">

{{$product->category->name}}

</span>




<h3>
{{$product->name}}
</h3>



<h4 class="price">

₱{{number_format($product->price,2)}}

</h4>




@if($product->stock > 10)

<p class="stock available">
Stock: {{$product->stock}}
</p>

@elseif($product->stock > 0)

<p class="stock low">
Low Stock: {{$product->stock}}
</p>

@else

<p class="stock out">
Out of Stock
</p>

@endif





<div class="actions">


<a href="/admin/products/{{$product->id}}/edit"
class="edit-btn">

Edit

</a>



<form action="/admin/products/{{$product->id}}"
method="POST">

@csrf
@method('DELETE')


<button class="delete-btn"
onclick="return confirm('Delete this product?')">

Delete

</button>


</form>


</div>



</div>


</div>


</div>


@endforeach


</div>


</div>





<style>


.product-header{

display:flex;

justify-content:space-between;

align-items:center;

gap:20px;

}



.add-btn{

background:#1f2937;

color:white;

padding:12px 25px;

border-radius:12px;

font-weight:700;

text-decoration:none;

}



.filter-box{

background:white;

padding:20px;

border-radius:20px;

box-shadow:0 8px 20px rgba(0,0,0,.08);

}



.product-card{

background:white;

border-radius:22px;

overflow:hidden;

box-shadow:0 8px 20px rgba(0,0,0,.08);

height:100%;

display:flex;

flex-direction:column;

}



.product-image,
.product-placeholder{

width:100%;

height:260px;

}



.product-image{

object-fit:cover;

}



.product-placeholder{

background:#f3e5d0;

display:flex;

align-items:center;

justify-content:center;

font-size:35px;

color:#6f4e37;

}



.product-body{

padding:22px;

display:flex;

flex-direction:column;

flex:1;

}



.category-badge{

background:#f3e5d0;

color:#6f4e37;

padding:6px 14px;

border-radius:20px;

font-size:14px;

font-weight:700;

width:max-content;

}



.product-body h3{

font-size:22px;

font-weight:800;

margin-top:15px;

}



.price{

font-size:22px;

font-weight:700;

}



.stock{

font-weight:600;

}



.available{

color:#15803d;

}



.low{

color:#ca8a04;

}



.out{

color:#dc2626;

}



.actions{

display:flex;

gap:10px;

margin-top:auto;

padding-top:15px;

}



.edit-btn,
.delete-btn{

padding:10px 22px;

border-radius:12px;

font-weight:700;

border:none;

cursor:pointer;

text-decoration:none;

}



.edit-btn{

background:#fbbf24;

color:#1f2937;

}



.delete-btn{

background:#dc3545;

color:white;

}




@media(max-width:768px){


.product-header{

flex-direction:column;

align-items:flex-start;

}



.add-btn{

width:100%;

text-align:center;

}



.product-image,
.product-placeholder{

height:220px;

}


}

</style>





<script>


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

let itemCat=item.dataset.category.toLowerCase();



item.style.display=

name.includes(text)

&&

(!cat || itemCat==cat)

?

"block"

:

"none";


});



if(sort.value){


list.sort((a,b)=>{


let priceA=parseFloat(a.dataset.price);

let priceB=parseFloat(b.dataset.price);


let stockA=parseInt(a.dataset.stock);

let stockB=parseInt(b.dataset.stock);



if(sort.value=="low")

return priceA-priceB;



if(sort.value=="high")

return priceB-priceA;



if(sort.value=="stock")

return stockA-stockB;



});



let parent=document.getElementById('productList');


list.forEach(item=>parent.appendChild(item));


}


}



search.addEventListener('input',filterProducts);

category.addEventListener('change',filterProducts);

sort.addEventListener('change',filterProducts);


</script>


@endsection