@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Edit Banner')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css"
        integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-home"></i> home</a> / Banner /
                                    Edit
                                </div>
                                <div class="col-md-12">
                                    <form action="{{ route('updateBanner', ['id' => $ban->id]) }}" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <input type="hidden" name="ban_id" value="{{ $ban->id }}">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="desktopimage">Desktop Image</label>
                                                    <input type="file" name="image_desktop" id="desktopimage" class="form-control">
                                                    <img src="{{ asset('uploads/banners/desktop/' . $ban->image_desktop) }}" alt="" width="100%" class="mt-3">
                                                    
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="desktopimage">Phone Image</label>
                                                    <input type="file" name="image_phone" id="image_phone" class="form-control">
                                                    <img src="{{ asset('uploads/banners/phone/' . $ban->image_phone) }}" alt="" width="30%" class="mt-3">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1" @if ($ban->status == 1) selected @endif>Active</option>
                                                        <option value="0" @if ($ban->status == 0) selected @endif>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="updatebanner_btn" class="btn btn-primary">Update</button>
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

@endsection
