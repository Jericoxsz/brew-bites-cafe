@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="fw-bold mb-4">
+ Add Product
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


<form action="/admin/products" method="POST" enctype="multipart/form-data">

@csrf


<div class="mb-3">

<label class="form-label fw-semibold">
Category
</label>

<select name="category_id" class="form-select">

@foreach($categories as $category)

<option value="{{ $category->id }}">
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
class="form-control">

</div>


<div class="mb-3">

<label class="form-label fw-semibold">
Price
</label>

<input type="number"
name="price"
class="form-control">

</div>


<div class="mb-3">

<label class="form-label fw-semibold">
Stock
</label>

<input type="number"
name="stock"
class="form-control">

</div>


<div class="mb-4">

<label class="form-label fw-semibold">
Product Image
</label>

<input type="file"
id="imageInput"
class="form-control"
accept="image/*">


<div class="row mt-4 d-none" id="cropContainer">


<div class="col-md-6">

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


<div class="col-md-6">

<h5 class="fw-bold">
Final Preview
</h5>


<div style="width:250px;height:250px;">

<img id="croppedPreview"
style="width:250px;height:250px;object-fit:cover;border-radius:15px;display:none;">

</div>


</div>


</div>


<input type="hidden"
name="cropped_image"
id="croppedImage">


</div>


<button class="btn"
style="background:#6f4e37;color:white;">

Save Product

</button>


</form>

</div>


<script>

let cropper;

const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');
const cropContainer = document.getElementById('cropContainer');
const cropButton = document.getElementById('cropButton');
const croppedImage = document.getElementById('croppedImage');
const croppedPreview = document.getElementById('croppedPreview');


imageInput.addEventListener('change', function(event){

const file = event.target.files[0];

if(file){

imagePreview.src = URL.createObjectURL(file);

cropContainer.classList.remove('d-none');


if(cropper){
cropper.destroy();
}


cropper = new Cropper(imagePreview,{
aspectRatio:1,
viewMode:1,
dragMode:'move',
autoCropArea:1,
zoomable:true,
movable:true
});

}

});


cropButton.addEventListener('click', function(){

const canvas = cropper.getCroppedCanvas({
width:500,
height:500
});


const imageData = canvas.toDataURL('image/jpeg');


croppedImage.value = imageData;

croppedPreview.src = imageData;

croppedPreview.style.display='block';


});

</script>


@endsection