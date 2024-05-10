@extends('Frontend.Layouts.app')
@section('title', 'Registration')

@section('content')
    <section id="title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " id="account-title">
                    <h1 id="account-detal-head">Registration</h1>
                    <div class="sub-title-detail">
                        <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp; Registration
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
                        <h1>Registration</h1>
                        <div id="show_success_alert"></div>
                        <form action="{{ route('Frontend.registerpost') }}" method="post" id="register_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                        name="name" autocomplete="off">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                        name="email" autocomplete="off">
                                    <div class="invalid-feedback"></div>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phone</label>
                                    <input type="text" id="phone" placeholder="Enter Your Mobile No" name="phone"
                                        class="form-control" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        pattern="[6-9][0-9]{9}" name="phone" autocomplete="off">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control" value="">
                                        <option value="" class="disabled">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">DOB</label>
                                    <input type="date" name="dob" id="dob" class="form-control"
                                        id="exampleInputPassword1" value="" autocomplete="off">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        id="exampleInputPassword1">
                                    {{-- <i class="toggle-password fa fa-fw fa-eye-slash"></i> --}}
                                    <div class="invalid-feedback"></div>
                                </div>
                                <button type="submit" id="register_btn" class="login px-4">Register</button>

                            </div>
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
        $(document).ready(function() {
            $("#register_form").submit(function(e) {
                e.preventDefault();
                var form = $(this); // Store a reference to the form
                var submitButton = form.find("[type='submit']"); // Store a reference to the submit button

                submitButton.html("Register..."); // Change submit button text

                $.ajax({
                    url: form.attr("action"), // Use form's action attribute
                    method: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 400) {
                            showError('name', res.message.name);
                            showError('email', res.message.email);
                            showError('phone', res.message.phone);
                            showError('gender', res.message.gender);
                            showError('dob', res.message.dob);
                            showError('password', res.message.password);
                            submitButton.html(
                                "Register"); // Restore original submit button text
                        } else if (res.status == 200) {
                            $("#show_success_alert").html(showMessage('success', res.message));
                            form[0].reset();
                            removeValidationClasses(form);
                            submitButton.html(
                                "Register"); // Restore original submit button text
                        }
                    }
                });
            });
        });
    </script>
@endsection
