@extends('Frontend.Layouts.app')
@section('title', 'Event')

@section('content')

    <section id="title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " id="account-title">
                    <h1 id="account-detal-head">Events</h1>
                    <div class="sub-title-detail">
                        <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp; Events
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <section class="events">
        <div class="container">
            <div class="row">
                <!-- events item start -->
                @foreach ($events as $event)
                    @php
                        $formattedDate = \Carbon\Carbon::parse($event->date)->format('d M Y');
                        $formattedDates = \Carbon\Carbon::parse($event->date)->format('M d ');
                        $formattedTime = \Carbon\Carbon::parse($event->time)
                            ->setTimezone('Asia/Kolkata')
                            ->format('h:i A');

                    @endphp

                    <div class="events-item" onclick="window.location.href = 'event-detail/{{ $event->name }}';">
                        <div class="events-item-inner" style="border: 1px solid #425a6aab; border-radius:0 10px 0 0">
                            <img src="{{ url('./uploads/event/thumb/smalls/' . $event->picture) }}" alt="shoe">
                            <h5 class="text-white text-center mt-2" id>{{ $event->name }} on {{ $formattedDates }} </h5>
                            <hr style="color: #ff7010;">
                            <h6 class="text-white px-4 mt-2"> Price Starts From: ₹ <span
                                    style="color: #ff7010">{{ $event->rate }}</span></h6>
                            <h6 class="text-white px-4 mt-2 mb-3"><i class="fa-solid fa-rectangle-list"
                                    style="color: #ff7010"></i> Organized by: {{ $event->organized }}</h6>
                            <h6 class="text-white px-4 mt-2 mb-3"><i class="fa-solid fa-location-dot"
                                    style="color: #ff7010"></i> Location by: {{ $event->location }}</h6>
                            <h6 class="text-white px-4 mt-2 mb-3"><i class="fa-solid fa-calendar"
                                    style="color: #ff7010"></i> {{ $formattedDate }} || {{ $formattedTime }}</h6>
                            <span id="date">{{ $formattedDate }}, {{ $formattedTime }}</span>

                            {{-- Format the date using Carbon --}}

                        </div>
                    </div>
                @endforeach
                <!-- events item end -->
            </div>
        </div>
    </section>
@endsection
