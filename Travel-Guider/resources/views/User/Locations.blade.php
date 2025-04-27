<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Our Locations</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('Admin.libraries')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum/build/pannellum.css" />
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
                <div class="col-lg-12">
                    <div class="row">
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
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                </div>
            </div>
        </section>
    </main>

    <div id="panorama"
        style="display: none; width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: 1000;"></div>
    <button id="exit-fullscreen" style="display: none; position: absolute; top: 10px; right: 10px; z-index: 1001;">Exit
        Fullscreen</button>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: {
                    lat: 7.8731,
                    lng: 80.7718
                },
                disableDefaultUI: true,
                styles: [{
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

                google.maps.event.addListener(marker, 'click', function() {
                    var panorama = document.getElementById('panorama');
                    var exitButton = document.getElementById('exit-fullscreen');
                    panorama.style.display = 'block';
                    exitButton.style.display = 'block';
                    pannellum.viewer('panorama', {
                        "type": "equirectangular",
                        "panorama": `/storage/${location.picture}`,
                        "autoLoad": true
                    });
                    if (panorama.requestFullscreen) {
                        panorama.requestFullscreen();
                    } else if (panorama.mozRequestFullScreen) {
                        panorama.mozRequestFullScreen();
                    } else if (panorama.webkitRequestFullscreen) {
                        panorama.webkitRequestFullscreen();
                    } else if (panorama.msRequestFullscreen) {
                        panorama.msRequestFullscreen();
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
                        fontWeight: 'bold'
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

            document.getElementById('exit-fullscreen').addEventListener('click', function() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
                document.getElementById('panorama').style.display = 'none';
                document.getElementById('exit-fullscreen').style.display = 'none';
            });

            document.addEventListener('fullscreenchange', exitHandler);
            document.addEventListener('webkitfullscreenchange', exitHandler);
            document.addEventListener('mozfullscreenchange', exitHandler);
            document.addEventListener('MSFullscreenChange', exitHandler);

            function exitHandler() {
                if (!document.fullscreenElement && !document.webkitIsFullScreen && !document.mozFullScreen && !document
                    .msFullscreenElement) {
                    document.getElementById('panorama').style.display = 'none';
                    document.getElementById('exit-fullscreen').style.display = 'none';
                }
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pannellum/build/pannellum.js"></script>

    @include('Admin.Footer')
</body>

</html>
