@extends('layouts._layout')

@section('title', 'Đổi mật khẩu')

@section('content')

<form action="/changepass"  method="Post" id="login-form"  class="">
    {{ csrf_field() }}
    <div class="login">
        <p class="login__title">Change password<br><span class="login-edition">Welcome to X-Star Cineplex</span></p>

        @if(Session::get('error') != null)
        <div class="alert alert-danger text-center">
            {{ Session::get('error') }}
        </div>
        @endif

        <div class="field-wrap">
            <input type="password" placeholder="Please enter your old passowrd" name="OldPass" class="login__input">
            <input type="password" placeholder="Please enter your new password" name="NewPass" id="NewPass" class="login__input" >
            <input type="password" placeholder="Re-enter new password" name="RePass" class="login__input">
        </div>

        <div class="login__control" style="margin-top: 40px">
            <input type="submit" value="Change password" class="btn btn-md btn--warning btn--wider">
            <a href="/dang-nhap.html" class="login__tracker form__tracker">Login</a>
        </div>
    </div>
</form>

@endsection

@section('jsSection')

<script>
    $(document).ready(function () {
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#login-form").validate({
                rules: {
                    NewPass: "required",
                    OldPass: "required",
                    RePass: {
                        required: true,
                        equalTo: "#NewPass"
                    }
                },
                messages: {
                    NewPass: "Please enter your New Password",
                    OldPass: "Please enter your Old Password",
                    RePass: {
                        required: "Re-enter your New Password",
                        equalTo: "Your New Password did not match"
                    }
                }
            });
        });
    </script>


@endsection
