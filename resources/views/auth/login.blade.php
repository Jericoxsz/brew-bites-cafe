<x-guest-layout>

<form method="POST" action="{{ route('login') }}">
@csrf

@if(session('status'))

<div class="alert alert-success mb-3">
{{ session('status') }}
</div>

@endif


<div class="mb-3">

<label class="form-label fw-semibold">
Email
</label>

<input
type="email"
name="email"
value="{{ old('email') }}"
class="form-control form-control-lg"
placeholder="Enter your email"
required
autofocus>

@error('email')
<div class="text-danger mt-1">
{{ $message }}
</div>
@enderror

</div>


<div class="mb-3">

<label class="form-label fw-semibold">
Password
</label>

<input
type="password"
name="password"
class="form-control form-control-lg"
placeholder="Enter your password"
required>

@error('password')
<div class="text-danger mt-1">
{{ $message }}
</div>
@enderror

</div>


<div class="form-check mb-4">

<input
type="checkbox"
name="remember"
class="form-check-input"
id="remember_me">

<label class="form-check-label" for="remember_me">
Remember me
</label>

</div>


<div class="d-flex justify-content-between align-items-center">

@if(Route::has('password.request'))

<a href="{{ route('password.request') }}"
class="text-decoration-none">

Forgot password?

</a>

@endif


<button class="btn btn-dark px-4">

Log in

</button>

</div>


<div class="text-center mt-4">

<p class="mb-0">

Don't have an account?

<a href="{{ route('register') }}"
class="fw-bold text-decoration-none">

Register

</a>

</p>

</div>


</form>

</x-guest-layout>