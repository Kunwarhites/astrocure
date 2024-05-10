@extends('Admins.SuperAdmin.Layouts.app')
@section('title', 'Appointments Create')

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
                                        <h4>New Appointment Entry</h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('appointment') }}" class="btn " id="addastrologer">
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
                                <div class="col-md-12 card-header  border-bottom mt-3 bg-light p-2 ">
                                    <h6 class="text-bold">Astrologer Deatils <span class="text-danger">*</span></h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" id="appointment_create" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Astrologer:</label>
                                            <select class="form-select astrologer_list" name="astrologer" id="astrologer">
                                                <option value="" selected disabled>Select Astrologer</option>
                                                @foreach($astrologers as $astrologer)
                                                    <option value="{{ $astrologer->name }}">{{ $astrologer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Appointment Date:</label>
                                            <div>
                                                <select name="appointment_date" id="selected_day" class="form-select  ">
                                                    <option disabled selected>--Select Date--</option>
                                                    @foreach ($appointments as $appointment)
                                                        @if (!$appointment['off'])
                                                            <option value="{{ $appointment['full_date'] }}">
                                                                {{ $appointment['date'] }} - {{ $appointment['day_name'] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="available_hours">Available Hours:</label>
                                            <div id="available_hours_container"  class="border py-2 rounded"></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="user">User:</label>
                                            <select class="form-select user_list" name="user" id="user">
                                                <option value="" selected disabled>Select User</option>
                                                @foreach ($stds as $std)
                                                    <option value="{{ $std->name }}">
                                                        {{ $std->name }} [<sup class="text-muted">{{ $std->registration_id }}</sup>]
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        {{-- <div class="col-md-6 mb-3">
                                            <label for="user">Booking For:</label>
                                            <div>
                                                <button class="btn border border-primary">Users</button>
                                                <button class="btn border border-primary">Other</button>

                                            </div>
                                        </div> --}}
                                        <div class="col-6 form-group ">
                                            <label for="usr" class="ps-0">Service:</label>
                                            <div class="row px-4">
                                                @foreach ($services as $service)
                                                    <div class="col-sm-4 my-1 text-wrap">
                                                        <input class="form-check-input" name="service" type="checkbox"
                                                            id="department_0" value="{{ $service->name }}">
                                                        <label class="form-check-label" for="department_0">
                                                            {{ $service->name }}
                                                        </label>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4 card-header d-flex  border-bottom  bg-light p-2 ">
                                        <h6 class="text-bold">Problem Describe <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 form-group">
                                            <label for="usr">Problem:</label>
                                            <textarea class="form-control" name="problem" placeholder="Describe Your Problem in short...."></textarea>
                                        </div>

                                        <div class="col-sm-3"></div>
                                        <div class="col-12 my-3 d-flex justify-content-end">
                                            <button type="submit" class="btn w-25 btn-small text-white"
                                                id="addastrologer">Book Appointment</button>
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



<script>
document.addEventListener('DOMContentLoaded', function () {
    var appointments = {!! json_encode($appointments) !!};

    var selectedDayElement = document.getElementById('selected_day');
    var availableHoursContainer = document.getElementById('available_hours_container');
    var form = document.getElementById('appointment_create');

    if (selectedDayElement) {
        selectedDayElement.addEventListener('change', function () {

            var selectedDate = this.value;
            var selectedAppointment = appointments.find(appointment => appointment.full_date === selectedDate);

            if (selectedAppointment) {
                availableHoursContainer.innerHTML = ''; // Clear previous content
                // console.log('Available Hours:', selectedAppointment.available_Hours); // Debugging statement

                if (selectedAppointment.available_Hours.length > 0) {
                    // Filter out booked slots
                    var bookedSlots = selectedAppointment.reserved_hours;
                    var availableSlots = selectedAppointment.available_Hours.filter(function (slot) {
                        return bookedSlots.indexOf(slot) === -1;
                    });
                    availableSlots.forEach(function (slot) {
                        var slotButton = document.createElement('button');
                        slotButton.textContent = slot;
                        slotButton.value = slot;
                        slotButton.type = 'button';
                        slotButton.name = 'selected_slot';
                        slotButton.style.backgroundColor = '#121c39';
                        slotButton.style.border = '3px solid #284394';
                        slotButton.style.color = '#fff';
                        slotButton.style.margin = '2px';
                        slotButton.style.borderRadius = '5px';

                        availableHoursContainer.appendChild(slotButton);
                    });
                } else {
                    availableHoursContainer.textContent = 'No available hours for this day.';
                    availableHoursContainer.style.color = 'red';
                }
            }
        });
    }
});

</script>



