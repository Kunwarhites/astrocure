@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Appointment')

<head>
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css?<?= time() ?>"
    integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
                                        <h4>Appointments</h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('appointment.create')}}" class="btn " id="addastrologer">
                                            <i class="fas fa-book-medical me-1"></i> New Appointment
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
                                            <th>S.No</th>
                                            <th>UserId</th>
                                            <th>Name</th>
                                            <th>Service</th>
                                            <th>Time</th>
                                            <th>Appointment Date</th>
                                            <th>Payment</th>
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
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>


{{-- ajax table  --}}
<script>
    jQuery(document).ready(function($) {

        var table = $(".data-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('appointment') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'user_id',
                    name: 'user_id',
                },
                {
                    data: 'user_name',
                    name: 'user_name',
                },
                {
                    data: 'service',
                    name: 'service'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'date',
                    name: 'date'
                },

                {
                    data: 'payment_data',
                    name: 'payment_data'
                },
               {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }],
        });

    });
</script>
