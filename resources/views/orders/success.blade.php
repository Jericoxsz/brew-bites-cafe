@extends('layouts.cafe')

@section('content')

<div class="container py-5">


<div class="success-card text-center">


<div class="success-icon">

✓

</div>


<h1 class="fw-bold mt-4">

Order Placed Successfully!

</h1>



<p class="lead text-muted">

Thank you for your order,
{{ $order->user->name }}.

</p>




<div class="order-number">


<h5>
Order Number
</h5>


<h2 class="fw-bold">

#{{ $order->id }}

</h2>


</div>




<div class="status-box">


<h5>
Current Status
</h5>


<span class="badge bg-warning text-dark">

🟡 Pending

</span>


</div>




<div class="mt-4">


<a href="/orders"
class="btn btn-primary-custom">

📦 View My Orders

</a>


<a href="/products"
class="btn btn-outline-custom ms-2">

Continue Shopping

</a>


</div>



</div>


</div>




<style>


.success-card{

background:white;

padding:50px;

border-radius:30px;

box-shadow:0 15px 35px rgba(0,0,0,.1);

max-width:700px;

margin:auto;

}



.success-icon{

width:90px;

height:90px;

border-radius:50%;

background:#6f4e37;

color:white;

font-size:50px;

display:flex;

align-items:center;

justify-content:center;

margin:auto;

}



.order-number{

background:#f8f1e7;

padding:20px;

border-radius:20px;

margin-top:30px;

}



.status-box{

margin-top:20px;

}



</style>


@endsection