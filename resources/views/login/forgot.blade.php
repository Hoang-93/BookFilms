@extends('layouts._layout')

@section('title', 'Đăng ký tài khoản')

@section('content')

<form action="/forgot"  method="Post" id="login-form"  class="" name="FogotPassowordForm">
    {{ csrf_field() }}
    <div class="login">
        <p class="login__title">Fogot Password <br><span class="login-edition">Welcome to X-Star Cineplex</span></p>
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
            <input type="email" placeholder="Please enter your email" name="Email" class="login__input" >
        </div>

        <div class="login__control" style="margin-top: 40px">
            <input type="submit" value="Send" class="btn btn-md btn--warning btn--wider">
            <a href="/dang-nhap.html" class="login__tracker form__tracker">You already have account?</a>
        </div>
    </div>
</form>

@endsection

@section('jsSection')

<script>
    $(document).ready(function () {
        jQuery.validator.addMethod("phonenu", function (value, element) {
            if (/^(09[0-9]|07[0|6|7|8|9]|03[2-9]|08[1-5])+([0-9]{7})\b/g.test(value)) {
                return true;
            } else {
                return false;
            };
        }, "Invalid phone number");


            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#login-form").validate({
                rules: {
                    Fullname: "required",
                    Account: "required",
                    Email: {
                        required: true,
                        email:true
                    },
                    Password: "required",
                    Address: "required",
                    BirthDay: "required",
                    Phone: {
                        required: true,
                        phonenu: true
                    }
                },
                messages: {
                    Fullname: "Please enter your fullname",
                    Account: "Please enter your account",
                    Email: {
                        required: "Please enter your email",
                        email: "Your email is invalid"
                    },
                    Password: "Please enter your password",
                    Address: "Please enter your address",
                    BirthDay: "Please enter your birthday",
                    Phone: {
                        required: "Please enter your phone",
                        phonenu: "Your phone is invalid"
                    }
                }
            });
        });
    </script>


@endsection
