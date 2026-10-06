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
class="btn btn-dark">

+ Add Product

</a>

</div>



<div class="row">


@foreach($products as $product)


<div class="col-lg-4 col-md-6 mb-4">


<div class="card shadow border-0 h-100">


@if($product->image)

<img src="{{ asset('storage/'.$product->image) }}"
class="card-img-top"
style="height:230px;object-fit:cover;">

@else

<div style="
height:230px;
background:#f8f1e7;
display:flex;
align-items:center;
justify-content:center;
font-size:60px;
">

☕

</div>

@endif



<div class="card-body">


<h4 class="fw-bold">
{{ $product->name }}
</h4>


<p class="text-muted">
{{ $product->category->name }}
</p>


<h3>
₱{{ number_format($product->price,2) }}
</h3>


<p>
Stock:
<strong>
{{ $product->stock }}
</strong>
</p>



<div class="mt-3">


<a href="/admin/products/{{ $product->id }}/edit"
class="btn btn-warning">

Edit

</a>



<button type="button"
class="btn btn-danger"
data-bs-toggle="modal"
data-bs-target="#deleteModal{{ $product->id }}">

Delete

</button>


</div>


</div>


</div>


</div>





<!-- Delete Modal -->

<div class="modal fade"
id="deleteModal{{ $product->id }}"
tabindex="-1">


<div class="modal-dialog modal-dialog-centered">


<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">
Delete Product
</h5>


<button type="button"
class="btn-close"
data-bs-dismiss="modal">

</button>

</div>



<div class="modal-body">

Are you sure you want to delete:

<strong>
{{ $product->name }}
</strong>?

<br>

This action cannot be undone.

</div>



<div class="modal-footer">


<button type="button"
class="btn btn-secondary"
data-bs-dismiss="modal">

Cancel

</button>



<form action="/admin/products/{{ $product->id }}"
method="POST">

@csrf
@method('DELETE')


<button class="btn btn-danger">

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

@endsection