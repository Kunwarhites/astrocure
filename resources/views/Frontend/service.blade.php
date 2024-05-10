@extends('Frontend.Layouts.app')
@section('title', 'Service')

@section('content')

    <section id="title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " id="account-title">
                    <h1 id="account-detal-head">Services</h1>
                    <div class="sub-title-detail">
                        <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp; Services
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
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
                                    <a href="{{ route('servicedetail', $service->id)}}" class="service-read">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


{{-- Testimonial start here --}}
    <section class="as_customer_wrapper as_padderBottom80 as_padderTop80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="as_heading as_heading_center">What Our Customers Say</h1>
                    <p class="as_font14 as_margin0 as_padderBottom50">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore <br>etesde dolore magna aliquapspendisse and the gravida.</p>

                    <div class="row as_customer_slider">
                        @foreach ($testimonials as $index => $item)
                        <div class="col-lg-6 col-md-6">
                            <div class="as_customer_box text-center">
                                <span class="as_customer_img">
                                    @if ($item->image)
                                            <img style="border-radius: 50%; height:100px;width:100px;" src="/images/Feedbacks_Userimage/{{ $item->image }}" >
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
    </section>

@endsection
