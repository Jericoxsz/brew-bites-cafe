@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="fw-bold mb-4">
☕ Brew & Bites Dashboard
</h1>


<div class="row">



<div class="col-xl-3 col-lg-4 col-md-6 mb-4">

<div class="card shadow border-0 text-center h-100">

<div class="card-body">

<h5>
💰 Today's Sales
</h5>

<h2 class="fw-bold">
₱{{ number_format($todaySales,2) }}
</h2>

</div>

</div>

</div>





<div class="col-xl-3 col-lg-4 col-md-6 mb-4">

<a href="/admin/orders"
class="text-decoration-none text-dark">


<div class="card shadow border-0 text-center h-100 dashboard-card">

<div class="card-body">

<h5>
📦 Total Orders
</h5>

<h2 class="fw-bold">
{{ $orders }}
</h2>

<p class="text-muted mb-0">
View Orders
</p>

</div>

</div>


</a>

</div>





<div class="col-xl-3 col-lg-4 col-md-6 mb-4">


<a href="/admin/orders?status=Completed"
class="text-decoration-none text-dark">


<div class="card shadow border-0 text-center h-100 dashboard-card">

<div class="card-body">

<h5>
✅ Completed Orders
</h5>

<h2 class="fw-bold">
{{ $completedOrders }}
</h2>

<p class="text-muted mb-0">
View Completed
</p>

</div>

</div>


</a>


</div>





<div class="col-xl-3 col-lg-4 col-md-6 mb-4">


<a href="/admin/inventory"
class="text-decoration-none text-dark">


<div class="card shadow border-0 text-center h-100 dashboard-card">

<div class="card-body">

<h5>
🟡 Low Stock
</h5>

<h2 class="fw-bold">
{{ $lowStockCount }}
</h2>

<p class="text-muted mb-0">
Check Inventory
</p>

</div>

</div>


</a>


</div>





<div class="col-xl-3 col-lg-4 col-md-6 mb-4">


<a href="/admin/inventory"
class="text-decoration-none text-dark">


<div class="card shadow border-0 text-center h-100 dashboard-card">

<div class="card-body">

<h5>
🔴 Out of Stock
</h5>

<h2 class="fw-bold">
{{ $outOfStockCount }}
</h2>

<p class="text-muted mb-0">
Restock Needed
</p>

</div>

</div>


</a>


</div>



</div>






<div class="row">



<div class="col-lg-6 mb-4">


<div class="card shadow border-0 h-100">


<div class="card-body">


<h3 class="fw-bold">
🔥 Top Selling Product
</h3>



@if($topProduct)

<h4 class="mt-3">
{{ $topProduct->product->name }}
</h4>


<p>
{{ $topProduct->total_sold }} sold
</p>


@else

<p class="text-muted">
No sales yet.
</p>

@endif



</div>

</div>


</div>





<div class="col-lg-6 mb-4">


<div class="card shadow border-0 h-100">


<div class="card-body">


<h3 class="fw-bold">
⚠ Stock Alerts
</h3>



@if($outOfStock->count())


@foreach($outOfStock as $product)


<div class="alert alert-danger">

🔴 {{ $product->name }}

- Out of Stock

</div>


@endforeach


@endif





@if($lowStock->count())


@foreach($lowStock as $product)


<div class="alert alert-warning">

🟡 {{ $product->name }}

- Only {{ $product->stock }} left

</div>


@endforeach


@endif




@if(!$outOfStock->count() && !$lowStock->count())


<div class="alert alert-success">

All products have enough stock.

</div>


@endif



</div>

</div>


</div>


</div>






<div class="card shadow border-0">


<div class="card-body">


<h3 class="fw-bold">
📦 Recent Orders
</h3>



<div class="table-responsive">


<table class="table">


<thead>

<tr>

<th>
Order
</th>

<th>
Customer
</th>

<th>
Status
</th>

<th>
Total
</th>

</tr>

</thead>


<tbody>


@foreach($recentOrders as $order)


<tr>

<td>
#{{ $order->id }}
</td>


<td>
{{ $order->user->name }}
</td>


<td>

@if($order->status == 'Pending')

<span class="badge bg-warning text-dark">
Pending
</span>


@elseif($order->status == 'Preparing')

<span class="badge bg-info">
Preparing
</span>


@elseif($order->status == 'Completed')

<span class="badge bg-success">
Completed
</span>


@else

<span class="badge bg-danger">
Cancelled
</span>


@endif

</td>


<td>
₱{{ number_format($order->total_amount,2) }}
</td>


</tr>


@endforeach


</tbody>


</table>


</div>


</div>


</div>



</div>



<style>

.dashboard-card{

transition:.2s;

}


.dashboard-card:hover{

transform:translateY(-5px);

box-shadow:0 10px 25px rgba(0,0,0,.15)!important;

}


</style>


@endsection