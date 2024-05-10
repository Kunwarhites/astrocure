@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Astrologer')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.7/r-2.5.0/datatables.min.css" rel="stylesheet">

    <style>
        .data-table thead th {
            background-color: #121c39;
            /* Set your desired background color */
            color: white;
            background-image: linear-gradient(180deg, #1c2b55 10%, #080d1d 100%);
            background-size: cover;
        }

        a#addastrologer {
            background-color: #121c39;
            /* Set your desired background color */
            color: white;
            background-image: linear-gradient(180deg, #1c2b55 10%, #080d1d 100%);
            background-size: cover;
        }

        .btn {
            background-color: #121c39;
            /* Set your desired background color */
            color: #fff !important;
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
                                <a href="{{ route('astrologerCreate') }}" class="btn" id="addastrologer">
                                    <i class="fa-solid fa-plus text-white"></i> Add Astrologer
                                </a>
                            </div>
                            <div class="card-body">
                                <table
                                    class="table table-bordered table-striped table-hover small responsive no-footer data-table">
                                    <!-- Table header -->
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
                                            <th>Service</th>
                                            <th>status</th>
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


    {{-- edit modal  --}}
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit <span></span> Astrologer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="editAstrologerForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="use_id" id="use_id">
                            <div class="col-md-12 mb-3">
                                <label for="">Astrologer ID:</label>
                                <input type="text" class="form-control" disabled name="astrologer_id" id="astrologer_id">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name_edit" placeholder="Enter Name"
                                    class="form-control errors">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email_edit" placeholder="example@gmail.com"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact">Contact:</label>
                                <input type="text" id="phone_edit" placeholder="e.g. 9999999999 " name="phone"
                                    class="form-control" maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    pattern="[6-9][0-9]{9}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender">Gender:</label>
                                <div class="form-control text-nowrap">
                                    <input type="radio" name="gender" id="gender_id" value="Male"> Male <span
                                        class="mx-2"></span>
                                    <input type="radio" name="gender" id="gender_id" value="Female"> Female <span
                                        class="mx-2"></span>
                                    <input type="radio" name="gender" id="gender_id" value="Other"> Other
                                </div>
                            </div>
                            <div class="col-6 form-group ">
                                <label for="usr" class="ps-0">Service:</label>
                                <div class="row px-4">
                                    @foreach ($services as $service)
                                        <div class="col-sm-4 my-1 text-wrap">
                                            <input class="form-check-input" name="service" id="service_edit" type="radio"
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
                                <div class="mt-2" id="astrologer_picture"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option selected disabled>--Select Status--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn" id="UpdateS_btn">Update</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.7/r-2.5.0/datatables.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            var table = $(".data-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('astrologer') }}",
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
                        data: 'name',
                        name: 'name',
                        render: function(data, type, full, meta) {
                            return '<div style="text-align: left;"><strong>' + data +
                                '</strong>' + '<br>' + '<div style="color:green;">' + full
                                .astrologer_id + '</div>' +
                                '</div>'; // Concatenate name and astrologer ID
                        }
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
                        data: 'service',
                        name: 'service'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<span class="badge bg-success">Active</span>';
                            } else {
                                return '<span class="badge bg-danger">Inactive</span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]

            });
        });
    </script>

    {{-- edit modal ajax request  --}}
    <script>
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('astrologer.edit', ['id' => 'id']) }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    // Assuming that 'res' contains user information
                    $("#name_edit").val(res.name);
                    $("#astrologer_id").val(res.astrologer_id);
                    $("#email_edit").val(res.email);
                    $("#phone_edit").val(res.phone);
                    // Set the gender radio button
                    $("input[name='gender'][value='" + res.gender + "']").prop("checked", true);
                    // Set the services checkboxes
                    let services = res.service.split(',');
                    services.forEach(function(service) {
                        $("input[name='service'][value='" + service.trim() + "']").prop(
                            "checked", true);
                    });
                    // Set the status select
                    $("#status").val(res.status);
                    // Display the user's profile picture
                    $("#astrologer_picture").html(
                        `<img src="/images/Astrologers_Profile_pic/${res.profile_pic}" alt="" class="rounded-circle object-fit-cover" width="100" height="100" >`
                    );
                    $("#use_id").val(res.id);
                }
            });
        });
    </script>
    {{-- Update astrologer ajax handle request --}}
    <script>
        $('#editAstrologerForm').submit(function(e) {
            e.preventDefault(e);
            const fd = new FormData(this);
            $("#UpdateS_btn").text('Updating...').prop('disabled', true);
            $.ajax({
                url: '{{ route('astrologer.update', ['id' => 'id']) }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire(
                        'Updated!',
                        'Astrologer Updated Sucessfully!',
                        'success'
                    );
                    $("#UpdateS_btn").text('Updating').prop('disabled', false);
                    $("#myModal").modal('hide');
                    location.reload();
                }

            });
        });
    </script>

    {{-- Delete Astrologer  --}}
    <script>
        $(document).on('click', '.deleteAstrologer', function(e) {
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
                        url: '{{ route('astrologer.destroy', ['id' => 'id']) }}',
                        method: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire(
                                'Deleted!',
                                'Astrologer Deleted Successfully!',
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

{{-- <script>
    $(document).ready(function () {
        $('.updateStatus').on('click', function (e) {
            e.preventDefault();

            var id = $(this).attr('id');

            // Make an AJAX request to update the status
            $.ajax({
                url: '{{ route('update-status', ['id'=>'id']) }}',
                method: 'GET',
                success: function (response) {
                    // Handle the success response, e.g., update UI
                    console.log(response);

                    // Update the UI based on the new status
                    if (response.status == 1) {
                        // If status is active, update UI accordingly
                        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        // If status is inactive, update UI accordingly
                        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                    }

                    // You can reload the table or update the UI as needed
                    // table.reload();
                },
                error: function (error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        });
    });
</script> --}}
@endsection
