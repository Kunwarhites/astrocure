@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Banner')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.7/r-2.5.0/datatables.min.css" rel="stylesheet">

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
    </style>
</head>

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
                                    <h4>@yield('title')</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="javascript:void(0)" class="btn " id="addastrologer">
                                        <i class="fas fa-book-medical me-1"></i> New Banner
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table
                                class="table  table-bordered text-center table-striped table-hover responsive small no-footer data-table">
                                <!-- Table header -->
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image Desktop View</th>
                                        <th>Image Phone View</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Status</th>
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
<div class="modal fade" id="addBanner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="addbannerform">

                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="desktopimage">Desktop Image</label>
                            <input type="file" name="image_desktop" id="desktopimage" class="form-control">
                            <span class="text-success small">Banner Desktop Image width or Height cannot be less than
                                1600px * 462px</span>
                            <div class="imag-d"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="desktopimage">Phone Image</label>
                            <input type="file" name="image_phone" id="image_phone" class="form-control">
                            <span class="text-success small">Banner Phone Image width or Height cannot be less than
                                375px
                                * 450px</span>
                            <div class="phon-img"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="statsu">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option selected disabled>--Select--</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="addbanner_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>





<script>
    jQuery(document).ready(function($) {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('banner') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'image_urldesktop',
                    name: 'image_urldesktop',
                    render: function(banner) {
                        return '<img src="' + banner +
                            '" alt="" class=" object-fit-cover" width="auto" height="50">';
                    }
                },
                {
                    data: 'image_urlphone',
                    name: 'image_urlphone',
                    render: function(banner) {
                        return '<img src="' + banner +
                            '" alt="" class=" object-fit-cover" width="auto" height="50">';
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        // Assuming data is a timestamp (e.g., '2023-10-21 08:30:00')
                        if (type === 'display' || type === 'filter') {
                            // Convert the timestamp to a Date object
                            var date = new Date(data);
                            // Format the date as 'MM/DD/YYYY' (e.g., '10/21/2023')
                            return date.toLocaleDateString('en-US');
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    render: function(data, type, row) {
                        // Assuming data is a timestamp (e.g., '2023-10-21 08:30:00')
                        if (type === 'display' || type === 'filter') {
                            // Convert the timestamp to a Date object
                            var date = new Date(data);
                            // Format the date as 'MM/DD/YYYY' (e.g., '10/21/2023')
                            return date.toLocaleDateString('en-US');
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        if (data === 1) {
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


    // add Banner
    $(function() {
        // Show the modal when the button is clicked
        $("#addastrologer").on('click', function() {
            $("#addBanner").modal('show');
        });
        // Handle form submission
        $("#addbannerform").submit(function(e) {
            e.preventDefault();
            $("#addbanner_btn").html("Please wait...");
            var form = $(this);
            const fd = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // Include CSRF token in request headers
                },
                url: '{{ route('banner.store') }}',
                method: 'POST',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 200) {
                        Swal.fire({
                            title: 'Added!',
                            text: 'Banner Added Successfully',
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#addbanner_btn").html("Save");
                                window.location.href = '{{ route('banner') }}';
                            }
                        });
                    }
                }
            });
        });
    });
</script>
{{--



{{-- delete --}}
<script>
    $(document).on('click', '.delete', function(e) {
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
                    url: '{{ route('banner.delete', ['id' => 'id']) }}',
                    method: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        Swal.fire(
                            'Deleted!',
                            'Banner Deleted Successfully!',
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

@endsection


