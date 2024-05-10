@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Dashboard')
<style>
    .border-top-primary {
        border-top: 0.25rem solid #233f91 !important;
    }

    div#footer-das {
        color: white !important;
        background-color: #101932 !important;
        background-image: linear-gradient(180deg, #1c2b55 10%, #080d1d 100%) !important;
        background-size: cover !important;
        border-radius: 0 0 calc(0.35rem - 1px) calc(0.35rem - 1px);
    }

    i#icon-d {
        color: #dddfeb !important;
        font-size: 3rem !important;
    }
</style>
@section('content')
    <!-- Content Wrapper. Contains page content -->
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
                        <div class="row">
                            {{-- User dasboard --}}
                            <div class="col-xl-3 col-md-6 mb-1">
                                <div class="card border-top-primary shadow  pt-3">
                                    <div class="card-body mb-3">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h3 mb-3 font-weight-bold text-lg text-gray-800">
                                                    7
                                                </div>
                                                <div class=" mb-0 font-weight-bold text-xs text-primary text-uppercase">
                                                    User</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-muted" id="icon-d"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center bg-gradient-primary py-1" id="footer-das">
                                        <a href="{{ route('users')}}"
                                            class="text-white text-decoration-none"><i class="fa fa-eye me-2"></i> View </a>
                                    </div>
                                </div>
                            </div>
                            {{-- Services --}}
                            <div class="col-xl-3 col-md-6 mb-1">
                                <div class="card border-top-primary shadow  pt-3">
                                    <div class="card-body mb-3">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h3 mb-3 font-weight-bold text-lg text-gray-800">
                                                    7
                                                </div>
                                                <div class=" mb-0 font-weight-bold text-xs text-primary text-uppercase">
                                                    Services</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-brands fa-servicestack fa-2x text-muted" id="icon-d"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center bg-gradient-primary py-1" id="footer-das">
                                        <a href="{{ route('serviceList')}}"
                                            class="text-white text-decoration-none"><i class="fa fa-eye me-2"></i> View </a>
                                    </div>
                                </div>
                            </div>
                            {{-- Enquiry --}}
                            <div class="col-xl-3 col-md-6 mb-1">
                                <div class="card border-top-primary shadow  pt-3">
                                    <div class="card-body mb-3">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h3 mb-3 font-weight-bold text-lg text-gray-800">
                                                    7
                                                </div>
                                                <div class=" mb-0 font-weight-bold text-xs text-primary text-uppercase">
                                                    Astrologer </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-brands fa-teamspeak fa-2x text-muted" id="icon-d"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center bg-gradient-primary py-1" id="footer-das">
                                        <a href="{{ route('astrologer')}}"
                                            class="text-white text-decoration-none"><i class="fa fa-eye me-2"></i> View </a>
                                    </div>
                                </div>
                            </div>
                            {{-- Enquiry --}}
                            <div class="col-xl-3 col-md-6 mb-1">
                                <div class="card border-top-primary shadow  pt-3">
                                    <div class="card-body mb-3">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h3 mb-3 font-weight-bold text-lg text-gray-800">
                                                    7
                                                </div>
                                                <div class=" mb-0 font-weight-bold text-xs text-primary text-uppercase">
                                                    Enquiry</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-circle-question fa-2x text-muted" id="icon-d"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center bg-gradient-primary py-1" id="footer-das">
                                        <a href="{{ route('enquiry')}}"
                                            class="text-white text-decoration-none"><i class="fa fa-eye me-2"></i> View </a>
                                    </div>
                                </div>
                            </div>
                            {{-- Appointents --}}
                            <div class="col-xl-3 col-md-6 mb-1">
                                <div class="card border-top-primary shadow  pt-3">
                                    <div class="card-body mb-3">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h3 mb-3 font-weight-bold text-lg text-gray-800">
                                                    7
                                                </div>
                                                <div class=" mb-0 font-weight-bold text-xs text-primary text-uppercase">
                                                    Appointents</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-gear fa-2x text-muted" id="icon-d"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center bg-gradient-primary py-1" id="footer-das">
                                        <a href="{{ route('appointment')}}"
                                            class="text-white text-decoration-none"><i class="fa fa-eye me-2"></i> View </a>
                                    </div>
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
    <!-- /.content-wrapper -->


    <script></script>
@endsection
