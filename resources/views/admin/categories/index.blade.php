@extends('layouts.admin')

@section('content')

<div class="container-fluid">


<div class="category-header mb-4">


<div>

<h1 class="fw-bold">
📂 Category Management
</h1>

<p class="text-muted mb-0">
Organize your café products.
</p>

</div>



<a href="/admin/categories/create"
class="add-btn">

+ Add Category

</a>


</div>





<div class="row g-4">


@foreach($categories as $category)


<div class="col-lg-4 col-md-6">


<div class="category-card">



<div class="category-icon">

{{$category->icon}}

</div>




<h3>

{{$category->name}}

</h3>




<p>

{{$category->products_count}}
Products

</p>





<a href="/admin/categories/{{$category->id}}/products"
class="view-btn">

View Products

</a>





<div class="actions">


<a href="/admin/categories/{{$category->id}}/edit"
class="edit-btn">

Edit

</a>



<form action="/admin/categories/{{$category->id}}"
method="POST">

@csrf
@method('DELETE')


<button class="delete-btn"
onclick="return confirm('Delete this category?')">

Delete

</button>


</form>


</div>




</div>


</div>


@endforeach


</div>


</div>





<style>


.category-header{

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




.category-card{

background:white;

border-radius:22px;

padding:35px 25px;

text-align:center;

box-shadow:0 8px 20px rgba(0,0,0,.08);

height:100%;

}



.category-icon{

font-size:60px;

margin-bottom:20px;

}



.category-card h3{

font-size:24px;

font-weight:800;

}



.category-card p{

color:#6b7280;

}



.view-btn{

display:inline-block;

background:#1f2937;

color:white;

padding:10px 20px;

border-radius:12px;

font-weight:700;

text-decoration:none;

margin-bottom:15px;

}



.actions{

display:flex;

justify-content:center;

gap:10px;

}



.edit-btn,
.delete-btn{

padding:10px 20px;

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


.category-header{

flex-direction:column;

align-items:flex-start;

}



.add-btn{

width:100%;

text-align:center;

}



.category-card{

padding:25px 20px;

}



.category-icon{

font-size:50px;

}


}

</style>


@endsection