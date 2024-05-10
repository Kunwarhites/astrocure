<div id="marginset">
    <header id="astroheader">
        <div class="container-fluid">
            <div class="row ">
                <div class=" al-logo-wrap">
                    <a href="/">
                        <img src="{{ url('extra/images/logo.svg')}}"
                            alt="" id="logo-astro">
                    </a>
                </div>
                <div class=" al-menu-wrap">
                    <div class="row">
                        <div class="astro-right-top">
                            <div class="container p-0">
                                <div class="row p-0">
                                    <div class="col-md-4 text-white" id="supports">
                                        <i class="fa-solid fa-headset " id="al-infoicon"></i> &nbsp;
                                        <span style="color: #ff7010;" id="tta">Talk To Our Astrologer -</span> +
                                        (91) 8869999951
                                    </div>
                                    <div class="col-md-4 text-white" id="supports">
                                        <i class="fa-solid fa-envelope " id="al-infoicon"></i> &nbsp;
                                        <span style="color: #ff7010;" id="tta">Talk To Our Astrologer -</span>
                                        support@gmail.com
                                    </div>
                                    <div class="col-md-4 text-white d-inline-flex justify-content-center align-items-center"
                                        id="unique-lor">
                                        @if (!session()->has('loggedInUser'))
                                            <!-- Guest (not logged in) -->
                                            <i class="fa-solid fa-user-plus " id="loginssss"></i> &nbsp;
                                            <a href="{{ route('Frontend.login') }}"  class="nav-link"
                                                id="nav-login">Login</a>
                                            <a href="{{ route('Frontend.register') }}"  class="nav-link"
                                                id="nav-regis">Register</a>
                                        @else
                                            <!-- User is authenticated (logged in) -->
                                            {{-- <div class="dash"> --}}

                                            @if (session()->has('loggedInUser'))
                                                <img src="{{ url('images/profileUser/' . $userinfo->picture) }}"
                                                    id="image_preview" alt=""
                                                    class="img-fluid rounded-circle img-thumbnail" width="30"
                                                    height="30">
                                                <a href="{{ route('Frontend.Profile.profile') }}" class="nav-link"
                                                    id="dashboardBtn">
                                                    {{ $userinfo->name }}
                                                </a>
                                            @endif
                                            {{-- </div> --}}

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="astro-right-bottom">
                            <ul class="nav" id="navbs">
                                <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                                <li class="nav-item"><a href="/aboutus" class="nav-link">About Us</a></li>
                                <li class="nav-item"><a href="service" class="nav-link">Services</a></li>
                                <li class="nav-item"><a href="{{ route('Front.event')}}" class="nav-link">Events</a></li>
                                <li class="nav-item"><a href="{{ route('Front.blogs')}}"  class="nav-link">Blogs</a></li>
                                {{-- <li class="nav-item"><a href="" wire:navigate class="nav-link">Shop</a></li> --}}
                                <li class="nav-item"><a href="{{ route('appointments') }}"
                                        class="nav-link">Appointment</a></li>
                                        <li class="nav-item">
                                    <a href="" wire:navigate class="nav-link">Pages</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('Front.faq')}}">FAQ</a></li>
                                        
                                        <!-- Add more submenu items as needed -->
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="/contact"  class="nav-link">Contact</a></li>
                            </ul>
                            <i class="fa-solid fa-bars text-white" id="bars-menu" onclick="openNav()"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href=""><i class="fa-solid fa-magnifying-glass" style="color: #ff7010"></i></a>
                            <div id="backgroundBox"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>


{{-- support and call or backtotop --}}

<button id="backToTopBtn" onclick="scrollToTop()"><i class="fa-solid fa-arrow-up"></i></button>
<div id="feedback" onclick="scrollToTops()" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Feedback
</div>
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog " >
        <div class="modal-content" style="background-color: #07273c;color:#fff;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Give Feedback</h1>
                <button type="button"data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-times" style="background-color: #07273c;color:#fff; padding:0;"></i></button>
            </div>
            <div class="modal-body">
                <form  id="feedbackForm" method="POST">
                    @csrf
                    <div class="col-12 mb-2">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            aria-describedby="emailHelp">
                            <div class="invalid-feedback"></div>

                    </div>
                    <div class="col-12 mb-2">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email"
                            aria-describedby="emailHelp">
                            <div class="invalid-feedback"></div>

                    </div>
                    <div class="col-12 mb-2">
                        <label for="" class="form-label">Rating :- </label>
                        <i class="fa fa-star" onclick="setRating(1)"></i>
                        <i class="fa fa-star" onclick="setRating(2)"></i>
                        <i class="fa fa-star" onclick="setRating(3)"></i>
                        <i class="fa fa-star" onclick="setRating(4)"></i>
                        <i class="fa fa-star" onclick="setRating(5)"></i>
                        <input type="hidden" name="rating" id="rating" value="0">
                        <div class="invalid-feedback"></div>

                    </div>
                    <div class="col-12 mb-2">
                        <label for="exampleInputEmail1" class="form-label">Comment</label>
                        <textarea class="form-control" name="comment" id="comment" cols="20" rows="4"></textarea>
                        <div class="invalid-feedback"></div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn" id="feedbbtn" style="background-color: #ff7010;color:#fff;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<script>
    let selectedRating = 0;

    function setRating(rating) {
        selectedRating = rating;

        // Log to the console for debugging
        console.log('Selected Rating:', selectedRating);

        // Highlight the selected stars
        const stars = document.querySelectorAll('.fa-star');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });

        // Update the hidden input field
        document.getElementById('rating').value = rating;

        // Log to the console again for debugging
        console.log('Updated Rating Field:', document.getElementById('rating').value);
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $("#feedbackForm").submit( function(e) {
            e.preventDefault();
            $("#feedbbtn").html('Please wait....');
            var form = $(this);
            $.ajax({
                url:'{{ route('feedback.store') }}',
                method:'POST',
                data:$(this).serialize(),
                success:function(res){
                    if(res.status == 400){
                        showError('name', res.message.name);
                        showError('email', res.message.email);
                        showError('rating', res.message.rating);
                        showError('comment', res.message.comment);
                        $("#feedbbtn").html('Submit');
                    } else if (res.status == 200) {
                        $("#show_success_alert").html(showMessage('success', res.message));
                        form[0].reset();
                            removeValidationClasses(form);
                        $("#feedbbtn").html('Submit');
                        window.location.reload();
                    }
                }
            })
        });
    });
</script>
