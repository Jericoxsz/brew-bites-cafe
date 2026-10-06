@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h1 class="fw-bold mb-4">
👤 Account Settings
</h1>


@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif


@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif



<div class="row">


<div class="col-lg-5 mb-4">


<div class="card shadow border-0">

<div class="card-body text-center">


<h3 class="fw-bold mb-4">
Profile
</h3>



@if($user->profile_image)

<img src="{{ asset('storage/'.$user->profile_image) }}"
class="profile-image">


@else

<div class="avatar-placeholder">
👤
</div>

@endif



<form action="/admin/profile"
method="POST">

@csrf
@method('PUT')



<input type="file"
id="imageInput"
class="form-control mt-4"
accept="image/*">



<div id="cropArea"
style="display:none;"
class="mt-3">


<h5>
Adjust Image
</h5>


<div class="crop-box">

<img id="imagePreview">

</div>


<button type="button"
id="cropButton"
class="btn btn-warning mt-3">

Crop Image

</button>


</div>




<img id="finalPreview"
class="profile-image mt-3"
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
value="{{ $user->name }}">





<label class="form-label fw-bold mt-3">
Email
</label>


<input type="email"
name="email"
class="form-control"
value="{{ $user->email }}">



<p class="mt-3">
🛡 Administrator
</p>



<button class="btn mt-3"
style="background:#6f4e37;color:white;">

Save Profile

</button>


</form>


</div>

</div>


</div>





<div class="col-lg-7">


<div class="card shadow border-0">


<div class="card-body">


<h3 class="fw-bold">
🔒 Change Password
</h3>


<form action="/admin/profile/password"
method="POST"
class="mt-4">


@csrf
@method('PUT')


<label>
Current Password
</label>

<input type="password"
name="current_password"
class="form-control mb-3">



<label>
New Password
</label>

<input type="password"
name="password"
class="form-control mb-3">



<label>
Confirm Password
</label>

<input type="password"
name="password_confirmation"
class="form-control mb-3">



<button class="btn btn-dark">

Update Password

</button>


</form>


</div>


</div>


</div>


</div>


</div>



<style>

.profile-image{

width:180px;
height:180px;
border-radius:50%;
object-fit:cover;

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


.crop-box{

width:350px;
height:350px;
margin:auto;
overflow:hidden;

}


.crop-box img{

max-width:100%;

}

</style>




<script>

let cropper;


const imageInput =
document.getElementById('imageInput');


const imagePreview =
document.getElementById('imagePreview');


const cropArea =
document.getElementById('cropArea');


const cropButton =
document.getElementById('cropButton');


const croppedImage =
document.getElementById('croppedImage');


const finalPreview =
document.getElementById('finalPreview');



imageInput.addEventListener('change',function(e){


const file=e.target.files[0];


if(file){


imagePreview.src =
URL.createObjectURL(file);


cropArea.style.display='block';



if(cropper){

cropper.destroy();

}



cropper = new Cropper(imagePreview,{

aspectRatio:1,

viewMode:1,

dragMode:'move',

autoCropArea:1

});


}

});



cropButton.addEventListener('click',function(){


const canvas =
cropper.getCroppedCanvas({

width:500,

height:500

});



const imageData =
canvas.toDataURL('image/jpeg');



croppedImage.value=imageData;


finalPreview.src=imageData;


finalPreview.style.display='block';



});


</script>


@endsection