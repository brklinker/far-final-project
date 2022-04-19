@extends('layouts.auth')

@section('title', 'Sign Up')


@section('content')
<div id="login-header">
    <h2>Sign Up</h2>
    <h5>Welcome to FA&R, please sign in to continue.</h5>
</div>

<form method="post" action="{{ route('registration.create') }}">
    @csrf
    <div class="mb-3">
        <p>I am using this for (select one)</p>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio" name="options" id="user" value="user" autocomplete="off" checked>
                User
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="anr" value="anr" autocomplete="off">
                A&R
            </label>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control">
    </div>
    <input type="submit" id="form-submit" value="Register" class="btn btn-primary">
</form>
<p id="account-label">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
@endsection