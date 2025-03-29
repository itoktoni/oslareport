@extends('layouts.auth')

@section('content')

<form class="form-detail login" method="POST" action="{{ route('password.email') }}">
    @csrf

    <h2 class="logo">
        <img class="logo"
        src="{{ env('APP_LOGO') ? url('storage/' . env('APP_LOGO')) : url('assets/media/image/logo.png') }}">
    </h2>

    <h3>Reset Password</h3>
    <div class="form-full">
        <div class="form-wrapper">
            <label for="">Email</label>
            <input type="email" class="form-control" value="{{ old('email') }}"  name="email" placeholder="input your credentials">
        </div>
    </div>

    <div class="form-row form-button">
        <div class="form-wrapper">
            <a class="button black" href="{{ route('login') }}">Login</a>
        </div>

        <div class="form-wrapper">
            <button class="button" type="submit" data-text="Submit">
                <span>Reset</span>
            </button>
        </div>
    </div>

</form>

@endsection