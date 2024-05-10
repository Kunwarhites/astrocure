<!DOCTYPE html>
<html lang="en">

<head>
    <title>Super Admin | @yield('title')</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <!-- Favicon icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bg-gradient-primary {
            color: white !important;
            background-color: #101932;
            background-image: linear-gradient(180deg, #1c2b55 10%, #080d1d 100%);
            background-size: cover;
            overflow: hidden;
            height: 100vh;
            background-repeat: no-repeat;
        }

        form.user .form-control-user {
            font-size: 0.8rem;
            border-radius: 10rem;
            padding: 1.5rem 1rem;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        form.user .btn-user {
            font-size: 0.8rem;
            border-radius: 10rem;
            padding: 0.75rem 1rem;
        }
        .toggle-password {
            float: right;
            cursor: pointer;
            margin-right: 24px;
            margin-top: -32px;
        }
        @media only screen and (max-width: 720px) {
            div#phone {
                padding: 1.7rem !important;
            }
        }
    </style>
</head>

<body class="bg-gradient-primary sidebar-toggled">
    <div class="container mt-5 pt-5">
        @if (\Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    {{ \Session::get('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{ \Session::forget('success') }}
        @if (\Session::get('error'))
            <div class="alert alert-danger bg-danger text-white alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    {{ \Session::get('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="{{ url('img\admin\admin-image-form.jpg')}}" alt="" class="w-100 h-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5" id="phone">
                                    <div class="text-center">
                                        <h1 class="h4 text-dark mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="{{ route('postlogin') }}" method="POST"
                                        autocomplete="off">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" id="email"
                                                class="form-control form-control-user" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-user" placeholder="Password">
                                                <i class="toggle-password fa-solid fa-eye-slash text-dark" onclick="togglePassword()" id="eysof"></i>
                                                <i class="toggle-password fa-solid fa-eye text-dark" onclick="togglePassword()" id="eyson"  style="display: none;"></i>

                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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


</body>
</html>
