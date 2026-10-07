@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="fw-bold mb-4">
📦 Order Management
</h1>


<div class="row g-4 mb-4">

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

<div class="row g-3">

<div class="col-md-5">

<input type="text"
id="searchOrder"
class="form-control"
placeholder="Search customer...">

</div>


<div class="col-md-4">

<select id="statusFilter"
class="form-select">

<option value="">
All Status
</option>

<option value="Pending">
Pending
</option>

<option value="Preparing">
Preparing
</option>

<option value="Completed">
Completed
</option>

</select>

</div>


<div class="col-md-3">

<select id="sortOrder"
class="form-select">

<option value="new">
Newest First
</option>

<option value="old">
Oldest First
</option>

</select>

</div>


</div>

</div>





<div class="orders-list"
id="orderList">


@foreach($orders as $order)


<div class="order-row order-item"

data-customer="{{$order->user->name}}"

data-status="{{$order->status}}"

data-date="{{$order->created_at->timestamp}}">


<div class="order-header">

<h2>
Order #{{$order->id}}
</h2>


<span class="status {{strtolower($order->status)}}">

{{$order->status}}

</span>


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



<a href="/admin/orders/{{$order->id}}"
class="btn btn-outline-custom">

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
height:100%;

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
gap:15px;

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



.price{

font-size:28px;

}




@media(max-width:768px){


.container-fluid{

padding:10px;

}


.stat-card{

padding:18px;

}


.filter-box{

padding:15px;

}


.order-row{

padding:20px;
border-radius:18px;

}


.order-header{

flex-direction:column;
align-items:flex-start;

}


.order-header h2{

font-size:22px;

}


}

</style>




<script>

const searchOrder=document.getElementById('searchOrder');

const statusFilter=document.getElementById('statusFilter');

const sortOrder=document.getElementById('sortOrder');

const orders=document.querySelectorAll('.order-item');



function filterOrders(){


let search=searchOrder.value.toLowerCase();

let status=statusFilter.value;


let list=[...orders];



list.forEach(order=>{


let customer=order.dataset.customer.toLowerCase();

let orderStatus=order.dataset.status;


order.style.display=

customer.includes(search)

&&

(!status || orderStatus===status)

?

"block"

:

"none";


});



if(sortOrder.value){


list.sort((a,b)=>{


let dateA=parseInt(a.dataset.date);

let dateB=parseInt(b.dataset.date);



return sortOrder.value==="new"

?

dateB-dateA

:

dateA-dateB;


});



let parent=document.getElementById('orderList');


list.forEach(order=>parent.appendChild(order));


}


}



searchOrder.addEventListener('input',filterOrders);

statusFilter.addEventListener('change',filterOrders);

sortOrder.addEventListener('change',filterOrders);


</script>


@endsection