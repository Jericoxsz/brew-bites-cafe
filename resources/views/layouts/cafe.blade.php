<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Brew & Bites Café</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>

<nav class="customer-navbar">
<div class="nav-container">

<a href="/" class="brand">☕ Brew & Bites</a>

<button class="menu-toggle" onclick="toggleMenu()">☰</button>

<div class="nav-links" id="navLinks">

<a href="/" class="nav-item-link {{request()->is('/')?'active':''}}">
Home
</a>

<a href="/products" class="nav-item-link {{request()->is('products*')?'active':''}}">
Menu
</a>

@if(Auth::check())

<a href="/cart" class="nav-item-link {{request()->is('cart')?'active':''}}">
🛒 Cart
</a>

<a href="/orders" class="nav-item-link {{request()->is('orders*')?'active':''}}">
📦 Orders
</a>

<a href="/profile" class="nav-item-link {{request()->is('profile')?'active':''}}">
👤 Profile
</a>

<form action="/logout" method="POST">
@csrf
<button class="logout-btn">Logout</button>
</form>

@else

<a href="/login" class="nav-item-link login-btn">
Login
</a>

<a href="/register" class="nav-item-link register-btn">
Register
</a>

@endif

</div>
</div>
</nav>


<main class="customer-content">
@yield('content')
</main>


<footer class="customer-footer">
<h3>☕ Brew & Bites Café</h3>
<p>Fresh coffee. Fresh pastries. Made with love.</p>
<p>© 2026 Brew & Bites Café</p>
</footer>


<script>
function toggleMenu(){
document.getElementById('navLinks').classList.toggle('show');
}
</script>


<style>

body{
background:#fff8e7;
min-height:100vh;
display:flex;
flex-direction:column;
}

.customer-navbar{
background:#6f4e37;
padding:18px 0;
box-shadow:0 5px 20px rgba(0,0,0,.15);
}

.nav-container{
width:90%;
max-width:1200px;
margin:auto;
display:flex;
align-items:center;
justify-content:space-between;
}

.brand{
font-size:28px;
font-weight:800;
color:white;
text-decoration:none;
}

.nav-links{
display:flex;
align-items:center;
gap:10px;
}

.nav-item-link,
.nav-item-link:visited{
color:white;
text-decoration:none;
padding:10px 18px;
border-radius:25px;
font-weight:600;
transition:.2s;
-webkit-tap-highlight-color:transparent;
}

.nav-item-link:hover,
.nav-item-link.active{
background:white;
color:#6f4e37;
}

.logout-btn{
background:transparent;
border:1px solid white;
color:white;
padding:10px 20px;
border-radius:25px;
font-weight:600;
cursor:pointer;
}

.logout-btn:hover{
background:white;
color:#6f4e37;
}

.register-btn{
background:white;
color:#6f4e37!important;
}

.menu-toggle{
display:none;
background:none;
border:none;
color:white;
font-size:30px;
}

.customer-content{
flex:1;
}

.customer-footer{
background:#4b2e1f;
color:white;
text-align:center;
padding:35px;
margin-top:50px;
}

@media(max-width:768px){

.menu-toggle{
display:block;
}

.nav-links{
display:none;
position:absolute;
top:75px;
left:0;
width:100%;
background:#6f4e37;
padding:20px;
flex-direction:column;
z-index:999;
}

.nav-links.show{
display:flex;
}

.nav-item-link{
width:100%;
text-align:center;
}

.brand{
font-size:22px;
}

}

</style>

</body>
</html>