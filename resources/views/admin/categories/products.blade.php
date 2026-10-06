@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="fw-bold mb-2">
{{ $category->name }} Products
</h1>

<p class="text-muted">
Products under this category.
</p>


<form class="card shadow border-0 p-3 mb-4">

<div class="row g-3">

<div class="col-md-5">

<input type="text"
name="search"
class="form-control"
placeholder="Search product">

</div>


<div class="col-md-4">

<select name="sort"
class="form-select">

<option value="">
Newest
</option>

<option value="price_low">
Price Low - High
</option>

<option value="price_high">
Price High - Low
</option>

<option value="stock">
Low Stock
</option>

</select>

</div>


<div class="col-md-3">

<button class="btn btn-dark w-100">
Filter
</button>

</div>

</div>

</form>


<div class="row">

@foreach($products as $product)

<div class="col-lg-4 col-md-6 mb-4">

<div class="card shadow border-0">

@if($product->image)

<img src="{{asset('storage/'.$product->image)}}"
style="height:220px;object-fit:cover;"
class="card-img-top">

@endif


<div class="card-body">

<h4 class="fw-bold">
{{ $product->name }}
</h4>

<h5>
₱{{ $product->price }}
</h5>

<p>
Stock:
{{ $product->stock }}
</p>

</div>

</div>

</div>

@endforeach

</div>


</div>

@endsection