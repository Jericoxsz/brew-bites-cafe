@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="fw-bold mb-4">
Edit Product
</h1>

@if($errors->any())

<div class="alert alert-danger">
<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>

@endif


<form action="/admin/products/{{ $product->id }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')


<div class="mb-3">
<label class="form-label fw-semibold">
Category
</label>

<select name="category_id" class="form-select">

@foreach($categories as $category)

<option value="{{ $category->id }}"
{{ $product->category_id == $category->id ? 'selected':'' }}>

{{ $category->name }}

</option>

@endforeach

</select>

</div>


<div class="mb-3">

<label class="form-label fw-semibold">
Product Name
</label>

<input type="text"
name="name"
class="form-control"
value="{{ $product->name }}">

</div>


<div class="mb-3">

<label class="form-label fw-semibold">
Price
</label>

<input type="number"
name="price"
class="form-control"
value="{{ $product->price }}">

</div>


<div class="mb-3">

<label class="form-label fw-semibold">
Stock
</label>

<input type="number"
name="stock"
class="form-control"
value="{{ $product->stock }}">

</div>


<div class="mb-4">

<label class="form-label fw-semibold">
Product Image
</label>


<input type="file"
id="imageInput"
class="form-control"
accept="image/*">


<div class="row mt-4">


<div class="col-lg-6 mb-4">

<h5 class="fw-bold">
Adjust Image
</h5>


<div style="width:100%;max-width:500px;height:500px;overflow:hidden;background:#eee;border-radius:15px;">

<img id="imagePreview"
style="max-width:100%;">

</div>


<button type="button"
id="cropButton"
class="btn btn-warning mt-3">

Crop Image

</button>


</div>



<div class="col-lg-6">

<h5 class="fw-bold">
Final Preview
</h5>


<img id="croppedPreview"
style="width:250px;height:250px;object-fit:cover;border-radius:15px;display:none;">

</div>


</div>


<input type="hidden"
name="cropped_image"
id="croppedImage">


</div>


<button class="btn"
style="background:#6f4e37;color:white;">

Update Product

</button>


</form>

</div>

<script>

let cropper;

const imagePreview = document.getElementById('imagePreview');
const croppedPreview = document.getElementById('croppedPreview');
const croppedImage = document.getElementById('croppedImage');
const imageInput = document.getElementById('imageInput');
const cropButton = document.getElementById('cropButton');


function startCrop(source){

imagePreview.src = source;

imagePreview.onload = function(){

if(cropper){
cropper.destroy();
}


cropper = new Cropper(imagePreview,{
aspectRatio:1,
viewMode:1,
dragMode:'move',
autoCropArea:1,
background:false,
responsive:true,
zoomable:true,
movable:true
});


cropImage();

};

}



function cropImage(){

if(!cropper){
return;
}


let canvas = cropper.getCroppedCanvas({
width:500,
height:500
});


let imageData = canvas.toDataURL('image/jpeg');


croppedImage.value = imageData;


croppedPreview.src = imageData;

croppedPreview.style.display='block';

}



cropButton.addEventListener('click',function(){

cropImage();

});



imageInput.addEventListener('change',function(e){

let file = e.target.files[0];


if(file){

startCrop(URL.createObjectURL(file));

}

});



document.addEventListener("DOMContentLoaded",function(){

@if($product->image)

startCrop("{{ asset('storage/'.$product->image) }}");

@endif

});


</script>


@endsection