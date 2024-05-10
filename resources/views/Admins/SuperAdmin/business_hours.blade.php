@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Wrok Schedule')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                                        <h4>Wrok Schedule</h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="#" class="btn " id="addastrologer">
                                            <i class="fa-solid fa-arrow-left text-white"></i> Return
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="col-12">
                                <div class="col-12 mb-4 card-header d-flex  border-bottom  bg-light p-2 ">
                                    <h6 class="text-bold">Working Schedule <span class="text-danger">*</span></h6>
                                    &nbsp;<span class="text-muted text-thin">Schedule Slot</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('businessHoursupdate')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 h6  mb-1 fw-bold">
                                            Schedule<span class="text-danger">*</span>
                                        </div>
                                        <div class="row">
                                            @foreach ($busineshours as $busineshour)
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-2 form-group">
                                                    <label for="usr">Days:</label>
                                                    <h5>{{ $busineshour->day }}</h5>
                                                    <input type="hidden" name="data[{{$busineshour->day}}][day]" value="{{$busineshour->day}}">
                                                </div>
                                                <div class="col-sm-3 form-group">
                                                    <label for="usr">Start Time:</label>
                                                    <input type="time" class="form-control" name="data[{{ $busineshour->day }}][from]"
                                                        value="{{ $busineshour->from }}" >
                                                </div>
                                                <div class="col-sm-3 form-group">
                                                    <label for="usr">End Time:</label>
                                                    <input type="time" class="form-control" name="data[{{ $busineshour->day }}][to]"
                                                        value="{{ $busineshour->to }}">
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <label for="usr">Step:</label>
                                                    <input type="number" class="form-control" name="data[{{ $busineshour->day }}][step]"
                                                    value="{{ $busineshour->step }}">
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <input type="checkbox" class="mt-5" name="data[{{ $busineshour->day }}][off]"
                                                        @checked($busineshour->off)>
                                                    <span>OFF</span>
                                                </div>
                                            @endforeach
                                            <div class="col-sm-12 mt-3 mb-3 d-flex justify-content-center">
                                                <button type="submit" class="btn  btn-block w-25 btn-small text-white"
                                                    id="addastrologer">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
