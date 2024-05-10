@extends('Frontend.Layouts.app')
@section('title', 'Forget')
@section('content')

    <section id="title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " id="account-title">
                    <h1 id="account-detal-head">My Account</h1>
                    <div class="sub-title-detail">
                        <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp; Forget
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
                        <h1>Forget Password</h1>
                        <div id="forgot_alert"></div>
                        <form action="" method="post" autocomplete="off" id="forget_form">
                            @csrf
                            <div class="mb-3 text-muted">

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                            </div>
                            <button type="submit" class="login" id="forget_btn">Reset Password</button>
                        </form>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                <div class="register-card">

                </div>
            </div> --}}
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function(){
            $("#forget_form").submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var submitButton = form.find("[type='submit']");
                submitButton.html("Please Wait...");
                $.ajax({
                    url: '{{ route('Frontend.forgetpost')}}',
                    method: 'post',
                    data: $(this).serialize(),
                    // dataType:'json',
                    success:function(response){
                        // console.log(response);
                        if(response.status == 400){
                            showError('email', response.message.email);
                            submitButton.html("Reset Password");
                        }else if(response.status == 200){
                            $("#forgot_alert").html(showMessage('success', response.message));
                            submitButton.html("Reset Password");
                            removeValidationClasses("#forget_form");
                            $("#forget_form")[0].reset();
                        } else{
                            submitButton.html("Reset Password");
                            $("#forgot_alert").html(showMessage('danger', response.message));

                        }

                    }
                });
            });
        });
    </script>

@endsection
