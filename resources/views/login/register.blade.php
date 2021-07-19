@extends('layouts._layout')

@section('title', 'Đăng ký tài khoản')

@section('content')

<form action="/register"  method="Post" id="login-form"  class="">
    {{ csrf_field() }}
    <div class="login">
        <p class="login__title">Register your account <br><span class="login-edition">Welcome to X-Star Cineplex</span></p>
        @if(Session::get('error') != null)
        <div class="alert alert-danger text-center">
            {{ Session::get('error') }}
        </div>
        @endif

        <div class="field-wrap">
            <input type="text" placeholder="Please enter your fullname" name="Fullname" class="login__input">
            <input type="text" placeholder="Please enter your account" name="Account" class="login__input" >
            <input type="email" placeholder="Please enter your email" name="Email" class="login__input" >
            <input type="password" placeholder="Please enter your password" name="Password" class="login__input">
            <input type="text" placeholder="Please enter your address" name="Address" class="login__input" >
            <input type="text" placeholder="Please enter your number" name="Phone" class="login__input" >

            <div class="col-sm-4">
                <label style="margin-top: 3px;">Birthday</label>
            </div>
            <input type="date" placeholder="Please enter your birthdate" name="BirthDay" class="login__input" >

            <div class="col-sm-4">
                <label style="margin-top: 3px;">Gender</label>
            </div>
            <div class="col-sm-4">
                <label style="margin-top: 3px;">Male</label>
                <input type="radio" value="Nam" name="Sex" checked>
            </div>
            <div class="col-sm-4">
                <label style="margin-top: 3px;">Female</label>
                <input type="radio" value="Nữ" name="Sex">
            </div>
        </div>

        <div class="login__control" style="margin-top: 40px">
            <input type="submit" value="Register" class="btn btn-md btn--warning btn--wider">
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
