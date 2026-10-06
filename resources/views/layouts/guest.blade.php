<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Brew & Bites Café</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>


<body style="background:#fff8e7;min-height:100vh;display:flex;align-items:center;justify-content:center;">


<div class="container">

<div class="row justify-content-center">

<div class="col-md-5">


<div class="card shadow border-0 rounded-4">


<div class="card-body p-5">


<div class="text-center mb-4">

<h1 class="fw-bold"
style="color:#6f4e37;">

☕ Brew & Bites

</h1>


<p class="text-muted">

Fresh coffee and pastries made with love.

</p>

</div>


{{ $slot }}


</div>


</div>


</div>

</div>

</div>


</body>

</html>