@extends('layouts.auth')

@section('content')

<form class="form-detail login" method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <h2 class="logo">
        <img class="logo"
        src="{{ env('APP_LOGO') ? url('storage/' . env('APP_LOGO')) : url('assets/media/image/logo.png') }}">
    </h2>

    <h3>Reset Password</h3>

    <div class="form-full">
        <div class="form-wrapper">
            <label for="">Email *</label>
            <input type="email" name="email" readonly value="{{ $email ?? old('email') }}" class="form-control" placeholder="Input your email">
            @error('email')
            <span class="error error-top">* {{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-wrapper">
            <label for="">Password *</label>
            <input type="password" class="form-control" name="password" placeholder="input your password">
        </div>

        <div class="form-wrapper">
            <label for="">Confirm Password *</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="confirmation password">
            @error('password')
            <span class="error">* {{ $message }}</span>
            @enderror
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