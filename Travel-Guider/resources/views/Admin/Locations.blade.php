<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Locations</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('Admin.libraries')

</head>

<body>

    @include('Admin.header')

    @include('Admin.navbar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Locations</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-12 col-md-12">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">All Locations</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="container mt-4">
                                            <div id="map" style="height: 800px;"></div>
                                        </div>

                                        <script>
                                            var locations = @json($locations);
                                        </script>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->




                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->


                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: {
                    lat: 7.8731,
                    lng: 80.7718
                }, 
                disableDefaultUI: true, 
                styles: [
                    {
                        featureType: 'all',
                        elementType: 'labels',
                        stylers: [{
                            visibility: 'off'
                        }]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [{
                            visibility: 'off'
                        }]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'labels',
                        stylers: [{
                            visibility: 'off'
                        }]
                    },
                    {
                        featureType: 'administrative',
                        elementType: 'labels',
                        stylers: [{
                            visibility: 'off'
                        }]
                    },
                    {
                        featureType: 'landscape',
                        elementType: 'geometry',
                        stylers: [{
                            visibility: 'off'
                        }]
                    },
                ]
            });

            locations.forEach(function(location) {
                var latLng = new google.maps.LatLng(location.latitude, location.longitude);
                var iconUrl = '/storage/' + location.icon;
                var iconSize = new google.maps.Size(40, 40);
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    icon: {
                        url: iconUrl,
                        scaledSize: iconSize
                    }
                });

               
                marker.addListener('click', function() {
                    var confirmDelete = confirm('Do you want to delete this location?');
                    if (confirmDelete) {
                        // Make an AJAX request to delete the location
                        fetch(`/locations/${location.id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                marker.setMap(null);
                                alert('Location deleted successfully!');
                            } else {
                                alert('Failed to delete location.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        });
                    }
                });
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    
                    var liveLocationLabel = {
                        text: 'Me', 
                        color: '#FFFFFF', 
                        fontSize: '14px', 
                        fontWeight: 'bold', 
                    };
                   
                    var liveLocationIcon = {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 10, 
                        fillColor: '#4285F4', 
                        fillOpacity: 1,
                        strokeWeight: 2, 
                        strokeColor: '#FFFFFF', 
                    };
                    var liveLocationMarker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        label: liveLocationLabel,
                        icon: liveLocationIcon,
                    });
                    map.setCenter(pos);
                }, function() {
                    handleLocationError(true, map.getCenter());
                });
            } else {
                handleLocationError(false, map.getCenter());
            }

        }

        function handleLocationError(browserHasGeolocation, pos) {
            console.error(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        }
    </script>

    @component('components.google-maps-script')
    @endcomponent

    @include('Admin.Footer')

</body>

</html>
