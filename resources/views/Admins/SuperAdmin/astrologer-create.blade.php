@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Astrologer Create')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        a#addastrologer {
            background-color: #121c39;
            /* Set your desired background color */
            color: white;
            background-image: linear-gradient(180deg, #1c2b55 10%, #080d1d 100%);
            background-size: cover;
            border: 3px solid #284394;
        }

        button#addastrologer {
            background-color: #121c39;
            /* Set your desired background color */
            color: white;
            background-image: linear-gradient(180deg, #1c2b55 10%, #080d1d 100%);
            background-size: cover;
            border: 3px solid #284394;
        }

        #bg-head {
            background-color: #121c39;
            /* Set your desired background color */
            color: white;
            background-image: linear-gradient(180deg, #1c2b55 10%, #080d1d 100%);
            background-size: cover;

        }
    </style>
</head>
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
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <div class="card" id="bg-head">
                            <div class="card-header text-left">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>New Astrologer Entry</h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('astrologer') }}" class="btn " id="addastrologer">
                                            <i class="fa-solid fa-arrow-left text-white"></i> Return
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="col-12">
                                <div class="col-md-12 card-header  border-bottom mt-3 bg-light p-2 ">
                                    <h6 class="text-bold">Personal Information <span class="text-danger">*</span></h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="name_error" class="text-danger"></div>
                                <div id="email_error" class="text-danger"></div>
                                <div id="phone_error" class="text-danger"></div>
                                <form id="addAstrologerForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="astrologer_id" id="astrologer_id">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name:</label>
                                            <input type="text" name="name" id="name" placeholder="Enter Name"
                                                class="form-control errors">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" id="email"
                                                placeholder="example@gmail.com" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="contact">Contact:</label>
                                            <input type="text" id="phone" placeholder="e.g. 9999999999 "
                                                name="phone" class="form-control" maxlength="10"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                pattern="[6-9][0-9]{9}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="gender">Gender:</label>
                                            <div class="form-control text-nowrap">
                                                <input type="radio" name="gender" value="Male"> Male <span
                                                    class="mx-2"></span>
                                                <input type="radio" name="gender" value="Female"> Female <span
                                                    class="mx-2"></span>
                                                <input type="radio" name="gender" value="Other"> Other
                                            </div>
                                        </div>
                                        <div class="col-6 form-group ">
                                            <label for="usr" class="ps-0">Service:</label>
                                            <div class="row px-4">
                                                @foreach ($services as $service)
                                                    <div class="col-sm-4 my-1 text-wrap">
                                                        <input class="form-check-input" name="service" type="checkbox"
                                                            id="{{ $service->id }}" value="{{ $service->name }}">
                                                        <label class="form-check-label" for="department_0">
                                                            {{ $service->name }}
                                                        </label>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image">Profile Pic</label>
                                            <input type="file" name="profile_pic" id="profile_pic" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image">Status</label>
                                            <select  name="status" id="status" class="form-select">
                                                <option selected disabled>--Select Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-3 mb-3 d-flex justify-content-center">
                                        <button type="submit" class="btn  btn-block w-50 btn-small text-white"
                                            id="addastrologer">Add Astrologer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
@endsection


{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $("#addAstrologerForm").submit(function(e) {
            e.preventDefault();
            var formData = new FormData($('#addAstrologerForm')[0]);

            $.ajax({
                type: 'POST',
                url: '{{ route('astrologer.store') }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status === 200) {
                        // You can handle the success response here
                        Swal.fire(
                            'Added!',
                            'Service Added Successfully',
                            'success'
                        )
                        $("#addastrologer").html("Add Astrologer");
                        window.location.href = '{{ route('astrologer') }}';
                    }
                },
            });
        });
    });
</script>
