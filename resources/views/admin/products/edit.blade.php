@extends('layouts.admin')

@section('content')

<div class="container-fluid d-flex justify-content-center">

<div class="receipt-card">


<h2 class="text-center fw-bold mb-4">
Edit Product
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



<form action="/admin/products/{{ $product->id }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')



<div class="field">

<label>Category</label>

<select name="category_id"
class="form-control">

@foreach($categories as $category)

<option value="{{ $category->id }}"
{{ $product->category_id == $category->id ? 'selected':'' }}>

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
value="{{ $product->name }}">

</div>




<div class="row">

<div class="col-6">

<div class="field">

<label>Price</label>

<input type="number"
name="price"
class="form-control"
value="{{ $product->price }}">

</div>

</div>



<div class="col-6">

<div class="field">

<label>Stock</label>

<input type="number"
name="stock"
class="form-control"
value="{{ $product->stock }}">

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






<div class="image-section mt-4">


<label>Final Preview</label>


<div>

<img id="croppedPreview"
class="preview-image">

</div>


</div>





<input type="hidden"
name="cropped_image"
id="croppedImage">





<button class="update-btn">

Update Product

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

font-weight:700;

color:#4b2e1f;

margin-bottom:8px;

display:block;

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

background:#f3f3f3;

border-radius:12px;

}



.crop-box img{

max-width:100%;

}



.crop-btn{

margin-top:15px;

background:#6f4e37;

color:white;

border:none;

padding:12px 25px;

border-radius:25px;

font-weight:700;

}



.preview-image{

width:220px;

height:220px;

object-fit:cover;

border-radius:12px;

display:none;

}



.update-btn{

width:100%;

margin-top:25px;

padding:14px;

border:none;

border-radius:25px;

background:#6f4e37;

color:white;

font-weight:700;

font-size:16px;

}



.update-btn:hover,
.crop-btn:hover{

background:#4b2e1f;

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





document.addEventListener("DOMContentLoaded",function(){


@if($product->image)

startCrop("{{ asset('storage/'.$product->image) }}");

@endif


});


</script>


@endsection