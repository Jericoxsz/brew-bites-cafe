@extends('layouts.cafe')

@section('content')

<div class="container py-5">


<h1 class="fw-bold mb-5">
📦 My Orders
</h1>



@if($orders->count() == 0)


<div class="empty-orders text-center">


<div class="empty-state">


<div class="empty-icon">

📦

</div>


<h2 class="fw-bold">

No Orders Yet

</h2>


<p class="text-muted">

Start ordering your favorite coffee and meals.

</p>


<a href="/products"
class="btn btn-primary-custom mt-3">

Order Now

</a>


</div>


<a href="/products"
class="btn btn-primary-custom mt-3">

Order Now

</a>


</div>


@else



@foreach($orders as $order)



<div class="order-card mb-4">



<div class="d-flex justify-content-between align-items-center">


<h3 class="fw-bold">

Order #{{ $order->id }}

</h3>



@if($order->status == 'Pending')


<span class="status pending">

🟡 Pending

</span>


@elseif($order->status == 'Preparing')


<span class="status preparing">

🔵 Preparing

</span>


@elseif($order->status == 'Completed')


<span class="status completed">

🟢 Completed

</span>


@else


<span class="status cancelled">

🔴 Cancelled

</span>


@endif



</div>




<p class="text-muted mt-2">

📅 {{ $order->created_at->format('M d, Y h:i A') }}

</p>




<hr>




<h5 class="fw-bold">

Items

</h5>



<ul>


@foreach($order->items as $item)


<li>

{{ $item->product->name }}

x{{ $item->quantity }}

</li>


@endforeach


</ul>



<h4 class="fw-bold price">

Total:
₱{{ number_format($order->total_amount,2) }}

</h4>






@if($order->status != 'Cancelled')

<div class="order-progress mt-4">



<div class="progress-step 
{{ in_array($order->status,['Pending','Preparing','Completed']) ? 'active':'' }}">

<div>
🟡
</div>

Pending

</div>




<div class="progress-line
{{ in_array($order->status,['Preparing','Completed']) ? 'active':'' }}">
</div>




<div class="progress-step
{{ in_array($order->status,['Preparing','Completed']) ? 'active':'' }}">

<div>
🔵
</div>

Preparing

</div>





<div class="progress-line
{{ $order->status == 'Completed' ? 'active':'' }}">
</div>





<div class="progress-step
{{ $order->status == 'Completed' ? 'active':'' }}">

<div>
🟢
</div>

Completed

</div>



</div>

@else


<div class="alert alert-danger mt-4">

This order has been cancelled.

</div>


@endif



</div>



@endforeach



@endif


</div>





<style>


.order-card{

background:white;

padding:30px;

border-radius:25px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

}



.status{

padding:8px 16px;

border-radius:20px;

font-weight:600;

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



.cancelled{

background:#f8d7da;

}





.order-progress{

display:flex;

align-items:center;

justify-content:center;

gap:15px;

}



.progress-step{

text-align:center;

opacity:.35;

font-weight:700;

}



.progress-step.active{

opacity:1;

}



.progress-line{

height:4px;

width:80px;

background:#ddd;

}



.progress-line.active{

background:#6f4e37;

}





@media(max-width:768px){


.order-progress{

flex-direction:column;

}


.progress-line{

width:4px;

height:40px;

}


}



</style>


@endsection