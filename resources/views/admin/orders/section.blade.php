<div class="mb-5">

<h2 class="fw-bold mb-3">
{{ $title }}
</h2>


@if($orders->count())


<div class="row">


@foreach($orders as $order)


<div class="col-lg-6 mb-4">


<div class="card shadow border-0 h-100">


<div class="card-body">


<div class="d-flex justify-content-between align-items-center">


<h3 class="fw-bold">
Order #{{ $order->id }}
</h3>


@if($order->status == 'Pending')

<span class="badge bg-warning text-dark">
Pending
</span>

@elseif($order->status == 'Preparing')

<span class="badge bg-primary">
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


</div>


<hr>


<p>
Customer:
<strong>
{{ $order->user->name }}
</strong>
</p>


<p>
Order Date:
{{ $order->created_at->format('M d, Y h:i A') }}
</p>


<h5 class="fw-bold">
Items:
</h5>


<ul>

@foreach($order->items as $item)

<li>
{{ $item->product->name }}
x{{ $item->quantity }}
</li>

@endforeach

</ul>


<h4 class="fw-bold">
Total:
₱{{ number_format($order->total,2) }}
</h4>



@if($next)

<form action="/admin/orders/{{ $order->id }}"
method="POST">

@csrf
@method('PUT')


<input type="hidden"
name="status"
value="{{ $next }}">


<button class="btn btn-dark">

Move to {{ $next }}

</button>


</form>


@endif



@if($order->status != 'Completed' && $order->status != 'Cancelled')


<form action="/admin/orders/{{ $order->id }}"
method="POST"
class="mt-2">

@csrf
@method('PUT')


<input type="hidden"
name="status"
value="Cancelled">


<button class="btn btn-danger">

Cancel Order

</button>


</form>


@endif


</div>

</div>


</div>


@endforeach


</div>


@else

<div class="alert alert-secondary">

No orders available.

</div>

@endif


</div>