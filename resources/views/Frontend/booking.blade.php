@extends('Frontend.Layouts.app')
@section('title', 'Book')

@section('content')
<section id="title-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " id="account-title">
                <h1 id="account-detal-head">Appointment</h1>
                <div class="sub-title-detail">
                    <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp;Appointment
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 border bg-light p-4 shadow">
                <div class="col-12">
                    <h3 class="fw-normal text-dark fs-4 text-uppercase mb-4 ">Appointment form</h3>
                </div>
                <form action="{{ route('paypal')}}" id="appointment_form" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="col-md-6">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6">
                            <input type="date" name="date" class="form-control" placeholder="Enter Date">
                        </div>
                        <div class="col-md-6">
                            <input type="time" name="time" class="form-control">
                        </div>
                        <div class="col-12">
                            <select class="form-select" name="service">
                                <option selected disabled>--Select Service--</option>
                                <option >Purpose Of Appointment</option>
                                <option value="1">Web Design</option>
                                <option value="2">Web Development</option>
                                <option value="3">IOS Developemt</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3 text-end">
                            <label for="amount" class="form-label text-dark">Amount:</label>
                            <input type="text" id="amount" name="price" class="text-end form-control text-dark mb-2" placeholder="Enter amount"
                                value="5" disabled style="border:none;background-color:transparent;user-select:none; padding:0;">
                                <input type="hidden" name="product_quantity" value="1">
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn float-end" style=" background-color: #ff7010; color: #fff;font-weight: 700;">Pay with PayPal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/@paypal/paypal-js@7.1.1/dist/iife/paypal-js.min.js"></script>
{{-- <script>
$(document).ready(function(){
    $("#appointment_form").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '{{ url('bookstore')}}',  // Replace with the correct URL
            type: 'POST',
            data: formData,
            success: function(res){
                console.log(res);
            },
            error: function(error){
                console.error(error);
            }
        });
    });
}); --}}


</script>
<script>
    window.paypalLoadScript({
        clientId: "AVr3VDpQIbIuiLpdjPM7ylwpYBl25ieaI_emjpT9CobMUs-NqPXEnuahMGiyCZzmGA9sNlNwyeXFODAG"
    }).then((paypal) => {
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: document.getElementById('amount').value
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Handle successful payment
                    alert('Transaction completed by ' + details.payer.name.given_name);
                });
            }
        }).render("#paypal-buttons");
    });
</script>

@endsection
