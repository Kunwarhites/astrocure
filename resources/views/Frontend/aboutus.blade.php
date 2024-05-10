@extends('Frontend.Layouts.app')
@section('title', 'About Us')

@section('content')

    {{-- <section id="know-about">
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
                    <p class="text-white" id="para-know">It is a long established fact that a reader will be distracted by
                        the readable content of a page
                        when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                        distribution of letters, as opposed to using 'Content here, content here', making it look like
                        readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as
                        their default model text, and a search for 'lorem ipsum' will uncover many web sites still in
                        their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on
                        purpose (injected humour and the like).</p>
                    <a href="#" class="read-more btn" id="rm"> READ MORE</a>
                    <div class="contact">
                        <h5 class="text-white" id="cont-head">Contact Our Expert Astrologers</h5>
                        <div class="con-icon">
                            <i class="fa fa-volume-control-phone text-white" id="contact-icon-know"></i>
                        </div>
                        <a href="" class="head-con"><span>+ (91) 1800-124-105</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="as_about_wrapper as_padderTop80 as_padderBottom80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="as_about_slider">
                        <div>
                            <div class="as_aboutimg text-right">
                                <img src="{{ url('extra/images/about1.jpg')}}" alt="" class="img-responsive">
                            </div> 
                        </div>
                        <div>
                            <div class="as_aboutimg text-right">
                                <img src="{{ url('extra/images/about2.jpg')}}" alt="" class="img-responsive">
                            </div> 
                        </div>
                        <div>
                            <div class="as_aboutimg text-right">
                                <img src="{{ url('extra/images/about3.jpg')}}" alt="" class="img-responsive">
                            </div> 
                        </div>
                        <div>
                            <div class="as_aboutimg text-right">
                                <img src="{{ url('extra/images/about4.jpg')}}" alt="" class="img-responsive">
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
                        together. Join us in this cosmic journey, where the wisdom of the stars meets the art of healing.</p>
                    
                    <a href="javascript:;" class="as_btn">read more</a>

                    <div class="as_contact_expert">
                        <span class="as_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="20" height="20" viewBox="0 0 20 20"> <defs><style>.cls-1{fill:#fff;fill-rule:evenodd}</style></defs> <path d="M19.797,10.487 C19.668,10.616 19.493,10.689 19.310,10.689 C18.929,10.689 18.620,10.380 18.620,9.999 C18.615,5.241 14.759,1.385 10.000,1.379 C9.619,1.379 9.310,1.070 9.310,0.689 C9.310,0.308 9.619,-0.000 10.000,-0.000 C15.520,0.006 19.993,4.478 19.999,9.999 C19.999,10.183 19.927,10.358 19.797,10.487 ZM15.172,9.999 C15.169,7.144 12.855,4.830 10.000,4.827 C9.619,4.827 9.310,4.518 9.310,4.138 C9.310,3.757 9.619,3.448 10.000,3.448 C13.617,3.452 16.547,6.383 16.551,9.999 C16.551,10.380 16.243,10.689 15.862,10.689 C15.481,10.689 15.172,10.380 15.172,9.999 ZM12.864,14.155 C13.076,14.182 13.288,14.109 13.438,13.957 L14.982,12.413 C15.209,12.186 15.563,12.146 15.835,12.317 L19.655,14.775 C19.955,14.965 20.063,15.350 19.905,15.668 L18.045,19.616 C17.918,19.873 17.645,20.024 17.360,19.995 C15.394,19.789 10.563,18.932 5.815,14.183 C1.067,9.435 0.210,4.604 0.003,2.638 C-0.026,2.352 0.125,2.079 0.382,1.952 L4.331,0.093 C4.649,-0.067 5.036,0.043 5.224,0.344 L7.684,4.164 C7.854,4.436 7.814,4.790 7.586,5.017 L6.042,6.560 C5.890,6.711 5.818,6.924 5.845,7.135 C5.942,7.900 6.373,9.809 8.282,11.718 C10.191,13.627 12.099,14.057 12.864,14.155 Z" class="cls-1"/> </svg>
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


    <!--##################### why choose us start here #################-->
    <section id="choose-us">
        <div class="container  text-white">
            <div class="row">
                <div class="col-md-5" id="left-col-why">
                    <h1 id="hwad">Why Choose Us</h1>
                    <br>
                    <p>It is a long established fact that a reader will be distracted when looking at its layout. </p>
                </div>
                <div class="col-md-7">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 col-md-4 text-center">
                                <span class="count">
                                    <span class="count-no" data-count="512">0</span>
                                    <img src="{{ url('img/count/count-icon.png') }}" alt="counter" style="width:130px;height:130px;">
                                </span>
                                <h5 class="mt-3">Qualified Astrologers</h5>
                            </div>
                            <div class="col-6 col-md-4 text-center">
                                <span class="count ">
                                    <span class="count-no" data-count="512">0</span>
                                    <img src="{{ url('img/count/count-icon.png') }}" alt="counter" style="width:130px;height:130px;">
                                </span>
                                <h5 class="mt-3">Success Horoscope</h5>
                            </div>
                            <div class="col-6 col-md-4 text-center">
                                <span class="count ">
                                    <span class="count-no" data-count="512">0</span>
                                    <img src="{{ url('img/count/count-icon.png') }}" alt="counter" style="width:130px;height:130px;">
                                </span>
                                <h5 class="mt-3">Offices Worldwide</h5>
                            </div>
                            <div class="col-6 col-md-4 text-center">
                                <span class="count ">
                                    <span class="count-no" data-count="512">0</span>
                                    <img src="{{ url('img/count/count-icon.png') }}" alt="counter" style="width:130px;height:130px;">
                                </span>
                                <h5 class="mt-3">Trust By Million Clients</h5>
                            </div>
                            <div class="col-6 col-md-4 text-center">
                                <span class="count ">
                                    <span class="count-no" data-count="512">0</span>
                                    <img src="{{ url('img/count/count-icon.png') }}" alt="counter" style="width:130px;height:130px;">
                                </span>
                                <h5 class="mt-3">Year's Experience</h5>
                            </div>
                            <div class="col-6 col-md-4 text-center">
                                <span class="count ">
                                    <span class="count-no" data-count="512">0</span>
                                    <img src="{{ url('img/count/count-icon.png') }}" alt="counter" style="width:130px;height:130px;">
                                </span>
                                <h5 class="mt-3">Type Of Horoscopes</h5>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--##################### why choose us end here #################-->
    <script>
        // Get all elements with the class "count-no"
        const countSpans = document.querySelectorAll(".count-no");

        countSpans.forEach((countSpan) => {
            const targetCount = parseInt(countSpan.getAttribute("data-count"), 10);
            let currentCount = 0;

            // Define the incrementCount function for each element
            const incrementCount = () => {
                if (currentCount < targetCount) {
                    currentCount += 1;
                    countSpan.textContent = currentCount + " +"; // Add the plus sign here
                    setTimeout(incrementCount, 10); // Recursive call to continue the animation
                }
            };

            // Start the counting animation for each element when the page loads
            window.addEventListener("load", () => {
                incrementCount();
            });
        });
    </script>


@endsection
