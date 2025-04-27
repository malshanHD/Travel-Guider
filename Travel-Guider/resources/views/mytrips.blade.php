<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('Admin.libraries')

</head>

<body>


    @include('User.header')

    @include('User.navbar')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Locations</h1>
        </div>

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-12 col-md-12">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">All Planned Trips></h5>

                                    <div class="container">
                                        <div class="row text-center">
                                            @foreach ($trips as $trip)
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-header fw-bold text-uppercase">
                                                            {{ $trip->trip_name }}
                                                            <p style="font-size: 70%;">{{ $trip->travelling_date }}</p>
                                                        </div>
                                                        <div class="card-body">
                                                            <img src="{{ asset('assets/img/vector-a-travel-icon-elements.jpg') }}"
                                                                alt="" width="100%">
                                                        </div>
                                                        <div class="card-footer">

                                                            <div class="d-grid gap-2">
                                                                <button class="btn btn-primary handle-trip-btn fw-bold"
                                                                    data-trip-id="{{ $trip->id }}">
                                                                    VIEW
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->


                </div><!-- End Right side columns -->

            </div>
        </section>


    </main>

    @include('Admin.Footer')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener for clicking on "Handle Trip" button
            document.querySelectorAll('.handle-trip-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    // Check if geolocation is supported
                    if ('geolocation' in navigator) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var userLatitude = position.coords.latitude.toFixed(
                                6); // Example formatting to 6 decimal places
                            var userLongitude = position.coords.longitude.toFixed(
                                6); // Example formatting to 6 decimal places

                            // Get trip ID from data attribute
                            var tripId = btn.getAttribute('data-trip-id');

                            // Redirect to handle-trip route with trip ID, latitude, and longitude
                            window.location.href = '/handle-trip/' + tripId +
                                '?latitude=' + userLatitude +
                                '&longitude=' + userLongitude;
                        }, function(error) {
                            console.error('Error getting user location:', error);
                            alert('Unable to retrieve your location.');
                        });
                    } else {
                        alert('Geolocation is not supported in your browser.');
                    }
                });
            });
        });
    </script>

</body>

</html>
