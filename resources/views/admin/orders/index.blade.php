@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="fw-bold mb-4">
📦 Order Management
</h1>


<div class="row mb-4">

<div class="col-md-3">
<div class="stat-card">
<h5>Total Orders</h5>
<h2>{{$orders->count()}}</h2>
</div>
</div>

<div class="col-md-3">
<div class="stat-card">
<h5>🟡 Pending</h5>
<h2>{{$orders->where('status','Pending')->count()}}</h2>
</div>
</div>

<div class="col-md-3">
<div class="stat-card">
<h5>🔵 Preparing</h5>
<h2>{{$orders->where('status','Preparing')->count()}}</h2>
</div>
</div>

<div class="col-md-3">
<div class="stat-card">
<h5>🟢 Completed</h5>
<h2>{{$orders->where('status','Completed')->count()}}</h2>
</div>
</div>

</div>



<div class="filter-box mb-4">

<form method="GET">

<div class="row g-3">

<div class="col-md-5">
<input type="text" name="search" class="form-control" placeholder="Search customer...">
</div>


<div class="col-md-3">
<select name="status" class="form-select">
<option value="">All Status</option>
<option>Pending</option>
<option>Preparing</option>
<option>Completed</option>
</select>
</div>


<div class="col-md-3">
<select name="sort" class="form-select">
<option>Newest First</option>
<option>Oldest First</option>
</select>
</div>


<div class="col-md-1">
<button class="btn btn-dark w-100">
Go
</button>
</div>

</div>

</form>

</div>




<div class="orders-list">


@foreach($orders as $order)


<div class="order-row">


<div class="order-header">

<h2>
Order #{{$order->id}}
</h2>


@if($order->status=='Pending')

<span class="status pending">
Pending
</span>

@elseif($order->status=='Preparing')

<span class="status preparing">
Preparing
</span>

@elseif($order->status=='Completed')

<span class="status completed">
Completed
</span>

@endif


</div>


<hr>


<p>
Customer:
<b>{{$order->user->name}}</b>
</p>


<p>
Date:
{{$order->created_at->format('M d, Y h:i A')}}
</p>



<h4>
Items:
</h4>


<ul>

@foreach($order->items as $item)

<li>
{{$item->product->name}} x{{$item->quantity}}
</li>

@endforeach

</ul>



<h3 class="price">
₱{{number_format($order->total_amount,2)}}
</h3>


<a href="/admin/orders/{{$order->id}}" class="btn btn-outline-custom">
View Details
</a>


</div>


@endforeach


</div>


</div>


<style>

.stat-card{
background:white;
padding:25px;
border-radius:20px;
text-align:center;
box-shadow:0 8px 20px rgba(0,0,0,.08);
}


.filter-box{
background:white;
padding:20px;
border-radius:20px;
}


.order-row{
background:white;
padding:30px;
border-radius:25px;
margin-bottom:25px;
box-shadow:0 8px 20px rgba(0,0,0,.08);
}


.order-header{
display:flex;
justify-content:space-between;
align-items:center;
}


.status{
padding:8px 18px;
border-radius:20px;
font-weight:700;
}


.pending{
background:#fff3cd;
}


.preparing{
background:#cff4fc;
}


.completed{
background:#d1e7dd;
}


</style>


@endsection