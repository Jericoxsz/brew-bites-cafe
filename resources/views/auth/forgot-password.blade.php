<x-guest-layout>

<div class="mb-4 text-muted text-center">

Forgot your password?

Enter your email address and we will send you a password reset link.

</div>


@if(session('status'))

<div class="alert alert-success mb-3">
{{ session('status') }}
</div>

@endif


<form method="POST" action="{{ route('password.email') }}">

@csrf


<div class="mb-4">

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


<div class="d-flex justify-content-between align-items-center">


<a href="{{ route('login') }}"
class="text-decoration-none">

Back to Login

</a>


<button class="btn btn-dark px-4">

Send Reset Link

</button>
</div>
</form>
</x-guest-layout>