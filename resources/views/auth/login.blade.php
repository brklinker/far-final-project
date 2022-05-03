@extends('layouts.auth')

@section('title', 'Login')


@section('content')
<div id="login-header">
    <h2>Log In</h2>
    <h5>Welcome to FA&R, please sign in to continue.</h5>
</div>

<form method="post" action="{{ route('auth.login') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control" value="{{ old('email') }}">
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control">
    </div>
    <div class="mb-3">
        <input type="submit" value="Login" class="btn btn-primary" id="form-submit">
    </div>
</form>
<p id="account-label">Don't have an account? <a href="{{ route('registration.index') }}">Sign Up</a>.</p>
@endsection