@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'FAQ')

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
                                        <a href="#" class="btn " id="addastrologer">
                                            <i class="fas fa-book-medical me-1"></i> New Faq
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
                                            <th>Question</th>
                                            <th>Answer</th>
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


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">FAQ's Edit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" id="editFaqForm">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="use_id" id="use_id">
                <div class="col-12 mb-3">
                    <label for="">Question</label>
                    <input type="text" name="question" id="question_update" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="">Answer</label>
                    <input type="text" name="answer" id="answer_update" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="">Status</label>
                    <select class="form-select dropdown-toggle" name="status" id="status_update">
                        <option disabled selected>--Select Status--</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="UpdateS_btn" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
    </div>
  </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>

    <script>
        $(document).ready(function($) {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('faq') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },

                    {
                        data: 'question',
                        name: 'question'
                    },
                    {
                        data: 'answer',
                        name: 'answer'
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
                    }
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
                    url: '{{ route('faq.edit', ['id' => 'id']) }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        // Assuming that 'res' contains user information
                        $("#question_update").val(res.question);
                        $("#answer_update").val(res.answer);
                        $("#status_update").val(res.status);
                        $("#use_id").val(res.id);
                    }
                });
            });
        </script>

<script>
    $('#editFaqForm').submit(function(e) {
        e.preventDefault(e);
        const fd = new FormData(this);
        $("#UpdateS_btn").text('Updating...').prop('disabled', true);
        $.ajax({
            url: '{{ route('faq.update', ['id' => 'id']) }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res) {
                Swal.fire(
                    'Updated!',
                    'Faq Updated Sucessfully!',
                    'success'
                );
                $("#UpdateS_btn").text('Updating').prop('disabled', false);
                $("#myModal").modal('hide');
                location.reload();
            }

        });
    });
</script>

    <script>
    // Delete Ajax
    $(document).on('click', '.delfaq', function(e){
        e.preventDefault();
        let id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Faq Deleted Successfully!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('faq.destroy', ['id' => 'id']) }}',
                    method: 'post',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        Swal.fire(
                            'Deleted!',
                            'Faq Deleted Successfully!',
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
