@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="fw-bold mb-4">
📂 Add Category
</h1>

<div class="card shadow border-0">

<div class="card-body p-4">


<form action="/admin/categories"
method="POST">

@csrf


<div class="mb-3">

<label class="form-label fw-semibold">
Category Name
</label>

<input type="text"
name="name"
class="form-control"
placeholder="Example: Coffee">

</div>


<div class="mb-4">

<label class="form-label fw-semibold">
Choose Icon
</label>


<div class="row g-2">


@php

$icons = [
'☕',
'🥐',
'🍞',
'🍰',
'🍪',
'🍩',
'🧁',
'🍫',
'🍵',
'🧋',
'🥤',
'🍹',
'🍝',
'🍕',
'🍔',
'🍟',
'🌭',
'🍗',
'🥗',
'🍳',
'🥞',
'🍜',
'🍱',
'🍣',
'🍨',
'🍦',
'🍓',
'🍎',
'🥭',
'🍌'
];

@endphp


@foreach($icons as $icon)

<div class="col-2">


<input type="radio"
name="icon"
value="{{ $icon }}"
id="icon{{ $loop->index }}"
class="d-none icon-radio">


<label for="icon{{ $loop->index }}"
class="icon-box">

{{ $icon }}

</label>


</div>

@endforeach


</div>


</div>


<button class="btn"
style="background:#6f4e37;color:white;">

Save Category

</button>


</form>


</div>

</div>


</div>


<style>

.icon-box{

font-size:32px;
cursor:pointer;
width:55px;
height:55px;
display:flex;
align-items:center;
justify-content:center;
border-radius:12px;
background:#f8f1e7;
transition:.2s;

}

.icon-box:hover{

background:#6f4e37;
transform:scale(1.1);

}


.icon-radio:checked + .icon-box{

background:#6f4e37;
color:white;
box-shadow:0 5px 15px rgba(0,0,0,.2);

}

</style>


@endsection