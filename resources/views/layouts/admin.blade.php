<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Brew & Bites Admin</title>

@vite(['resources/css/app.css','resources/js/app.js'])

<style>

body{
    margin:0;
    background:#f8f1e7;
}

.admin-wrapper{
    min-height:100vh;
    display:flex;
}

.admin-sidebar{
    width:290px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:linear-gradient(180deg,#4b2e1f,#603a24);
    color:white;
    padding:28px 20px;
    z-index:1000;
}

.admin-main{
    margin-left:290px;
    width:calc(100% - 290px);
    min-height:100vh;
    display:flex;
    flex-direction:column;
}

.admin-content{
    flex:1;
    padding:28px;
}


.profile-box{

background:rgba(255,255,255,.12);
border-radius:15px;
padding:15px;
text-align:center;
margin:25px 0;

}


.profile-box img{

width:70px;
height:70px;
border-radius:50%;
object-fit:cover;

}


.profile-avatar{

width:70px;
height:70px;
border-radius:50%;
background:white;
color:#4b2e1f;
font-size:35px;
display:flex;
align-items:center;
justify-content:center;
margin:auto;

}


.profile-name{

font-weight:700;
margin-top:10px;

}


.profile-email{

font-size:13px;
color:rgba(255,255,255,.7);

}



.sidebar-link{

display:flex;
align-items:center;
gap:12px;
padding:14px 16px;
margin-bottom:10px;
border-radius:14px;
color:white;
text-decoration:none;
font-size:17px;
font-weight:700;

}


.sidebar-link:hover,
.sidebar-link.active{

background:white;
color:#4b2e1f;

}


.logout-btn{

width:100%;
padding:12px;
border-radius:14px;
background:none;
border:1px solid rgba(255,255,255,.4);
color:white;
font-weight:700;

}



.mobile-header{

display:none;

}



@media(max-width:768px){

.admin-sidebar{

transform:translateX(-100%);

}

.admin-sidebar.show{

transform:translateX(0);

}

.admin-main{

margin-left:0;
width:100%;

}

.mobile-header{

display:flex;

}

}


</style>

</head>


<body>


<div class="admin-wrapper">


<aside class="admin-sidebar">


<h2 class="fw-bold">
☕ Brew & Bites
</h2>


<p class="text-white-50">
ADMIN PANEL
</p>



<div class="profile-box">


@if(Auth::user()->profile_image)

<img src="{{ asset('storage/'.Auth::user()->profile_image) }}">


@else

<div class="profile-avatar">
👤
</div>

@endif



<div class="profile-name">

{{ Auth::user()->name }}

</div>


<div class="profile-email">

{{ Auth::user()->email }}

</div>


</div>



<hr>



<a href="/admin/dashboard"
class="sidebar-link {{ request()->is('admin/dashboard') ? 'active':'' }}">

📊 Dashboard

</a>



<a href="/admin/products"
class="sidebar-link {{ request()->is('admin/products*') ? 'active':'' }}">

☕ Products

</a>



<a href="/admin/categories"
class="sidebar-link {{ request()->is('admin/categories*') ? 'active':'' }}">

📂 Categories

</a>



<a href="/admin/orders"
class="sidebar-link {{ request()->is('admin/orders*') ? 'active':'' }}">

📦 Orders

</a>



<a href="/admin/inventory"
class="sidebar-link {{ request()->is('admin/inventory*') ? 'active':'' }}">

📈 Inventory

</a>



<a href="/admin/profile"
class="sidebar-link {{ request()->is('admin/profile') ? 'active':'' }}">

👤 Profile

</a>



<hr>



<form method="POST" action="/logout">

@csrf

<button class="logout-btn">

Logout

</button>

</form>



</aside>




<div class="admin-main">


<div class="admin-content">

@yield('content')

</div>



<footer class="text-center p-3"
style="background:#5a3723;color:white;">

Brew & Bites Admin Panel © 2026

</footer>


</div>


</div>


</body>

</html>