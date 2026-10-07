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
}


/* SIDEBAR */

.admin-sidebar{

    width:290px;
    height:100vh;

    position:fixed;
    left:0;
    top:0;

    background:linear-gradient(180deg,#4b2e1f,#603a24);

    color:white;

    padding:28px 20px;

    box-sizing:border-box;

    z-index:1000;

    display:flex;
    flex-direction:column;

    transition:.3s ease;
}



/* MOBILE HEADER */

.mobile-header{

    display:none;

    background:#4b2e1f;

    color:white;

    padding:15px;

    align-items:center;

    gap:15px;

    font-size:20px;

    font-weight:700;

    position:sticky;

    top:0;

    z-index:2000;

}


.mobile-header button{

    background:white;

    border:none;

    border-radius:8px;

    padding:7px 12px;

    font-size:22px;

}



/* MAIN */

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



/* PROFILE */

.profile-box{

    background:rgba(255,255,255,.12);

    border-radius:15px;

    padding:15px;

    text-align:center;

    margin:20px 0;

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

    justify-content:center;

    align-items:center;

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



/* MENU */

.sidebar-menu{

    flex:1;

    overflow-y:auto;

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



/* LOGOUT */

.logout-area{

    margin-top:auto;

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


.logout-btn:hover{

    background:white;

    color:#4b2e1f;

}



/* OVERLAY */

.sidebar-overlay{

    display:none;

}



/* FOOTER */

.admin-footer{

    background:#5a3723;

    color:white;

    text-align:center;

    padding:15px;

}



/* MOBILE */

@@media(max-width:768px){

.mobile-header{

    display:flex;

    position:sticky;

    top:0;

    z-index:2000;

}


.admin-sidebar{

    transform:translateX(-100%);

    width:260px;

}



.admin-sidebar.show{

    transform:translateX(0);

}



.admin-main{

    margin-left:0;

    width:100%;

}



.admin-content{

    padding:15px;

}



.sidebar-overlay{

    position:fixed;

    inset:0;

    background:rgba(0,0,0,.45);

    z-index:900;

}



.sidebar-overlay.show{

    display:block;

}


}

</style>

</head>


<body>


<div class="mobile-header">

<button onclick="toggleSidebar()">
☰
</button>

<span>
☕ Brew & Bites Admin
</span>

</div>



<div class="admin-wrapper">



<aside class="admin-sidebar" id="adminSidebar">


<h2 class="fw-bold">
☕ Brew & Bites
</h2>


<p class="text-white-50">
ADMIN PANEL
</p>



<div class="profile-box">


@if(Auth::user()->profile_image)

<img src="{{asset('storage/'.Auth::user()->profile_image)}}">


@else

<div class="profile-avatar">
👤
</div>

@endif


<div class="profile-name">
{{Auth::user()->name}}
</div>


<div class="profile-email">
{{Auth::user()->email}}
</div>


</div>



<hr>



<div class="sidebar-menu">


<a href="/admin/dashboard"
class="sidebar-link {{request()->is('admin/dashboard')?'active':''}}">
📊 Dashboard
</a>


<a href="/admin/products"
class="sidebar-link {{request()->is('admin/products*')?'active':''}}">
☕ Products
</a>


<a href="/admin/categories"
class="sidebar-link {{request()->is('admin/categories*')?'active':''}}">
📂 Categories
</a>


<a href="/admin/orders"
class="sidebar-link {{request()->is('admin/orders*')?'active':''}}">
📦 Orders
</a>


<a href="/admin/inventory"
class="sidebar-link {{request()->is('admin/inventory*')?'active':''}}">
📈 Inventory
</a>


<a href="/admin/profile"
class="sidebar-link {{request()->is('admin/profile')?'active':''}}">
👤 Profile
</a>


</div>



<div class="logout-area">


<hr>


<form method="POST" action="/logout">

@csrf

<button class="logout-btn">

Logout

</button>

</form>


</div>



</aside>



<div class="sidebar-overlay" onclick="toggleSidebar()"></div>



<div class="admin-main">


<div class="admin-content">

@yield('content')

</div>


<footer class="admin-footer">

Brew & Bites Admin Panel © 2026

</footer>


</div>


</div>



<script>

function toggleSidebar(){

let sidebar=document.getElementById('adminSidebar');

let overlay=document.querySelector('.sidebar-overlay');


sidebar.classList.toggle('show');

overlay.classList.toggle('show');

}

</script>


</body>

</html>