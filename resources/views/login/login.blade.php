@extends('layouts._layout')

@section('title', 'Đăng nhập')

@section('content')

<form id="login-form" action="/login" method="post">
    {{ csrf_field() }}
    <div class="login">
        <p class="login__title">Login<br><span class="login-edition">Welcome to X-Star Cineplex</span></p>
        @if(Session::get('error') != null)
        <div class="alert alert-danger text-center">
            {{ Session::get('error') }}
        </div>
        @endif
        @if(Session::get('success') != null)
        <div class="alert alert-success text-center">
            {{ Session::get('success') }}
        </div>
        @endif
        <div class="field-wrap">
            <input type="text" placeholder="Please enter your accout" name="Account" class="login__input" required>
            <input type="password" placeholder="Please enter your password" name="Password" class="login__input" required>

        </div>

        <div class="login__control">
            <button type="submit" class="btn btn-md btn--warning btn--wider">Login</button>
            <a href="/forgot" class="login__tracker form__tracker">Forgot passoword?</a>
        </div>
    </div>
</form>

@endsection
