@extends('layouts.admin')

@section('content')

<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h1 class="fw-bold">
☕ Product Management
</h1>

<p class="text-muted">
Manage your café products and inventory.
</p>

</div>


<a href="/admin/products/create"
class="add-btn">

+ Add Product

</a>


</div>





<div class="filter-box mb-4">


<form method="GET">


<div class="row g-3">


<div class="col-lg-5">

<input type="text"
name="search"
class="form-control"
placeholder="Search product..."
value="{{request('search')}}">

</div>



<div class="col-lg-4">

<select name="category"
class="form-select"
onchange="this.form.submit()">


<option value="">
All Categories
</option>


@foreach($categories as $category)

<option value="{{$category->id}}"
{{request('category')==$category->id?'selected':''}}>

{{$category->icon}}
{{$category->name}}

</option>

@endforeach


</select>


</div>




<div class="col-lg-3">


<select name="sort"
class="form-select"
onchange="this.form.submit()">


<option value="">
Latest
</option>


<option value="price_low">
Price Low - High
</option>


<option value="price_high">
Price High - Low
</option>


<option value="stock">
Stock
</option>


</select>


</div>


</div>


</form>


</div>







<div class="row">


@foreach($products as $product)


<div class="col-lg-4 col-md-6 mb-4">


<div class="product-card">


@if($product->image)

<img src="{{asset('storage/'.$product->image)}}"
class="product-image">

@else

<div class="product-placeholder">
☕
</div>

@endif




<div class="p-3">


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



<p>
Stock:
<b>{{$product->stock}}</b>
</p>




<div class="d-flex gap-2">


<a href="/admin/products/{{$product->id}}/edit"
class="edit-btn">

Edit

</a>




<form action="/admin/products/{{$product->id}}"
method="POST">

@csrf

@method('DELETE')


<button type="button"
class="delete-btn"
onclick="openDeleteModal(this.form)">

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






<div class="modal-bg"
id="deleteModal">


<div class="delete-modal">


<h3>
Delete Product?
</h3>


<p>
Are you sure you want to remove this product?
</p>



<div class="modal-actions">


<button onclick="closeDeleteModal()"
class="cancel-btn">

Cancel

</button>


<button onclick="confirmDelete()"
class="confirm-btn">

Delete

</button>


</div>


</div>


</div>







<script>


let deleteForm=null;



function openDeleteModal(form){

deleteForm=form;

document
.getElementById('deleteModal')
.classList.add('show');

}



function closeDeleteModal(){

deleteForm=null;

document
.getElementById('deleteModal')
.classList.remove('show');

}



function confirmDelete(){

if(deleteForm){

deleteForm.submit();

}

}



</script>







<style>


.add-btn{

background:#1f2937;

color:white;

padding:12px 22px;

border-radius:15px;

text-decoration:none;

font-weight:700;

}



.filter-box{

background:white;

padding:20px;

border-radius:20px;

box-shadow:0 8px 20px rgba(0,0,0,.08);

}



.product-card{

background:white;

border-radius:25px;

overflow:hidden;

box-shadow:0 10px 25px rgba(0,0,0,.08);

height:100%;

}



.product-image{

width:100%;

height:260px;

object-fit:cover;

}



.product-placeholder{

height:260px;

display:flex;

align-items:center;

justify-content:center;

font-size:80px;

background:#f3e5d0;

}



.category-badge{

background:#f3e5d0;

padding:6px 15px;

border-radius:20px;

font-weight:700;

}



.price{

font-weight:800;

}




.edit-btn,
.delete-btn{

border:none;

padding:10px 18px;

border-radius:12px;

font-weight:700;

text-decoration:none;

cursor:pointer;

}



.edit-btn{

background:#ffc107;

color:#222;

}



.delete-btn{

background:#dc3545;

color:white;

}





.modal-bg{

display:none;

position:fixed;

inset:0;

background:rgba(0,0,0,.45);

align-items:center;

justify-content:center;

z-index:9999;

}



.modal-bg.show{

display:flex;

}



.delete-modal{

background:white;

width:90%;

max-width:400px;

padding:30px;

border-radius:25px;

text-align:center;

box-shadow:0 15px 40px rgba(0,0,0,.2);

}



.delete-modal h3{

font-weight:800;

color:#4b2e1f;

}



.modal-actions{

display:flex;

gap:15px;

justify-content:center;

margin-top:25px;

}



.cancel-btn,
.confirm-btn{

padding:12px 25px;

border:none;

border-radius:20px;

font-weight:700;

}



.cancel-btn{

background:#eee;

}



.confirm-btn{

background:#dc3545;

color:white;

}



@media(max-width:768px){

.product-image{

height:220px;

}

}

</style>


@endsection