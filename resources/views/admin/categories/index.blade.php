@extends('layouts.admin')

@section('content')

<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-4">


<div>

<h1 class="fw-bold">
📂 Category Management
</h1>

<p class="text-muted">
Organize your café products.
</p>

</div>


<a href="/admin/categories/create"
class="btn btn-dark">

+ Add Category

</a>


</div>



@if(session('error'))

<div class="alert alert-danger">

{{ session('error') }}

</div>

@endif



<div class="row">



@foreach($categories as $category)



<div class="col-lg-4 col-md-6 mb-4">


<div class="card shadow border-0 text-center h-100">


<div class="card-body p-4">


<div style="font-size:55px">

{{ $category->icon }}

</div>


<h2 class="fw-bold mt-3">

{{ $category->name }}

</h2>


<p class="text-muted">

{{ $category->products_count }} Products

</p>



<a href="/admin/categories/{{ $category->id }}/products"
class="btn btn-dark mb-2">

View Products

</a>



<div>


<a href="/admin/categories/{{ $category->id }}/edit"
class="btn btn-warning">

Edit

</a>



<button type="button"
class="btn btn-danger"
data-bs-toggle="modal"
data-bs-target="#deleteModal{{ $category->id }}">

Delete

</button>


</div>


</div>


</div>


</div>





<!-- Delete Modal -->

<div class="modal fade"
id="deleteModal{{ $category->id }}"
tabindex="-1">


<div class="modal-dialog modal-dialog-centered">


<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">

Delete Category

</h5>


<button type="button"
class="btn-close"
data-bs-dismiss="modal">

</button>


</div>



<div class="modal-body">


Are you sure you want to delete:


<strong>
{{ $category->name }}
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




<form action="/admin/categories/{{ $category->id }}"
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