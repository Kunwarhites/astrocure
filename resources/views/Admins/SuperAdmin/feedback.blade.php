@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Feedbacks')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css"
        integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <style>
        .data-tables thead th {
            background-color: #121c39;
            background-image: linear-gradient(180deg, #1c2b55 10%, #080d1d 100%);
            background-size: cover;
            color: #fff;
        }

        .fa-star.selected {
            color: gold;
            /* or any other color you prefer */
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
                            <div class="card-body">
                                <table
                                    class="table table-bordered table-striped  no-footer table-hover responsive small data-tables">
                                    <!-- Table header -->
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- Table body will be populated using Ajax -->
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

    {{-- modal --}}
    <div class="modal fade" id="myFeedModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Feedback</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form  id="feed_form">
                        @csrf
                        <input type="hidden" name="use_id" id="use_id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" id="name_update" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" id="email_update" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Rating</label>
                                <input  class="form-control" name="rating" id="rating_update">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Comment</label>
                                <textarea name="comment" id="comment_update" class="form-control" cols="30" rows="4"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="image"  class="form-control">
                                <div class="mt-2" id="feed_image"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Status</label>
                                <select class="form-select dropdown-toggle" name="status" id="status_update">
                                    <option disabled selected>--Select Status--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 text-end">
                            <button class="btn btn-primary" id="feed_btn" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
    <script>
        let selectedRating = 0;

        function setRating(rating) {
            selectedRating = rating;

            // Log to the console for debugging
            console.log('Selected Rating:', selectedRating);

            // Highlight the selected stars
            const stars = document.querySelectorAll('.fa-star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });

            // Update the hidden input field
            document.getElementById('rating').value = rating;

            // Log to the console again for debugging
            console.log('Updated Rating Field:', document.getElementById('rating').value);
        }
    </script>
    <script>
        jQuery(document).ready(function($) {

            var table = $(".data-tables").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('feedback') }}",
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
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'rating',
                        name: 'rating',
                        render: function(data, type, full, meta) {
                            // Assuming 'rating' is a numeric value, and you want to display gold-colored stars based on it
                            var stars = '';
                            for (var i = 1; i <= 5; i++) {
                                stars += i <= data ?
                                    '<i class="fas fa-star" style="color: gold;"></i>' :
                                    '<i class="far fa-star"></i>';
                            }
                            return stars;
                        }
                    },

                    {
                        data: 'comment',
                        name: 'comment'
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
    {{-- edit --}}
    <script>
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('feedback.edit', ['id' => 'id']) }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    // Assuming that 'res' contains user information
                    $("#name_update").val(res.name);
                    $("#email_update").val(res.email);
                    $("#rating_update").val(res.rating);
                    $("#comment_update").val(res.comment);
                    $("#status_update").val(res.status);
                    $("#use_id").val(res.id);
                    $("#feed_image").html(
                        `<img src="/images/Feedbacks_Userimage/${res.image}" alt="" class="rounded-circle object-fit-cover" width="100" height="100" >`
                    );
                }
            });
        });
    </script>

    {{-- Upload ajax --}}
    <script>
        $('#feed_form').submit(function(e) {
            e.preventDefault(e);
            const fd = new FormData(this);
            $("#feed_btn").text('Updating...').prop('disabled', true);
            $.ajax({
                url: '{{ route('feedback.update', ['id' => 'id']) }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire(
                        'Updated!',
                        'Feedback Updated Sucessfully!',
                        'success'
                    );
                    $("#feed_btn").text('Updating').prop('disabled', false);
                    $("#myModal").modal('hide');
                    location.reload();
                }
    
            });
        });
    </script>

    {{-- Delete ajax  --}}
    <script>
        $(document).on('click', '.deletefeeds', function(e) {
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
                        url: '{{ route('delfeeds', ['id' => 'id']) }}',
                        method: 'post',
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

@endsection
