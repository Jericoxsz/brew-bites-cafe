@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="page-title">
👤 Account Settings
</h1>


@if(session('success'))
<div class="alert alert-success">
{{session('success')}}
</div>
@endif


@if($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif



<div class="receipt-card">


<h2 class="text-center fw-bold">
Profile
</h2>



<div class="text-center mt-4">


@if($user->profile_image)

<img src="{{asset('storage/'.$user->profile_image)}}"
class="profile-image">

@else

<div class="avatar-placeholder">
👤
</div>

@endif


</div>




<form action="/admin/profile"
method="POST">

@csrf
@method('PUT')



<label class="form-label fw-bold mt-4">
Profile Image
</label>


<input type="file"
id="imageInput"
class="form-control"
accept="image/*">





<div id="cropArea"
style="display:none;">


<label class="form-label fw-bold mt-4">
Adjust Image
</label>


<div class="crop-box">

<img id="imagePreview">

</div>



<button type="button"
id="cropButton"
class="crop-btn">

Crop Image

</button>


</div>




<img id="finalPreview"
class="profile-image mt-4"
style="display:none;">





<input type="hidden"
name="profile_image"
id="croppedImage">






<label class="form-label fw-bold mt-4">
Name
</label>


<input type="text"
name="name"
class="form-control"
value="{{$user->name}}">





<label class="form-label fw-bold mt-4">
Email
</label>


<input type="email"
name="email"
class="form-control"
value="{{$user->email}}">





<div class="role-box mt-4">
🛡 Administrator
</div>




<button class="save-btn mt-4">

Save Profile

</button>



</form>





<div class="divider"></div>





<h2 class="fw-bold text-center">
🔒 Change Password
</h2>





<form action="/admin/profile/password"
method="POST">

@csrf
@method('PUT')



<label class="form-label mt-4">
Current Password
</label>

<input type="password"
name="current_password"
class="form-control">





<label class="form-label mt-3">
New Password
</label>

<input type="password"
name="password"
class="form-control">





<label class="form-label mt-3">
Confirm Password
</label>

<input type="password"
name="password_confirmation"
class="form-control">





<button class="password-btn mt-4">

Update Password

</button>



</form>



</div>


</div>





<style>

.page-title{

font-size:48px;
font-weight:800;
color:#2b2118;
margin-bottom:25px;

}



.receipt-card{

background:white;

max-width:650px;

margin:auto;

padding:35px;

border-radius:25px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

}



.profile-image{

width:180px;

height:180px;

border-radius:50%;

object-fit:cover;

border:6px solid #f3e5d0;

}



.avatar-placeholder{

width:180px;

height:180px;

border-radius:50%;

background:#6f4e37;

color:white;

font-size:70px;

display:flex;

align-items:center;

justify-content:center;

margin:auto;

}



.form-control{

height:52px;

border-radius:14px;

}



.crop-box{

width:100%;

max-width:350px;

height:250px;

margin:20px auto;

overflow:hidden;

border-radius:15px;

background:#eee;

}



.crop-box img{

max-width:100%;

}



.crop-btn,
.save-btn,
.password-btn{

width:100%;

border:none;

padding:13px;

border-radius:20px;

font-weight:700;

color:white;

background:#6f4e37;

}



.crop-btn:hover,
.save-btn:hover{

background:#4b2e1f;

}



.password-btn{

background:#1f2937;

}



.role-box{

background:#faf5ef;

padding:14px;

border-radius:15px;

text-align:center;

font-weight:700;

}



.divider{

border-top:2px dashed #ddd;

margin:35px 0;

}



@media(max-width:768px){

.page-title{

font-size:30px;

}


.receipt-card{

padding:20px;

}


.profile-image,
.avatar-placeholder{

width:130px;

height:130px;

}

}

</style>





<script>

let cropper;


const imageInput=document.getElementById('imageInput');

const imagePreview=document.getElementById('imagePreview');

const cropArea=document.getElementById('cropArea');

const cropButton=document.getElementById('cropButton');

const croppedImage=document.getElementById('croppedImage');

const finalPreview=document.getElementById('finalPreview');




imageInput.addEventListener('change',function(e){


const file=e.target.files[0];


if(file){


imagePreview.src=URL.createObjectURL(file);

cropArea.style.display='block';



if(cropper){

cropper.destroy();

}



cropper=new Cropper(imagePreview,{

aspectRatio:1,

viewMode:1,

dragMode:'move',

autoCropArea:1

});


}


});





cropButton.addEventListener('click',function(){


const canvas=cropper.getCroppedCanvas({

width:500,

height:500

});


const imageData=canvas.toDataURL('image/jpeg');


croppedImage.value=imageData;


finalPreview.src=imageData;


finalPreview.style.display='block';



});


</script>


@endsection