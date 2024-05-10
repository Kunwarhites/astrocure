@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Service List')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .data-table thead th {
            background-color: #121c39; /* Set your desired background color */
            color: white; /* Set the text color */
            font-weight: bold; /* Set the font weight */
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
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('success') }}
                                    <i class=" btn-close float-right" data-bs-dismiss="alert"
                                        aria-label="Close"></i>
                                </div>
                            @endif
                            @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                <i class=" btn-close float-right" data-bs-dismiss="alert"
                                    aria-label="Close"></i>
                            </div>
                            @endif
                            <div class="card-header">
                                <div class="card-title">
                                    <a href="{{ route('servicecreate') }}" class="btn btn-primary">Create</a>
                                </div>
                                <div class="card-tools"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered text-center table-striped table-hover responsive small no-footer data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Thumbnail</th>
                                            <th>Title</th>
                                            <th>Short Description</th>
                                            <th>Description</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Dynamically Table Data Fetch from Database with ajax DataTables --}}
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



    <!--Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="update_service" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="service_id" id="service_id">
                            <input type="hidden" name="service_pic" id="service_pic">
                            <div class="col-md-12 text-center mb-2">
                                <div id="image"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Title</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="short_description">Short Description</label>
                                <input type="text" name="short_description" id="short_description" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea class="summernote" name="description"  id="description"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status">Picture</label>
                                <input type="file" name="image" class="form-control">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btn_updateService">Update</button>
                    </div>
                </form>
                </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    {{-- Table data show --}}
    <script>
        $(document).ready(function($) {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('serviceList') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'image_url',
                        name: 'image_url',
                        render: function(service) {
                            return '<img src="' + service +
                                '" alt="" class="rounded-circle object-fit-cover" width="50" height="50">';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'short_description',
                        name: 'short_description'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Use jQuery to create a temporary element and then get the text content
                                var tempDiv = document.createElement('div');
                                tempDiv.innerHTML = data;
                                return tempDiv.textContent || tempDiv.innerText;
                            } else {
                                return data;
                            }
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
    </script>


    {{-- summer note  --}}
    <script type="text/javascript">
        $('.summernote').summernote({
            tabsize: 2,
            height: 100
        });
    </script>


    {{-- Ediit service ajax handle request --}}
    <script>
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editService', ['id' => 'id']) }}', // Use double curly braces to interpolate the variable
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    // Assuming that 'res' contains user information
                    $("#name").val(res.name);
                    $("#short_description").val(res.short_description);
                    $("#description").html(res.description);
                    $("#status").val(res.status);
                    // Display the user's profile picture
                    $("#image").html(
                        `<img src="/uploads/services/thumb/small/${res.image}" alt="" class="rounded-circle object-fit-cover" width="80" height="80">`
                    );
                }
            });
        });
    </script>

    {{-- Delete      --}}
    <script>


        // Delete Ajax
        $(document).on('click', '.deleteService', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "Service Deleted Successfully!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delService', ['id' => 'id']) }}',
                        method: 'post',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire(
                                'Deleted!',
                                'Service Deleted Successfully!',
                                'success'
                            );
                            location.reload();
                        },
                    });
                }
            });
        });

    </script>

@endsection
