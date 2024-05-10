@extends('Frontend.Layouts.app')
@section('title', 'Contact Us')

@section('content')

<section id="title-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " id="account-title">
                <h1 id="account-detal-head">Contact</h1>
                <div class="sub-title-detail">
                    <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp;Contact
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section id="contact">
    <div class="container">
        <h2>Contact</h2>
        <hr>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Error quam pariatur nesciunt soluta quis, reprehenderit atque ut, debitis,
            libero magnam voluptatum perspiciatis dolore nam quaerat consequatur maxime obcaecati praesentium.
             Laudantium?</p>
    </div>
    <div class="container-fluid">
        <iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d3559.999222764847!2d80.9224353244899!3d26.8399770266906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d26.8400313!2d80.92486339999999!4m5!1s0x399bfdb11e45c07d%3A0x4c7f4d57785db2c7!2sComplete%20Cure%20Healing%20and%20Meditation%20institute%2C%20Latouche%20Road%2C%20Nawaiya%2C%20Naka%20Hindola%2C%20Lucknow%2C%20Uttar%20Pradesh!3m2!1d26.8398771!2d80.9247584!5e0!3m2!1sen!2sin!4v1695469432676!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-2">
                                <i class="fa fa-location" id="icon"></i>
                            </div>
                            <div class="col-md-10">
                                <h3>Location :</h3>
                                <p>Office No 3, 3rd Floor, Ishwari Dayal Complex, Latouche Road,
                                    Lucknow, Uttar Pradesh, India - 226018</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <i class="fas fa-envelope-square" id="icon"></i>
                    </div>
                    <div class="col-md-10">
                        <h3>Email :</h3>
                        <p>abcd@gmail.com</p>
                    </div>
                    <div class="col-md-2">
                        <i class="fas fa-phone-volume" id="icon"></i>
                    </div>
                    <div class="col-md-10">
                        <h3>Call :</h3>
                        <p>2255884466</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div id="show_success_alert"></div>
               <form action="" method="post" id="contact_form">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" placeholder="Enter your Name" name="name" id="name" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="email" placeholder="Enter your Email" name="email" id="email" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" placeholder="Subject" name="subject" id="subject" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="tel" id="phone" placeholder="Enter Your Mobile No" name="phone" class="form-control" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[6-9][0-9]{9}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <textarea name="message" class="form-control" id="message" cols="30" placeholder="Enter your Message here..."></textarea>
                    </div>
                    <div class="invalid-feedback"></div>
                    <div class="col-md-12 text-center">
                            <button class="btn login" id="contact_btn" >Submit</button>
                    </div>
                </div>
               </form>
            </div>
        </div>

    </div>
</section>

{{-- Handle form with ajax request --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $(document).ready(function() {
            $("#contact_form").submit(function(e){
                e.preventDefault();

                var submitButton = $("#contact_btn"); // Define submitButton within this scope
                submitButton.val('Please wait.....');
                $.ajax({
                    url:'{{ route('Frontend.contactpost')}}',
                    method:'POST',
                    data:$(this).serialize(),
                    // dataType:'json',
                    success:function(res){
                        if (res.status == 400) {
                            showError('name', res.message.name);
                            showError('email', res.message.email);
                            showError('phone', res.message.phone);
                            showError('subject', res.message.subject);
                            showError('message', res.message.message);
                            submitButton.html(
                                "Submit"); // Restore original submit button text
                        } else if (res.status == 200) {
                            $("#show_success_alert").html(showMessage('success', res.message));
                            $("#contact_form")[0].reset();
                            removeValidationClasses(form);
                            submitButton.html(
                                "Submit"); // Restore original submit button text
                        }
                    }
                });
            });
        });
    </script>


@endsection
