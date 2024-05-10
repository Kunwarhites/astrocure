@extends('Frontend.Layouts.app')
@section('title', 'AstroTalk')

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jssor-slider/28.0.0/jssor.slider.min.js"
        integrity="sha512-hIV4+MQS3ysAwIMfFP0KMFJXp72W2/+gF595ZWxDjEQFh7UHQ4bq2lAwum2kkr2E36lZvax+Y8tuAQez2Lga7w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
@section('content')
    {{-- =========================== Main Banner Start Here ======================================== --}}
    {{-- <section id="main-banner">
        <div class="container">
            <div class="row" id="rowmain">

                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="main-left">
                        <h4 id="oragn" data-aos="fade-up" data-aos-delay="200">What's Your Sign ?</h4>
                        <h2 class="text-white" id="rydht" data-aos="fade-up" data-aos-delay="300">Read Your Daily
                            Horoscope Today</h2>
                        <p class="text-white" data-aos="fade-up" data-aos-delay="400">Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Ullam quidem alias repellat cupiditate animi, tenetur, provident nihil , nihil
                            commodi odio aliquam.</p>
                        <a href="javascript:;" data-aos="fade-up" data-aos-delay="500" class="as_btn">read more</a>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="{{ url('img/banner/banner2.png') }}" alt="" id="main-style">
                </div>
            </div>
        </div>
    </section> --}}
    <section>
        <div id="carouseldesktop" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($banners as $key => $item)
                    <button type="button" data-bs-target="#carouseldesktop" data-bs-slide-to="{{ $key }}"
                        @if ($key == 0) class="active" @endif></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach ($banners as $key => $item)
                    <div class="carousel-item @if ($key == 0) active @endif" data-bs-interval="10000">
                        <img src="{{ url('uploads/banners/desktop/' . $item->image_desktop) }}" class="d-block w-100"
                            alt="...">
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouseldesktop" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouseldesktop" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div id="carouselphone" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($banners as $key => $item)
                    <button type="button" data-bs-target="#carouselphone" data-bs-slide-to="{{ $key }}"
                        @if ($key == 0) class="active" @endif></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach ($banners as $key => $item)
                    <div class="carousel-item @if ($key == 0) active @endif" data-bs-interval="2000">
                        <img src="{{ url('uploads/banners/phone/' . $item->image_phone) }}" class="d-block w-100"
                            alt="...">
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselphone" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" style="color: #ff7010;" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselphone" data-bs-slide="next">
                <span class="carousel-control-next-icon" style="color: #ff7010;" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    {{-- =========================== Know About Start Here ======================================== --}}

    <section id="know-about">
        <div class="container" id="contane-id">
            <div class="row">
                <div class="col-md-6">
                    <div class="cardss">
                        <div class="owl-carousel owl-theme">
                            <div class="item"><img src="{{ url('img/carousel/1.jpg') }}" alt=""></div>
                            <div class="item"><img src="{{ url('img/carousel/2.jpg') }}" alt=""></div>
                            <div class="item"><img src="{{ url('img/carousel/3.jpg') }}" alt=""></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="contac-right">
                    <h2 class="text-white" id="head-know">Know About</h2>
                    <p class="text-white" id="para-know">Astrocure is a holistic website dedicated to exploring the profound
                        connection between astrology and well-being. Our platform offers a rich array of content designed to
                        empower and guide you on your journey to improved physical, emotional, and spiritual health. From
                        daily horoscopes that provide personalized insights into your life, to in-depth astrology articles
                        that unravel the mysteries of the cosmos, we are your cosmic companion on a quest for self-discovery
                        and healing. We offer astrology services, such as birth chart readings and compatibility reports,
                        allowing you to gain deeper insights into your unique path. Dive into our wellness section for
                        practical tips on mindfulness, meditation, yoga, and crystal healing. Discover how celestial
                        influences can impact your overall wellness, both mentally and physically. Explore upcoming
                        astrological events, and understand their potential effects on your life. Astrocure is not just a
                        website; it's a community where like-minded individuals can connect, share experiences, and grow
                        together. Join us in this cosmic journey, where the wisdom of the stars meets the art of healing.
                    </p>
                    <a href="javascript:;" class="as_btn">read more</a>

                    <div class="as_contact_expert">
                        <span class="as_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                preserveAspectRatio="xMidYMid" width="20" height="20" viewBox="0 0 20 20">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: #fff;
                                            fill-rule: evenodd
                                        }
                                    </style>
                                </defs>
                                <path
                                    d="M19.797,10.487 C19.668,10.616 19.493,10.689 19.310,10.689 C18.929,10.689 18.620,10.380 18.620,9.999 C18.615,5.241 14.759,1.385 10.000,1.379 C9.619,1.379 9.310,1.070 9.310,0.689 C9.310,0.308 9.619,-0.000 10.000,-0.000 C15.520,0.006 19.993,4.478 19.999,9.999 C19.999,10.183 19.927,10.358 19.797,10.487 ZM15.172,9.999 C15.169,7.144 12.855,4.830 10.000,4.827 C9.619,4.827 9.310,4.518 9.310,4.138 C9.310,3.757 9.619,3.448 10.000,3.448 C13.617,3.452 16.547,6.383 16.551,9.999 C16.551,10.380 16.243,10.689 15.862,10.689 C15.481,10.689 15.172,10.380 15.172,9.999 ZM12.864,14.155 C13.076,14.182 13.288,14.109 13.438,13.957 L14.982,12.413 C15.209,12.186 15.563,12.146 15.835,12.317 L19.655,14.775 C19.955,14.965 20.063,15.350 19.905,15.668 L18.045,19.616 C17.918,19.873 17.645,20.024 17.360,19.995 C15.394,19.789 10.563,18.932 5.815,14.183 C1.067,9.435 0.210,4.604 0.003,2.638 C-0.026,2.352 0.125,2.079 0.382,1.952 L4.331,0.093 C4.649,-0.067 5.036,0.043 5.224,0.344 L7.684,4.164 C7.854,4.436 7.814,4.790 7.586,5.017 L6.042,6.560 C5.890,6.711 5.818,6.924 5.845,7.135 C5.942,7.900 6.373,9.809 8.282,11.718 C10.191,13.627 12.099,14.057 12.864,14.155 Z"
                                    class="cls-1" />
                            </svg>
                        </span>
                        <div>
                            <h5 class="as_white">Contact Our Expert Astrologers</h5>
                            <h1 class="as_orange">+ (91) 1800-124-105</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="as_about_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="as_about_slider">
                        <div>
                            <div class="as_aboutimg text-right">
                                <img src="{{ url('extra/images/about1.jpg') }}" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div>
                            <div class="as_aboutimg text-right">
                                <img src="{{ url('extra/images/about2.jpg') }}" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div>
                            <div class="as_aboutimg text-right">
                                <img src="{{ url('extra/images/about3.jpg') }}" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div>
                            <div class="as_aboutimg text-right">
                                <img src="{{ url('extra/images/about4.jpg') }}" alt="" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <h1 class="as_heading">know about Astrology</h1>
                    <p>Astrocure is a holistic website dedicated to exploring the profound
                        connection between astrology and well-being. Our platform offers a rich array of content designed to
                        empower and guide you on your journey to improved physical, emotional, and spiritual health. From
                        daily horoscopes that provide personalized insights into your life, to in-depth astrology articles
                        that unravel the mysteries of the cosmos, we are your cosmic companion on a quest for self-discovery
                        and healing. We offer astrology services, such as birth chart readings and compatibility reports,
                        allowing you to gain deeper insights into your unique path. Dive into our wellness section for
                        practical tips on mindfulness, meditation, yoga, and crystal healing. Discover how celestial
                        influences can impact your overall wellness, both mentally and physically. Explore upcoming
                        astrological events, and understand their potential effects on your life. Astrocure is not just a
                        website; it's a community where like-minded individuals can connect, share experiences, and grow
                        together. Join us in this cosmic journey, where the wisdom of the stars meets the art of healing.
                    </p>

                    <a href="javascript:;" class="as_btn">read more</a>

                    <div class="as_contact_expert">
                        <span class="as_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                preserveAspectRatio="xMidYMid" width="20" height="20" viewBox="0 0 20 20">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: #fff;
                                            fill-rule: evenodd
                                        }
                                    </style>
                                </defs>
                                <path
                                    d="M19.797,10.487 C19.668,10.616 19.493,10.689 19.310,10.689 C18.929,10.689 18.620,10.380 18.620,9.999 C18.615,5.241 14.759,1.385 10.000,1.379 C9.619,1.379 9.310,1.070 9.310,0.689 C9.310,0.308 9.619,-0.000 10.000,-0.000 C15.520,0.006 19.993,4.478 19.999,9.999 C19.999,10.183 19.927,10.358 19.797,10.487 ZM15.172,9.999 C15.169,7.144 12.855,4.830 10.000,4.827 C9.619,4.827 9.310,4.518 9.310,4.138 C9.310,3.757 9.619,3.448 10.000,3.448 C13.617,3.452 16.547,6.383 16.551,9.999 C16.551,10.380 16.243,10.689 15.862,10.689 C15.481,10.689 15.172,10.380 15.172,9.999 ZM12.864,14.155 C13.076,14.182 13.288,14.109 13.438,13.957 L14.982,12.413 C15.209,12.186 15.563,12.146 15.835,12.317 L19.655,14.775 C19.955,14.965 20.063,15.350 19.905,15.668 L18.045,19.616 C17.918,19.873 17.645,20.024 17.360,19.995 C15.394,19.789 10.563,18.932 5.815,14.183 C1.067,9.435 0.210,4.604 0.003,2.638 C-0.026,2.352 0.125,2.079 0.382,1.952 L4.331,0.093 C4.649,-0.067 5.036,0.043 5.224,0.344 L7.684,4.164 C7.854,4.436 7.814,4.790 7.586,5.017 L6.042,6.560 C5.890,6.711 5.818,6.924 5.845,7.135 C5.942,7.900 6.373,9.809 8.282,11.718 C10.191,13.627 12.099,14.057 12.864,14.155 Z"
                                    class="cls-1" />
                            </svg>
                        </span>
                        <div>
                            <h5 class="as_white">Contact Our Expert Astrologers</h5>
                            <h1 class="as_orange">+ (91) 1800-124-105</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- =========================== Service Start Here ======================================== --}}

    <section id="service">
        <div class="container">
            <div class="row">
                <div class="col-md-12  text-center p-2">
                    <h1 class="text-title">Our Services</h1>
                </div>
                <div class="col-md-12 text-center" id="text-adp">
                    <p class="px-lg-5 px-md-5">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore
                        etesde dolore magna aliquapspendisse and the gravida.</p>
                </div>
            </div>
            <div class="row">

                @if (!empty($services))
                    @foreach ($services as $service)
                        <div class="col-md-3 mb-4">
                            <div class="card" id="cardsss">
                                <img class="card-img-top" src="/uploads/services/thumb/small/{{ $service->image }}"
                                    id="service-logo" alt="{{ $service->name }}">
                                <div class="card-body text-center">
                                    <h4 class="service-title">{{ $service->name }}</h4>
                                    <hr id="service-hr">
                                    <p class="card-text">{{ $service->short_description }}</p>
                                    <a href="{{ route('servicedetail', $service->id) }}" class="service-read">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 text-end">
                    <a href="{{ route('serviceview') }}" style="color:#ff7010; text-decoration:none;">Read more</a>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================== Out Team Start Here ======================================== --}}

    <section id="our-team">
        <div class="container">
            <div class="row">
                <div class="col-md-12  text-center p-2">
                    <h1 class="text-title text-white">Our Team</h1>
                </div>
                <div class="col-md-12 text-center" id="text-adp">
                    <p class=" text-white">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore
                        etesde dolore magna aliquapspendisse and the gravida.</p>
                </div>
            </div>
            <div class="row">
                @if (!empty($team))
                    @foreach ($team as $astrologer)
                        <div class="col-md-3 mb-4">
                            <div class="team-card"
                                style="background-image: url('/images/Astrologers_Profile_pic/{{ $astrologer->profile_pic }}');">
                                <div class="page-left-shadow">
                                    <i class="fa-brands fa-twitter"></i>
                                    <i class="fa-brands fa-facebook"></i>
                                    <i class="fa-brands fa-instagram"></i>
                                    <i class="fa-brands fa-yahoo"></i>
                                </div>
                                <div class="page-right-shadow">
                                    <h4>{{ $astrologer->name }}</h4>
                                    <h6 class="mb-3">{{ $astrologer->service }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @elseif (empty($team))
                    <p>No astrologers available.</p>
                @endif
                <div class="col-md-12 text-center mb-3 mt-3">
                    <a href="#" class="team-read">See All</a>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================== Our latest blog Start Here ======================================== --}}

    <section id="our-latest-blog">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-md-12  text-center p-2">
                        <h1 class="text-title text-white">Our Blogs</h1>
                    </div>
                    <div class="col-md-12 text-center" id="text-adp">
                        <p class=" text-white">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore
                            etesde dolore magna aliquapspendisse and the gravida.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-4 mb-4">
                        <div class="blog-card">
                            <img src="{{ url('/uploads/blogs/thumb/smalls/' . $blog->picture) }}" class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <div class="row" id="blog-phon">
                                    <div class="col-md-6 mb-3">
                                        <i class="fa-regular fa-user" style="color: #ff7010;"></i>
                                        <span class="text-white">
                                            By
                                            @if ($blog->by == 1)
                                                Admin
                                            @else
                                                Astrologer
                                            @endif
                                        </span>

                                    </div>
                                    <div class="col-md-6"> <i class="fa-solid fa-stopwatch" style="color: #ff7010;"></i>
                                        <span
                                            class="text-white">{{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}</span>
                                    </div>
                                </div>
                                <h5 class="card-title text-white" id="text-blog">{{ $blog->name }}</h5>
                            </div>
                            <span class="px-3"><a href="/blog-detail/{{ $blog->id }}"
                                    style="color: #ff7010 !important;text-decoration:none;">Read More</a></span>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-center mb-3 mt-3">
                    <a href="{{ route('Front.blogs') }}" class="team-read">See All</a>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================== Our latest Event Start Here ======================================== --}}

    <section class="events" style="padding: 20px !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12  text-center p-2">
                    <h1 class="text-title text-white">Our Events</h1>
                </div>
                <div class="col-md-12 text-center" id="text-adp">
                    <p class=" text-white">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore
                        etesde dolore magna aliquapspendisse and the gravida.</p>
                </div>
            </div>
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
            <div class="row">
                <div class="col-md-12 text-center mb-3 mt-3">
                    <a href="{{ route('Front.event') }}" class="team-read">See All</a>
                </div>
            </div>
        </div>
    </section>
    {{-- Testimonial start here --}}
    {{-- <section class="as_customer_wrapper as_padderBottom80 as_padderTop80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="as_heading as_heading_center">What Our Customers Say</h1>
                    <p class="as_font14 as_margin0 as_padderBottom50">Consectetur adipiscing elit, sed do eiusmod tempor
                        incididuesdeentiut labore <br>etesde dolore magna aliquapspendisse and the gravida.</p>

                    <div class="row as_customer_slider">
                        @foreach ($testimonials as $index => $item)
                            <div class="col-lg-6 col-md-6">
                                <div class="as_customer_box text-center">
                                    <span class="as_customer_img">
                                        @if ($item->image)
                                            <img style="border-radius: 50%; height:100px;width:100px;"
                                                src="/images/Feedbacks_Userimage/{{ $item->image }}">
                                        @else
                                            <img style="border-radius: 50%; height:100px;width:100px;"
                                                src="https://cdn-icons-png.flaticon.com/512/147/147285.png"
                                                class="img-fluid" alt="...">
                                        @endif
                                        <span><img src="extra/images/svg/quote1.svg" alt=""></span>
                                    </span> <br>
                                    <span class="card-title text-warning">
                                        @for ($i = 1; $i <= $item->rating; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                    </span>
                                    <p class="as_margin0">{{ $item->comment }}</p>
                                    <h3 style="color: #ff7010;">{{ $item->name }}</h3>
                                    <p class="as_margin0">{{ $item->email }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section> --}}

@endsection
