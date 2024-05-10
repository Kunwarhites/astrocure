@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Events')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css"
        integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
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
                                        <a href="{{ route('events.create') }}" class="btn " id="addastrologer">
                                            <i class="fas fa-book-medical me-1"></i> New Event
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
                                            <th>Thumbnail</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Language</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Rate</th>
                                            <th>Hours</th>
                                            <th>Organized By</th>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>

    <script>
        $(document).ready(function($) {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('events') }}',
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
                        data: 'language',
                        name: 'language'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'date',
                        name: 'date',
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
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'rate',
                        name: 'rate',
                        render: function(data, type, row) {
                            // Assuming 'rate' is a numeric value
                            return '₹ ' + data; // Add Rupees sign to the value
                        }
                    },
                     {
                        data: 'hours',
                        name: 'hours'
                    },
                     {
                        data: 'organized',
                        name: 'organized'
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
    <script>
    // Delete Ajax
    $(document).on('click', '.delevent', function(e){
        e.preventDefault();
        let id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Event Deleted Successfully!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('events.destroy', ['id' => 'id']) }}',
                    method: 'post',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        Swal.fire(
                            'Deleted!',
                            'Event Deleted Successfully!',
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
