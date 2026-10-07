@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="fw-bold mb-4">☕ Brew & Bites Dashboard</h1>

<div class="row g-4 mb-4">

<div class="col-md-4">
<div class="dash-card">
<h5>💰 Today's Sales</h5>
<h2>₱{{number_format($todaySales ?? 0,2)}}</h2>
</div>
</div>

<div class="col-md-4">
<div class="dash-card">
<h5>📦 Total Orders</h5>
<h2>{{$totalOrders ?? 0}}</h2>
<a href="/admin/orders">View Orders</a>
</div>
</div>

<div class="col-md-4">
<div class="dash-card">
<h5>✅ Completed Orders</h5>
<h2>{{$completedOrders ?? 0}}</h2>
<a href="/admin/orders">View Completed</a>
</div>
</div>

</div>


<div class="row g-4 mb-4">


<div class="col-lg-6 d-flex">

<div class="panel-card w-100">

<h3>🔥 Top Selling Product</h3>

@if($topProduct)

<h4>{{$topProduct->name}}</h4>

<p>{{$topProduct->sales_count ?? 0}} sold</p>

@else

<p>No sales yet.</p>

@endif

</div>

</div>



<div class="col-lg-6 d-flex">

<div class="panel-card w-100">

<h3>⚠️ Stock Alerts</h3>


@if(isset($lowStock) && $lowStock->count())


@foreach($lowStock as $product)

<div class="alert alert-warning mb-2">

{{$product->name}}

<br>

Stock: {{$product->stock}}

</div>

@endforeach


@else

<div class="alert alert-success mb-0">

All products have enough stock.

</div>

@endif


</div>

</div>


</div>




<div class="panel-card">

<h3>📦 Recent Orders</h3>


<div class="table-responsive">

<table class="table align-middle">

<thead>

<tr>

<th>Order</th>

<th>Customer</th>

<th>Status</th>

<th>Total</th>

</tr>

</thead>


<tbody>


@foreach($recentOrders ?? [] as $order)

<tr>

<td>
#{{$order->id}}
</td>

<td>
{{$order->user->name}}
</td>

<td>

<span class="status">
{{$order->status}}
</span>

</td>

<td>
₱{{number_format($order->total_amount,2)}}
</td>

</tr>

@endforeach


</tbody>

</table>

</div>

</div>


</div>




<style>

.dash-card,
.panel-card{

background:white;

border-radius:20px;

box-shadow:0 8px 20px rgba(0,0,0,.08);

}


.dash-card{

padding:25px;

text-align:center;

height:100%;

}


.dash-card h5{

font-weight:700;

color:#4b2e1f;

}


.dash-card h2{

font-size:35px;

font-weight:800;

margin:15px 0;

}


.dash-card a{

color:#6f4e37;

font-weight:600;

text-decoration:none;

}



.panel-card{

padding:25px;

min-height:190px;

}



.panel-card h3{

font-weight:800;

color:#4b2e1f;

margin-bottom:20px;

}



.status{

background:#d1e7dd;

color:#146c43;

padding:6px 12px;

border-radius:20px;

font-weight:700;

font-size:13px;

}



@media(max-width:768px){

.dash-card{

padding:18px;

}


.dash-card h2{

font-size:28px;

}


.panel-card{

padding:18px;

min-height:auto;

}

}

</style>


@endsection