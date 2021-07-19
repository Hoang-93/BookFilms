@extends('layouts._layout')

@section('title', 'Cập nhật thông tin')

@section('content')

<form action="/update"  method="Post" id="login-form"  class="">
    {{ csrf_field() }}
    <div class="login">
        <p class="login__title">Update user information<br><span class="login-edition">Welcome to X-Star Cineplex</span></p>
        @if(Session::get('error') != null)
        <div class="alert alert-success text-center">
            {{ Session::get('error') }}
        </div>
        @endif
        <div class="field-wrap">
            <input type="hidden" value="{{ $user->ID }}" name="ID" >
            <div class="col-sm-4">
                <label style="margin-top: 3px;">Fullname</label>
            </div>
            <input type="text" placeholder="Please enter your fullname" value="{{ $user->Fullname }}" name="Fullname" class="login__input">
            <div class="col-sm-4">
                <label style="margin-top: 3px;">Address</label>
            </div>
            <input type="text" placeholder="Please enter your address" value="{{ $user->Address }}" name="Address" class="login__input" >
            <div class="col-sm-5">
                <label style="margin-top: 3px;">Phone number</label>
            </div>
            <input type="text" placeholder="Please enter your phone" value="{{ $user->Phone }}" name="Phone" class="login__input" >

            <div class="col-sm-4">
                <label style="margin-top: 3px;">BirthDay</label>
            </div>
            <input type="date" placeholder="Please enter your birthday" name="BirthDay" id="BirthDay" class="login__input" >

        </div>

        <div class="login__control" style="margin-top: 40px">
            <input type="submit" value="Cập nhật" class="btn btn-md btn--warning btn--wider">
        </div>
    </div>
</form>

@endsection

@section('jsSection')

<script>
    $(document).ready(function () {

        document.getElementById("BirthDay").value = '{{ Carbon\Carbon::parse($user->BirthDay)->format('Y-m-d') }}';

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
