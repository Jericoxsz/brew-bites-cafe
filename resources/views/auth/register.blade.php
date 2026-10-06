<x-guest-layout>

<form method="POST" action="{{ route('register') }}">
@csrf

<div class="mb-3">

<label class="form-label fw-semibold">
Name
</label>

<input
type="text"
name="name"
value="{{ old('name') }}"
class="form-control form-control-lg"
placeholder="Enter your name"
required
autofocus>

@error('name')
<div class="text-danger mt-1">
{{ $message }}
</div>
@enderror

</div>


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
required>

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


<div class="mb-4">

<label class="form-label fw-semibold">
Confirm Password
</label>

<input
type="password"
name="password_confirmation"
class="form-control form-control-lg"
placeholder="Confirm your password"
required>
</div>

<div class="d-flex justify-content-between align-items-center">

<a href="{{ route('login') }}"
class="text-decoration-none">
Already registered?
</a>

<button class="btn btn-dark px-4">
Register
</button>

</div>
</form>
</x-guest-layout>