@extends('layouts.admin')

@section('content')

<div class="container-fluid d-flex justify-content-center">

<div class="receipt-card">


<h2 class="text-center fw-bold mb-4">
+ Add Product
</h2>



@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif




<form action="/admin/products"
method="POST"
enctype="multipart/form-data">

@csrf



<div class="field">

<label>Category</label>

<select name="category_id"
class="form-control">

<option value="">
Select Category
</option>


@foreach($categories as $category)

<option value="{{ $category->id }}">

{{ $category->name }}

</option>

@endforeach


</select>

</div>




<div class="field">

<label>Product Name</label>

<input type="text"
name="name"
class="form-control"
placeholder="Enter product name">

</div>





<div class="row">


<div class="col-6">

<div class="field">

<label>Price</label>

<input type="number"
name="price"
class="form-control"
placeholder="0.00">

</div>

</div>




<div class="col-6">

<div class="field">

<label>Stock</label>

<input type="number"
name="stock"
class="form-control"
placeholder="0">

</div>

</div>


</div>






<div class="field">

<label>Product Image</label>


<input type="file"
id="imageInput"
class="form-control"
accept="image/*">


</div>





<div class="image-section">


<label>Adjust Image</label>


<div class="crop-box">


<img id="imagePreview">


</div>



<button type="button"
id="cropButton"
class="crop-btn">

Crop Image

</button>


</div>





<div class="image-section">


<label>Final Preview</label>


<img id="croppedPreview"
class="preview-image">


</div>






<input type="hidden"
name="cropped_image"
id="croppedImage">





<button class="save-btn">

Save Product

</button>



</form>


</div>

</div>





<style>


.receipt-card{

background:white;

width:100%;

max-width:600px;

padding:35px;

border-radius:15px;

box-shadow:0 10px 30px rgba(0,0,0,.08);

border:1px solid #eee;

}



.receipt-card h2{

color:#4b2e1f;

}



.field{

margin-bottom:18px;

}



.field label,
.image-section label{

display:block;

font-weight:700;

color:#4b2e1f;

margin-bottom:8px;

}



.form-control{

border-radius:10px;

padding:12px;

}



.image-section{

margin-top:20px;

padding-top:20px;

border-top:1px dashed #ccc;

}



.crop-box{

height:320px;

overflow:hidden;

background:#eee;

border-radius:12px;

}



.crop-box img{

max-width:100%;

}



.crop-btn,
.save-btn{

background:#6f4e37;

color:white;

border:none;

padding:12px 25px;

border-radius:25px;

font-weight:700;

}



.crop-btn{

margin-top:15px;

}



.save-btn{

width:100%;

margin-top:25px;

}



.crop-btn:hover,
.save-btn:hover{

background:#4b2e1f;

}



.preview-image{

width:220px;

height:220px;

object-fit:cover;

border-radius:12px;

display:none;

}



@media(max-width:768px){


.receipt-card{

padding:20px;

}


.crop-box{

height:260px;

}


.preview-image{

width:180px;

height:180px;

}


}


</style>





<script>

let cropper;


const imagePreview=document.getElementById('imagePreview');

const croppedPreview=document.getElementById('croppedPreview');

const croppedImage=document.getElementById('croppedImage');

const imageInput=document.getElementById('imageInput');

const cropButton=document.getElementById('cropButton');



function startCrop(source){

imagePreview.src=source;


imagePreview.onload=function(){


if(cropper){

cropper.destroy();

}



cropper=new Cropper(imagePreview,{

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


let canvas=cropper.getCroppedCanvas({

width:500,

height:500

});


let imageData=canvas.toDataURL('image/jpeg');


croppedImage.value=imageData;


croppedPreview.src=imageData;

croppedPreview.style.display='block';

}




cropButton.addEventListener('click',function(){

cropImage();

});





imageInput.addEventListener('change',function(e){


let file=e.target.files[0];


if(file){

startCrop(URL.createObjectURL(file));

}


});


</script>


@endsection