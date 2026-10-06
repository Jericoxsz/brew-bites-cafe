@extends('layouts.cafe')
@section('content')

<section class="hero-section">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-12">
<h1 class="hero-title">☕ Brew & Bites Café</h1>
<h2 class="hero-subtitle">Your daily coffee, pastries, and comfort meals.</h2>
<p class="lead mt-3">Freshly brewed coffee. Fresh pastries. Made with love everyday.</p>

<div class="mt-4">
<a href="/products" class="btn btn-primary-custom btn-lg">Order Now</a>
<a href="/products" class="btn btn-outline-custom btn-lg ms-2">View Menu</a>
</div>
</div>
</div>
</div>
</section>


<section class="container mt-5">
<h2 class="section-title text-center">Popular Favorites</h2>
<p class="text-center text-muted mb-4">Customer favorites from our café.</p>

<div class="row">
@foreach($products as $product)
<div class="col-lg-4 col-md-6 mb-4">
<div class="product-card h-100">

@if($product->image)
<img src="{{asset('storage/'.$product->image)}}" class="product-image">
@else
<div class="product-placeholder">☕</div>
@endif

<div class="p-4 d-flex flex-column">

<span class="category-badge">{{$product->category->name}}</span>

<h3 class="fw-bold mt-3">{{$product->name}}</h3>

<h4 class="price">₱{{number_format($product->price,2)}}</h4>

@if($product->stock > 0)
<div class="stock-status available"><span>●</span> In Stock</div>
@else
<div class="stock-status unavailable"><span>●</span> Out of Stock</div>
@endif

<a href="/products/{{$product->id}}" class="btn btn-primary-custom w-100 mt-auto">
View Product
</a>

</div>
</div>
</div>
@endforeach
</div>
</section>


<section class="category-section mt-5 py-5">
<div class="container">

<h2 class="section-title text-center">Explore Categories</h2>
<p class="text-center text-muted mb-5">Find your favorite drinks and meals.</p>

<div class="row justify-content-center">

@foreach(\App\Models\Category::all() as $category)

<div class="col-lg-3 col-md-6 mb-4">

<a href="/products?category={{$category->id}}" class="category-link">

<div class="category-card">

<div class="category-icon">{{$category->icon}}</div>

<h4>{{$category->name}}</h4>

<p>Browse {{strtolower($category->name)}}</p>

</div>

</a>

</div>

@endforeach

</div>

</div>
</section>


<section class="container py-5 mb-5">

<h2 class="section-title text-center">Why Choose Brew & Bites?</h2>

<p class="text-center text-muted mb-5">
More than coffee, we create memorable moments.
</p>

<div class="row">

<div class="col-lg-4 mb-4">
<div class="info-card">
<div class="info-icon">☕</div>
<h4>Fresh Coffee</h4>
<p>Premium coffee prepared fresh daily.</p>
</div>
</div>

<div class="col-lg-4 mb-4">
<div class="info-card">
<div class="info-icon">🥐</div>
<h4>Fresh Pastries</h4>
<p>Delicious baked goods made with care.</p>
</div>
</div>

<div class="col-lg-4 mb-4">
<div class="info-card">
<div class="info-icon">⚡</div>
<h4>Fast Service</h4>
<p>Easy ordering and smooth checkout.</p>
</div>
</div>

</div>
</section>

@endsection