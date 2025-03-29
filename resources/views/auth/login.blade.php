@extends('layouts.auth')

@section('content')

<form class="form-detail login" method="POST" action="{{ route('login') }}">
    @csrf

    <h2 class="logo">
        <img class="logo"
        src="{{ env('APP_LOGO') ? url('storage/' . env('APP_LOGO')) : url('assets/media/image/logo.png') }}">
    </h2>

    <h3>Login Form</h3>
    <div class="form-full">
        <div class="form-wrapper">
            <label for="">Username or Email</label>
            <input type="text" class="form-control" value="{{ old('login') }}"  name="login" placeholder="input your credentials">
        </div>
    </div>

    <div class="form-full">
        <div class="form-wrapper">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password" placeholder="input your password">
            @error('username')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="form-row form-button">
        <div class="form-wrapper">
            <a class="button black" href="{{ route('register') }}">Register</a>
        </div>

        <div class="form-wrapper">
            <button class="button" type="submit" data-text="Submit">
                <span>Login</span>
            </button>
        </div>
    </div>

    <div class="form-full">
        <a href="{{ route('password.request') }}">Forgot Password</a>
    </div>

</form>

@endsection