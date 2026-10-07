@extends('layouts.admin')

@section('content')

<div class="container-fluid">


<h1 class="fw-bold mb-4">
📈 Inventory & Sales Analytics
</h1>



<div class="row g-4 mb-4">


<div class="col-lg-6">

<div class="analytics-card revenue-card">

<h5>
Total Revenue
</h5>

<h2>
₱{{number_format($totalRevenue,2)}}
</h2>

<p>
Overall sales revenue
</p>

</div>

</div>



<div class="col-lg-6">

<div class="analytics-card revenue-card">

<h5>
Monthly Revenue
</h5>

<h2>
₱{{number_format($monthlyRevenue,2)}}
</h2>

<p>
This month's completed sales
</p>

</div>
</div>
</div>



<div class="row g-4 mb-4">


<div class="col-lg-6 d-flex">


<div class="analytics-card w-100">


<h3>
🔥 Best Selling Products
</h3>



@foreach($sales as $index=>$sale)


<div class="list-item">


<div>

<span class="rank">

#{{$index+1}}

</span>


{{$sale->product->name}}

</div>


<strong>

{{$sale->total_sold}} sold

</strong>


</div>


@endforeach



</div>


</div>





<div class="col-lg-6 d-flex">


<div class="analytics-card w-100">


<h3>
💰 Revenue Breakdown
</h3>



@foreach($sales as $sale)


<div class="list-item">


<span>

{{$sale->product->name}}

</span>


<strong>

₱{{number_format($sale->revenue,2)}}

</strong>


</div>


@endforeach



</div>


</div>


</div>






<div class="analytics-card">


<h3 class="mb-4">
📦 Inventory Status
</h3>



<div class="table-responsive">


<table class="table align-middle">


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


<td class="fw-bold">

{{$product->name}}

</td>


<td>

{{$product->category->name}}

</td>


<td>

{{$product->stock}}

</td>


<td>


@if($product->stock == 0)

<span class="status out">

Out of Stock

</span>


@elseif($product->stock <=5)

<span class="status low">

Low Stock

</span>


@else

<span class="status available">

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






<style>


.analytics-card{

background:white;

border-radius:22px;

padding:25px;

box-shadow:0 8px 20px rgba(0,0,0,.08);

height:100%;

}



.revenue-card{

text-align:center;

}



.revenue-card h5{

font-weight:700;

color:#4b2e1f;

}



.revenue-card h2{

font-size:38px;

font-weight:800;

margin:15px 0;

}



.revenue-card p{

color:#6b7280;

}




.analytics-card h3{

font-weight:800;

color:#4b2e1f;

margin-bottom:20px;

}



.list-item{

display:flex;

justify-content:space-between;

align-items:center;

padding:12px 0;

border-bottom:1px solid #eee;

}



.list-item:last-child{

border-bottom:none;

}



.rank{

background:#f3e5d0;

color:#6f4e37;

padding:5px 10px;

border-radius:15px;

font-weight:700;

margin-right:8px;

}



.status{

padding:6px 14px;

border-radius:20px;

font-weight:700;

font-size:13px;

}



.available{

background:#d1e7dd;

color:#146c43;

}



.low{

background:#fff3cd;

color:#856404;

}



.out{

background:#f8d7da;

color:#842029;

}



.table th{

color:#4b2e1f;

}



@media(max-width:768px){


.analytics-card{

padding:18px;

}



.revenue-card h2{

font-size:30px;

}



.list-item{

font-size:14px;

}


}

</style>


@endsection