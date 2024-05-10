@extends('Frontend.Layouts.app')
@section('title', 'Appointment')

@section('content')
    <style>
        /* Add custom CSS here */
        .appointment {
            background-color: #ff7010;
            color: #fff;
        }

        .btn {
            background-color: #ff7010;
            border-color: #ff7010;
            color: #fff;
        }
    </style>
    <section id="title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " id="account-title">
                    <h1 id="account-detal-head">
                        Appointment Calendar</h1>
                    <div class="sub-title-detail">
                        <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp;Appointment Calendar
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section id="appointment">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="calendar">

                        <div class="row">
                            @foreach ($appointments as $appointment)
                                <div class="col-lg-2 col-xs-4" id="app-col">
                                    {{ $appointment['date'] }}<br>
                                    {{ $appointment['day_name'] }} <br>
                                    <br>
                                    @if (!$appointment['off'])
                                        @foreach ($appointment['busines_hours'] as $time)
                                            @if (!in_array($time, $appointment['reserved_hours']))
                                                <button class="btn" data-date="{{ $appointment['full_date'] }}"
                                                    data-time="{{ $time }}">{{ $time }}</button> <br><br>
                                            @else
                                                <button class="btn btn-danger" disabled>{{ $time }}</button>
                                                <br><br>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    {{-- @if (!session()->has('loggedInUser'))
    <!-- Show a pop-up modal asking the user to log in -->
    <script>
        $(document).ready(function() {
            $('#loginModal').modal('show');
        });
    </script>

    <!-- Optional: You can redirect to the login page using JavaScript -->
    <script>
        window.location.href = '{{ route('Frontend.login') }}';
    </script>
@else
    @if (session()->has('loggedInUser'))
    <div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog"
    aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">Appointment Details and Payment Confirmation
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="appointmentForm">
                    <!-- Appointment details -->
                    <p id="appointmentDetails"></p>

                    <!-- Service selection -->
                    <div class="form-group">
                        <label for="service">Service:</label>
                        <select class="form-control" id="service" name="service">
                            <!-- Populate this with your service options -->
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                            <!-- Add more options as needed -->
                        </select>
                    </div>

                    <!-- Astrologer selection -->
                    <div class="form-group">
                        <label for="astrologer">Astrologer:</label>
                        <select class="form-control" id="astrologer" name="astrologer_userID">
                            <!-- Populate this with your astrologer options -->
                            @foreach ($astrologers as $astrologer)
                                <option value="{{ $astrologer->id }}">{{ $astrologer->name }}</option>
                            @endforeach
                            <!-- Add more options as needed -->
                        </select>
                    </div>

                    <!-- Payment rate input -->
                    <div class="form-group">
                        <label for="paymentRate">Payment Rate:</label>
                        <input type="text" class="form-control" id="payment_data" name="payment_data"
                            readonly>
                    </div>

                    <!-- Additional content as needed -->

                    <!-- Hidden input fields for appointment data -->
                    <input type="hidden" id="hiddenDate" name="date">
                    <input type="hidden" id="hiddenTime" name="time">

                    <button type="submit" class="btn btn-primary mt-2 float-end">Pay Now</button>
                </form>
            </div>
            <div class="modal-footer">
                <!-- You can add buttons or additional content in the footer as needed -->
            </div>
        </div>
    </div>
</div>
    @endif

@endif

<!-- Optional: Add a hidden login modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Please Log In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Please log in to access appointments.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('Frontend.login') }}" class="btn btn-primary">Log In</a>
            </div>
        </div>
    </div>
</div> --}}
    <!-- Add these script tags before the closing </body> tag -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            $('.open-popup').click(function() {
                var date = $(this).data('date');
                var time = $(this).data('time');
                var appointmentDetails = 'Date: ' + date + '<br>Time: ' + time;

                // Set the appointment details in the modal
                $('#appointmentDetails').html(appointmentDetails);

                // Show the modal
                $('#appointmentModal').modal('show');
            });
        });
    </script> --}}

@endsection
