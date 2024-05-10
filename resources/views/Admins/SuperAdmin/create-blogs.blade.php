@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Create Blog')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css"
        integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #image {
            border-style: dashed !important;
            background: #fff;
            border-radius: 5px;
            border-image: none;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            font-family: sans-serif;
            font-weight: 700;
            font-style: italic;
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
                            <div class="col-md-12 bg-light mb-4 p-2">
                                <a href="{{ route('dashboard') }}"><i class="fa-solid fa-home"></i> home</a> / Blogs /
                                Create
                            </div>
                            <div class="col-md-12">
                                <form action="" autocomplete="off" method="POST" id="blogsCreateForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Name</label>
                                        <input type="text" class="form-control error_message" name="name"
                                            id="name">
                                        <div class="error_message text-danger"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Description</label>
                                        <textarea class="summernote" name="description" id="description"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="hidden" name="image_id" id="image_id" value="">
                                            <label for="exampleInputPassword1" class="form-label">Image</label>
                                            <div id="image"  class="dropzone dz-clickable border border-info">
                                                <div class="dz-message needsclick text-muted">
                                                    <br>Drop files here or click to upload
                                                    <br><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Short
                                                Description</label>
                                            <textarea name="short_description" id="short_description" class="form-control" cols="30" rows="7"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Post By </label>
                                            <select name="by" id="by" class="form-control">
                                                <option selected disabled>--Select Status--</option>
                                                @foreach ($postby as $by)
                                                <option value="{{ $by->id}}">{{$by->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option selected disabled>--Select Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" id="service_btn"
                                        class="btn btn-primary">Create</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"
        integrity="sha512-9e9rr82F9BPzG81+6UrwWLFj8ZLf59jnuIA/tIf8dEGoQVu7l5qvr02G/BiAabsFOYrIUTMslVN+iDYuszftVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script type="text/javascript">
            $('.summernote').summernote({
                tabsize: 2,
                height: 150
            });
        </script>

<script>
    Dropzone.autoDiscover = false;
    const dropzone = $("#image").dropzone({
        init: function() {
            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        },
        url: '{{ route('tempUpload') }}',
        maxFiles: 1,
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/jpg,image/png,image/gif,",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(file, response) {
            $("#image_id").val(response.id);
        }
    });

    // Handle ajax request form store
    $("#blogsCreateForm").submit(function(e) {
        e.preventDefault();
        $("#service_btn").html("please wait...")
        var formData = new FormData(this);
        $.ajax({
            url: '{{ route('blogsstore') }}',
            method: 'POST',
            dataType: 'json',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status == 200) {
                    // Success
                    Swal.fire(
                        'Added!',
                        'Blog Added Successfully',
                        'success'
                    )
                    $("#service_btn").html("Create");
                    window.location.href = '{{ route('blogs')}}';
                } else {
                    // Handle errors here
                    $('.error_message').html(res.errors.name);
                    $("#service_btn").html("Create");
                }
            }

        });
    });
</script>


@endsection
