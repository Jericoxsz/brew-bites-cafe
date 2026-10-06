@extends('layouts.admin')

@section('content')

<div class="container-fluid">


<h1 class="fw-bold mb-4">
📈 Inventory & Sales Analytics
</h1>



<div class="row mb-4">


<div class="col-lg-4">

<div class="card shadow border-0 text-center">

<div class="card-body">

<h5>
💰 Total Revenue
</h5>

<h2 class="fw-bold">

₱{{ number_format($totalRevenue,2) }}

</h2>


</div>

</div>

</div>


</div>





<div class="row">


<div class="col-lg-6 mb-4">


<div class="card shadow border-0">

<div class="card-body">


<h3 class="fw-bold">
🔥 Best Selling Products
</h3>



@foreach($sales as $sale)


<div class="d-flex justify-content-between mt-3">


<span>

{{ $sale->product->name }}

</span>


<strong>

{{ $sale->total_sold }} sold

</strong>


</div>


@endforeach


</div>

</div>


</div>






<div class="col-lg-6 mb-4">


<div class="card shadow border-0">


<div class="card-body">


<h3 class="fw-bold">
💰 Revenue Breakdown
</h3>



@foreach($sales as $sale)


<div class="d-flex justify-content-between mt-3">


<span>

{{ $sale->product->name }}

</span>


<strong>

₱{{ number_format($sale->revenue,2) }}

</strong>


</div>


@endforeach



</div>

</div>


</div>


</div>






<div class="card shadow border-0">


<div class="card-body">


<h3 class="fw-bold mb-4">
📦 Inventory Status
</h3>



<div class="table-responsive">


<table class="table">


<thead>

<tr>

<th>
Product
</th>

<th>
Category
</th>

<th>
Stock
</th>

<th>
Status
</th>

</tr>

</thead>



<tbody>


@foreach($products as $product)


<tr>


<td>

{{ $product->name }}

</td>


<td>

{{ $product->category->name }}

</td>


<td>

{{ $product->stock }}

</td>


<td>



@if($product->stock == 0)


<span class="badge bg-danger">

Out of Stock

</span>



@elseif($product->stock <= 5)


<span class="badge bg-warning text-dark">

Low Stock

</span>



@else


<span class="badge bg-success">

Available

</span>


@endif



</td>


</tr>


@endforeach


</tbody>


</table>


</div>



</div>


</div>


</div>


@endsection