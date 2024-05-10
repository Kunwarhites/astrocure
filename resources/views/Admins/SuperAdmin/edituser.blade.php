@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Edit Users')
<style>
    input:focus {
      outline: none;
    }
  </style>

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title') Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

       <!-- Main content -->
       <div class="container">
        <div class="row gutters-sm" id="data-user">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            {{-- <img src="{{ url('images/profileUser/' . $users->picture) }}"
                            id="image_preview" alt=""
                            class="img-fluid rounded-circle img-thumbnail" width="150"> --}}

                        <img src="https://cdn.iconscout.com/icon/premium/png-512-thumb/avatar-182-132174.png?f=webp&w=512" alt="" width="200" class="img-fluid rounded-circle">
                        <div class="mt-3">

                                {{-- <h4>{{$users->name}}</h4> --}}
                                <button class="btn btn-outline-primary">Upload Image</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{-- {{$users->name}} --}}
                                <input type="text" name="name" id="name" value="{{$users[0]->name}}"  class="border-0 w-100" >
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{-- {{$users->email}} --}}
                                <input type="email" name="email" id="email" value="{{$users[0]->email}}"  class="border-0 w-100"  >

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{-- {{$users->phone}} --}}
                                <input type="tel" name="phone" id="phone" value="{{$users[0]->phone}}"  class="border-0 w-100"  >

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Gender</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{-- {{$users->gender}} --}}
                                <select name="gender" id="gender" class="form-control" class="border-0 w-100">
                                    <option selected disabled>--Select--</option>
                                    <option value="Male"  {{ $users[0]->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $users[0]->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Date of Birth</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{-- {{$users->dob}} --}}
                                <input type="date" name="dob" id="dob" value="{{ $users[0]->dob}}"  class="border-0 w-100"  >

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Course</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                    <select name="course" id="course" class="form-control" class="border-0 w-100">
                                        <option selected disabled>--Select--</option>
                                        <option value="Course 1" >Course 1</option>
                                        <option value="Course 2">Course 2</option>
                                        <option value="Course 3">Course 3</option>
                                        <option value="Course 4">Course 4</option>
                                    </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info" type="submit" href="">Submit</a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.content -->


    </div>
@endsection
