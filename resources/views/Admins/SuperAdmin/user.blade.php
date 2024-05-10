@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Users')

<head>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css?<?= time() ?>"
        integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style>
        .data-table thead th {
            background-color: #121c39;
            /* Set your desired background color */
            color: white;
            /* Set the text color */
            font-weight: bold;
            /* Set the font weight */
            background-image: linear-gradient(180deg, #1c2b55 10%, #080d1d 100%);
            background-size: cover;
        }

        button.btn {
            background-color: #121c39;
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-right">
                                <button type="button" class="btn " id="modal_adduser" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="fa-solid fa-plus"></i> Add Users
                                </button>
                            </div>
                            <div id="show_success_alert"></div>

                            <div class="card-body">
                                <table
                                    class="table  table-bordered text-center table-striped table-hover responsive small no-footer data-table">
                                    <!-- Table header -->
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Service</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- Modal adduser-->
    <div class="modal fade" id="user_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="adduser_form" autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Your Name">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="example@gmail.com">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone</label>
                                <input type="tel" class="form-control" name="phone" id="phone"
                                    placeholder="Your Phone Number">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Gender</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option disabled selected>--select--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Service</label>
                                <select class="form-control" name="service" id="">
                                    <option selected disabled>-- Select--</option>
                                    @foreach ($services as $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Your Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Photo</label>
                                <input type="file" class="form-control" name="picture" id="picture">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="adduser_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit User MOdal --}}
    <div class="modal fade" id="editUser_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="update_form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="use_id" id="use_id">
                            <input type="hidden" name="use_picture" id="use_picture">
                            <div class="col-md-12  text-center m-2" id="picture_edit">
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="form-label">Registration ID</label>
                                <input type="text" disabled class="form-control" name="registration_id"
                                    id="registration_id">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name_edit"
                                    placeholder="Your Name">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email_edit" name="email"
                                    placeholder="example@gmail.com">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone_edit" name="phone"
                                    placeholder="Your Phone Number">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Gender</label>
                                <select class="form-control" name="gender" id="gender_edit">
                                    <option disabled selected>--select--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" id="dob_edit" name="dob">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password_edit" name="password"
                                    placeholder="Your Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Service</label>
                                <select class="form-control" name="service" id="service">
                                    <option disabled selected>--select--</option>

                                    @foreach ($services as $service)
                                    <option value="{{ $service }}" {{ optional($userinfo)->service == $service ? 'selected' : '' }}>
                                        {{ $service }}
                                    </option>
                                @endforeach
                                </select>

                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Photo</label>
                                <input type="file" class="form-control" name="picture">
                                <div class="invalid-feedback"></div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="UpdateS_btn">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js?<?= time() ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
    {{-- SHow btn --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add a click event listener to elements with the "showSweetAlert" class
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('showSweetAlert')) {
                    // Show a SweetAlert when the anchor tag is clicked
                    Swal.fire({
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    </script>

    {{-- Table data show --}}
    <script>
        jQuery(document).ready(function($) {

            var table = $(".data-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'image_url',
                        name: 'image_url',
                        render: function(data) {
                            return '<img src="' + data +
                                '" alt="" class="rounded-circle object-fit-cover" width="50" height="50">';
                        }
                    },
                    {
                        data: 'name_and_registration_id',
                        name: 'registration_id', // Use the 'registration_id' column for searching
                        searchable: true, // Make the 'registration_id' column searchable
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'dob',
                        name: 'dob',
                        searchable: false,
                    },
                    {
                        data: 'service',
                        name: 'service'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                columnDefs: [{
                    targets: 2, // Target the custom column created for name and registration
                    render: function(data, type, full, meta) {
                        return '<div style="text-align: left;"><strong>' + full.name +
                            '</strong>' + '<br>' + '<div style="color:green;">' + full
                            .registration_id + '</div>' +
                            '</div>'; // Concatenate name and registration ID
                    }
                }]

            });

        });
    </script>


    {{-- Add user --}}
    <script>
        // Handle form submission
        $(function() {
            $("#modal_adduser").on('click', function() {
                // Reset the form when the modal is opened
                $("#adduser_form").trigger('reset');
                // Open the modal
                $("#user_Modal").modal('show');
            });
            $("#adduser_form").submit(function(e) {
                e.preventDefault();
                var form = $(this); // Store a reference to the form
                var submitButton = form.find("[type='submit']"); // Store a reference to the submit button
                submitButton.html("Please Wait..."); // Change submit button text
                const fd = new FormData(this);
                $.ajax({
                    url: '{{ route('userAddPost') }}',
                    method: 'POST',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire(
                                'Added!',
                                'User Added Sucessfully',
                                'success'
                            );
                            location.reload();
                        }
                        $("#adduser_btn").text('Submit');
                        $("#adduser_form")[0].reset();
                        $("#user_Modal").modal('hide');
                    }
                });
            });
        });
    </script>

    {{-- edit user --}}
    <script>
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editUser', ['id' => 'id']) }}', // Use double curly braces to interpolate the variable
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    // Assuming that 'res' contains user information
                    $("#name_edit").val(res.name);
                    $("#registration_id").val(res.registration_id);
                    $("#email_edit").val(res.email);
                    $("#phone_edit").val(res.phone);
                    $("#gender_edit").val(res.gender);
                    $("#dob_edit").val(res.dob);
                    $("#service").val(res.service);
                    $("#password_edit").val(res.password);
                    // Display the user's profile picture
                    $("#picture_edit").html(
                        `<img src="/images/profileUser/${res.picture}" alt="" class="rounded-circle object-fit-cover" width="100" height="100">`
                    );
                    $("#use_id").val(res.id)
                    $("#use_picture").val(res.picture)
                }
            });
        });
    </script>

    {{-- Update User --}}
    <script>
        $('#update_form').submit(function(e) {
            e.preventDefault(e);
            const fd = new FormData(this);
            $("#UpdateS_btn").text('Updating......');
            $.ajax({
                url: '{{ route('updateUser', ['id' => 'id']) }}',
                method: 'POST',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 200) {
                        Swal.fire(
                            'Updated!',
                            'User Updated Sucessfully!',
                            'success'
                        );
                        $("#UpdateS_btn").text('Update');
                        $("#update_form")[0].reset();
                        $("#editUser_Modal").modal('hide');
                        location.reload();
                    }
                }
            });
        });
    </script>

    {{-- Delete ajax  --}}
    <script>
        $(document).on('click', '.deleteuser', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delUser', ['id' => 'id']) }}',
                        method: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire(
                                'Deleted!',
                                'User Deleted Successfully!',
                                'success'
                            );
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseJSON); // Log any errors to the console
                        }
                    });
                }
            });
        });
    </script>

    {{-- UpdateStatus --}}
    {{-- <script>
        \ $(document).on('click', '.statusUpdate', function() {
    //    $('.status').change(function() {
            var userId = $(this).prop("id");
        });
    </script> --}}


@endsection
