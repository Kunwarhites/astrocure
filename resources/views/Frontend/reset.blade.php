@extends('Frontend.Layouts.app')
@section('title', 'Reset')
@section('content')

    <section id="title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " id="account-title">
                    <h1 id="account-detal-head">My Account</h1>
                    <div class="sub-title-detail">
                        <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp; Reset Password
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section id="loginregister">
        <div class="container p-0">
            <div class="row">
                <div class="col-md-12 p-0">
                    <div class="login-card">
                        <h1>Update Your Password</h1>
                            <div id="reset_alert"></div>
                        <form action="" method="" autocomplete="off" id="reset_form">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                    name="email" value="{{ $email }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="npass" name="npass"
                                    placeholder="New Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="cnpass" name="cnpass"
                                    placeholder="Confirm Password">
                                <div class="invalid-feedback"></div>
                            </div>

                            <button type="submit" class="login" id="reset_btn">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            $("#reset_form").submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var submitButton = form.find("[type='submit']");
                submitButton.html("Please Wait...");
                $.ajax({
                    url: '{{ route('Frontend.resetpost')}}',
                    method: 'post',
                    data:$(this).serialize(),
                    success:function(response){
                        // console.log(response);
                        if(response.status==400){
                            showError('npass', response.message.npass);
                            showError('cnpass', response.message.cnpass);
                            submitButton.html("Update Password");
                        }else if(response.status == 401){
                            $("#reset_alert").html(showMessage('danger', response.message));
                            removeValidationClass("#reset_form");
                            submitButton.html("Update Password");
                        }else{
                            $("#reset_form")[0].reset();
                            $("#reset_alert").html(showMessage('success', response.message));
                            submitButton.html("Update Password");
                        }
                    }

                });
            });
        });
    </script>
@endsection
