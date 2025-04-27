<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Welcome</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('Assets.assets')
</head>

<body>

    <!-- ======= Top Bar ======= -->
    @include('Assets.topbar')
    <!-- End Top Bar-->

    <!-- ======= Header ======= -->
    @include('Assets.header')
    <!-- End Header -->

    <!-- ======= hero Section ======= -->
    @include('Assets.Carousel')
    <!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Section ======= -->
        @include('Assets.about')
        <!-- End About Section -->

        <!-- ======= Services Section ======= -->
        @include('Assets.service')
        <!-- End Services Section -->


        <!-- ======= Contact Section ======= -->
        <section id="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Contact Us</h2>
                </div>

                <div class="row contact-info">

                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <address>Bray brook street Colombo 07</address>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="bi bi-phone"></i>
                            <h3>Phone Number</h3>
                            <p><a href="tel:+94111256521">+94 111 256 521</a></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:info@travelguider.com">info@travelguider.com</a></p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container">
                <div class="form">
                    <form action="feedback" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" required>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>

                        <div class="my-3">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>

                        <div class="text-center"><input type="submit" value="Send Message" class="btn btn-success">
                        </div>
                    </form>
                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('Assets.footer')
    <!-- End Footer -->

    @include('Assets.js')

</body>

</html>
