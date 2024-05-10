@extends('Frontend.Layouts.app')
@section('content')
    <section id="title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " id="account-title">
                    <h1 id="account-detal-head">{{ $event->name }}</h1>
                    <div class="sub-title-detail">
                        <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp; Events &nbsp;&nbsp; >&nbsp;&nbsp;
                        {{ $event->name }}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section id="event-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="bg-event-detail">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="mb-3">{{ $event->name }}</h5>
                            <img src="{{ url('./uploads/event/thumb/large/' . $event->picture) }}" alt=""
                                id="img-singl-event">
                            <div class="container-fluid">
                                <div class="row" id="rowdtl">
                                    <div class="col-md-4 px-3">
                                        <div id="event-dtl">
                                            @php
                                                $formattedDate = \Carbon\Carbon::parse($event->date)->format('F d, Y');
                                                $formattedTime = \Carbon\Carbon::parse($event->time)
                                                    ->setTimezone('Asia/Kolkata')
                                                    ->format('h:i A');

                                            @endphp

                                            <i class="fa-solid fa-calendar" id="event-icon"></i> &nbsp;
                                            Event Date: {{ $formattedDate }}
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-3">
                                        <div id="event-dtl">
                                            <i class="fa-solid fa-clock" id="event-icon"></i> &nbsp;
                                            Event Time: {{ $formattedTime }}
                                        </div>

                                    </div>
                                    <div class="col-md-4 px-3">
                                        <div id="event-dtl">
                                            <i class="fa-solid fa-location-dot" id="event-icon"></i> &nbsp;
                                            Event Location: {{ $event->location }}
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 mb-3" id="data-col">
                                        <p>{!! $event->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-3">Event Location:</h5>
                            <div class="seat-box">
                                {{ $event->location }}
                            </div>
                            {{-- <h6 class="fw-bold mb-3">
                                <i class="fa-solid fa-bars" style="color:#ff7010"></i> &nbsp; By: <span
                                    style="color:#ff7010">David Parker, Emma Doe</span>
                            </h6> --}}
                            {{-- <div class="address">
                                <ul>
                                    <li>Seattle</li>
                                    <li>East Madison Street</li>
                                    <li>Albany</li>
                                    <li>New York</li>
                                    <li>USA</li>
                                </ul>
                            </div> --}}
                            <div class="event-schedule">
                                <div class="d-flex mb-2">
                                    <i class="fa-solid fa-calendar "></i>&nbsp;&nbsp; <h6>Event Schedule Details</h6>
                                </div>
                                @foreach ($recentevent as $item)
                                    @php
                                        $formattedDate = \Carbon\Carbon::parse($item->date)->format('F d, Y');
                                        $formattedTime = \Carbon\Carbon::parse($item->time)
                                            ->setTimezone('Asia/Kolkata')
                                            ->format('h:i A');

                                    @endphp
                                    <div class="event-dates" onclick="window.location.href = '{{$item->name}}';">
                                        <i class="fa-solid fa-calendar" id="event-icon"></i> &nbsp;
                                        <p>{{$item->name}} - {{$formattedDate}}, {{ $formattedTime}}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="shareeevent text-center">
                                <h5 class="mb-3">Book This Event</h5>
                                <div class="icon ">
                                    <p>Rate :- ₹ {{$event->rate}} / Person</p>
                                    <button class="btn text-white" style="background-color: #ff7010;">Book Now</button>
                                </div>
                            </div>
                            <div class="shareeevent text-center">
                                <h5 class="mb-3">Share This Event</h5>
                                <div class="icon d-flex justify-content-around">
                                    <i class="fa-brands fa-facebook-f" id="share-icon"></i>
                                    <i class="fa-brands fa-twitter" id="share-icon"></i>
                                    <i class="fa-brands fa-linkedin-in" id="share-icon"></i>
                                    <i class="fa-brands fa-whatsapp" id="share-icon"></i>
                                    <i class="fa-solid fa-envelope" id="share-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
