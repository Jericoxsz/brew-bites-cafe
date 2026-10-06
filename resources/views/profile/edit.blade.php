@extends('layouts.cafe')

@section('content')

<div class="container py-5">

<h1 class="fw-bold mb-5">👤 My Profile</h1>

@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif


<div class="profile-list">


<div class="profile-card text-center">

@if(auth()->user()->profile_image)
<img src="{{asset('storage/'.auth()->user()->profile_image)}}" id="avatarPreview" class="avatar">
@else
<div id="avatarPreview" class="avatar default-avatar">👤</div>
@endif


<input type="file" id="imageInput" accept="image/*" class="form-control mt-4">


<div id="cropArea" class="d-none mt-3">

<img id="imagePreview" class="crop-image">

<button type="button" id="cropBtn" class="btn btn-outline-custom mt-3">
Crop Image
</button>

</div>


<form action="/profile" method="POST" enctype="multipart/form-data">

@csrf
@method('PATCH')

<input type="hidden" name="cropped_image" id="croppedImage">


<h3 class="fw-bold mt-4">
{{auth()->user()->name}}
</h3>

<p class="text-muted">
{{auth()->user()->email}}
</p>


<button class="btn btn-primary-custom">
Save Photo
</button>


</form>


</div>



<div class="profile-card">

<h3 class="fw-bold">
Account Information
</h3>

<hr>


<form action="/profile" method="POST">

@csrf
@method('PATCH')


<label class="fw-bold">
Name
</label>

<input type="text" name="name" class="form-control mb-3" value="{{auth()->user()->name}}">


<label class="fw-bold">
Email
</label>

<input type="email" name="email" class="form-control mb-3" value="{{auth()->user()->email}}">


<button class="btn btn-primary-custom">
Save Changes
</button>


</form>

</div>




<div class="profile-card">

<h3 class="fw-bold">
🔒 Change Password
</h3>

<hr>


<form action="/password" method="POST">

@csrf


<input type="password" name="password" class="form-control mb-3" placeholder="New Password">


<input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirm Password">


<button class="btn btn-primary-custom">
Update Password
</button>


</form>


</div>


</div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>


<script>

let cropper;

imageInput.onchange=function(e){

let file=e.target.files[0];

if(file){

imagePreview.src=URL.createObjectURL(file);

cropArea.classList.remove('d-none');


if(cropper){
cropper.destroy();
}


cropper=new Cropper(imagePreview,{
aspectRatio:1,
viewMode:1
});

}

};



cropBtn.onclick=function(){

let canvas=cropper.getCroppedCanvas({
width:400,
height:400
});


let image=canvas.toDataURL('image/jpeg');


croppedImage.value=image;


avatarPreview.src=image;


};


</script>



<style>

.profile-list{
display:flex;
flex-direction:column;
gap:25px;
max-width:900px;
margin:auto;
}


.profile-card{
background:white;
padding:35px;
border-radius:25px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}


.avatar{
width:170px;
height:170px;
border-radius:50%;
object-fit:cover;
}


.default-avatar{
background:#6f4e37;
color:white;
font-size:70px;
display:flex;
align-items:center;
justify-content:center;
margin:auto;
}


.crop-image{
width:100%;
max-height:350px;
object-fit:cover;
}


</style>


@endsection