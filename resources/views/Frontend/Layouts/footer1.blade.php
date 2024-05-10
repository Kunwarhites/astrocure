
<!-- Remove the container if you want to extend the Footer to full width. -->

    <!-- Footer -->
    <footer
            class="text-center text-lg-start text-white"
            style="background-color: #07273c; border-top:2px solid #ff7010;"
            >
      <!-- Grid container -->
      <div class="container p-4 pb-0">
        <!-- Section: Links -->
        <section class="">
          <!--Grid row-->
          <div class="row">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
              <h6 class="text-uppercase mb-4 font-weight-bold">
               <img src="{{ url('extra/images/logo.svg')}}" alt="">
              </h6>
              <p>
                "At Astrocure, we believe in the transformative power of astrology to enhance your well-being and bring positive change into your life. Our mission is to guide you on a cosmic journey, where the wisdom of the stars meets the art of healing.
              </p>
            </div>
            <!-- Grid column -->

            <hr class="w-100 clearfix d-md-none" />

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3" id="first-col">
                <h6 class="text-uppercase mb-4 font-weight-bold">
                    Quick links
                  </h6>
                  <p>
                    <a  href="/" class="text-white text-decoration-none">Home</a>
                  </p>
                  <p>
                    <a href="/aboutus" class="text-white  text-decoration-none">About us</a>
                  </p>
                  <p>
                    <a href="{{ route('Frontend.register') }}" class="text-white text-decoration-none">Registration</a>
                  </p>
                  <p>
                    <a  href="{{ route('Frontend.login') }}" class="text-white text-decoration-none">Login</a>
                  </p>
            </div>
            <!-- Grid column -->

            <hr class="w-100 clearfix d-md-none" />

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 ">
              <h6 class="text-uppercase mb-4 font-weight-bold">
                <!-- Quick links -->
              </h6>
              <p>
                <a  href="{{ route('appointments') }}" class="text-white text-decoration-none">Appointments</a>
              </p>
              <p>
                <a  class="text-white text-decoration-none">Privacy Policy</a>
              </p>
              <p>
                <a class="text-white text-decoration-none">Terms and Conditions</a>
              </p>
            </div>

            <!-- Grid column -->
            <hr class="w-100 clearfix d-md-none" />

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
              <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
              <p><i class="fas fa-home mr-3"></i> Office No 3, 3rd Floor, Ishwari Dayal Complex, Latouche Road,
                Lucknow, Uttar Pradesh, India - 226018</p>
              <p><i class="fas fa-envelope mr-3"></i> info@astrocure.com</p>
              <p><i class="fas fa-phone mr-3"></i> +91-8869999951 </p>
              <p><i class="fas fa-print mr-3"></i> +91-8423937777</p>
            </div>
            <!-- Grid column -->
          </div>
          <!--Grid row-->
        </section>
        <!-- Section: Links -->

        <hr class="my-3">

        <!-- Section: Copyright -->
        <section class="p-3 pt-0">
          <div class="row d-flex align-items-center">
            <!-- Grid column -->
            <div class="col-md-7 col-lg-8 text-center text-md-start">
              <!-- Copyright -->
              <div class="p-3">
                © 2023 Copyright:
                <a class="text-white text-decoration-none" href="#">astrotalk.com</a
                  >
              </div>
              <!-- Copyright -->
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
              <!-- Facebook -->
              <a
                 class="btn btn-outline-light btn-floating m-1"
                 class="text-white"
                 role="button"
                 ><i class="fab fa-facebook-f"></i
                ></a>

              <!-- Twitter -->
              <a
                 class="btn btn-outline-light btn-floating m-1"
                 class="text-white"
                 role="button"
                 ><i class="fab fa-twitter"></i
                ></a>

              <!-- Google -->
              <a
                 class="btn btn-outline-light btn-floating m-1"
                 class="text-white"
                 role="button"
                 ><i class="fab fa-google"></i
                ></a>

              <!-- Instagram -->
              <a
                 class="btn btn-outline-light btn-floating m-1"
                 class="text-white"
                 role="button"
                 ><i class="fab fa-instagram"></i
                ></a>
            </div>
            <!-- Grid column -->
          </div>
        </section>
        <!-- Section: Copyright -->
      </div>
      <!-- Grid container -->
    </footer>
    <!-- Footer -->

  <!-- End of .container -->
