@extends('Frontend.Layouts.app')
@section('title', 'Login')
@section('content')

    <section id="title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " id="account-title">
                    <h1 id="account-detal-head">My Account</h1>
                    <div class="sub-title-detail">
                        <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp; My Account
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
                        <h1>Login</h1>
                        <div id="login_alert"></div>
                        @if (session()->has('messageap'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('messageap') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        <form action="#" method="post" autocomplete="off" id="login_form">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    aria-describedby="emailHelp">
                                    <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <i class="toggle-password fa-solid fa-eye-slash text-dark" onclick="togglePassword()" id="eysof"></i>
                                <i class="toggle-password fa-solid fa-eye text-dark" onclick="togglePassword()" id="eyson"  style="display: none;"></i>

                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3 form-check px-5">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                </div>
                                <div class="col-md-6 mb-3 d-flex justify-content-end">
                                    <a href="/forget" class="text-white text-decoration-none">Forget Your Password</a>
                                </div>
                            </div>
                            <button type="submit" class="login" id="login_btn">Login</button>
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

            function togglePassword() {
                var x = document.getElementById("password");
                var eyeOff = document.getElementById("eysof");
                var eyeOn = document.getElementById("eyson");

                if (x.type === "password") {
                    x.type = "text";
                    eyeOff.style.display = "none";
                    eyeOn.style.display = "block";
                } else {
                    x.type = "password";
                    eyeOff.style.display = "block";
                    eyeOn.style.display = "none";
                }
            }
        </script>
    <script>
        $(function(){
            $("#login_form").submit(function(e){
                e.preventDefault();
                var submitButton = $("#login_btn"); // Define submitButton within this scope
                submitButton.val('Please wait.....');
                $.ajax({
                    url: '{{ route('Frontend.loginpost')}}',
                    method:'post',
                    data:$(this).serialize(),
                    dataType: 'json',
                    success:function(res){
                        if(res.status == 400){
                            showError('email', res.messages.email);
                            showError('password', res.messages.password);
                            submitButton.val('Login');
                        }else if(res.status == 401){
                            $("#login_alert").html(showMessage('danger', res.messages));
                            submitButton.val('Login');
                        } else{
                            if(res.status == 200 && res.messages == 'success'){
                                window.location = '{{ route('index')}}';
                            }
                        }
                    }
                });
            });
        });
    </script>

@endsection
