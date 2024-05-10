@extends('Frontend.Layouts.app')
@section('title', 'Admin Login')

@section('content')
    <section>
        <div class="container px-lg-5 my-lg-5">
            <div class="row">
                <div class="col-md-12 px-lg-5">
                    <!-- Login basic -->
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
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ \Session::get('error') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{route('Admins.SuperAdmin.loginPosts')}}" method="post" id="admin_login_form">
                        @csrf
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                            @if ($errors->has('email'))
                            <span class="help-block font-red-mint">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                            @if ($errors->has('password'))
                            <span class="help-block font-red-mint">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <button type="submit" class="login" id="admin_login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

