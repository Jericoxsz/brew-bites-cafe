@extends('layouts.admin')

@section('content')

<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h1 class="fw-bold">
📦 Order #{{ $order->id }}
</h1>

<p class="text-muted">
Order details and customer information.
</p>

</div>


<a href="/admin/orders"
class="btn btn-outline-dark">

Back to Orders

</a>


</div>



<div class="row">


<div class="col-lg-4 mb-4">


<div class="card shadow border-0">

<div class="card-body">


<h3 class="fw-bold">
Customer
</h3>

<p class="fs-5">
{{ $order->user->name }}
</p>



<h3 class="fw-bold mt-4">
Order Date
</h3>

<p>
{{ $order->created_at->format('M d, Y h:i A') }}
</p>



<h3 class="fw-bold mt-4">
Status
</h3>


@if($order->status == 'Pending')

<span class="badge bg-warning text-dark fs-6">
Pending
</span>

@elseif($order->status == 'Preparing')

<span class="badge bg-primary fs-6">
Preparing
</span>

@elseif($order->status == 'Completed')

<span class="badge bg-success fs-6">
Completed
</span>

@else

<span class="badge bg-danger fs-6">
Cancelled
</span>

@endif



</div>

</div>


</div>




<div class="col-lg-8">


<div class="card shadow border-0">


<div class="card-body">


<h3 class="fw-bold mb-4">
Order Items
</h3>



@foreach($order->items as $item)


<div class="d-flex justify-content-between align-items-center mb-3">


<div>


<h5 class="fw-bold mb-1">

{{ $item->product->name }}

</h5>


<p class="text-muted mb-0">

Quantity:
{{ $item->quantity }}

</p>


</div>



<div class="text-end">


<p class="mb-1">

₱{{ number_format($item->price,2) }}

</p>


<strong>

₱{{ number_format($item->price * $item->quantity,2) }}

</strong>


</div>


</div>


<hr>


@endforeach



<div class="text-end mt-4">


<h3 class="fw-bold">

Total:
₱{{ number_format($order->total_amount,2) }}

</h3>


</div>



</div>

</div>


</div>



</div>


</div>


@endsection