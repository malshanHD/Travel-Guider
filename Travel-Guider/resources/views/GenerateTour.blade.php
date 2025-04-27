<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trip Navigator</title>
    @include('Assets.assets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .location-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .remove-icon {
            cursor: pointer;
            color: red;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }

        .l-bg-cherry {
            background: linear-gradient(to right, #493240, #f09) !important;
            color: #fff;
        }

        .l-bg-blue-dark {
            background: linear-gradient(to right, #373b44, #4286f4) !important;
            color: #fff;
        }

        .l-bg-green-dark {
            background: linear-gradient(to right, #0a504a, #38ef7d) !important;
            color: #fff;
        }

        .l-bg-orange-dark {
            background: linear-gradient(to right, #a86008, #ffba56) !important;
            color: #fff;
        }

        .card .card-statistic-3 .card-icon-large .fas,
        .card .card-statistic-3 .card-icon-large .far,
        .card .card-statistic-3 .card-icon-large .fab,
        .card .card-statistic-3 .card-icon-large .fal {
            font-size: 110px;
        }

        .card .card-statistic-3 .card-icon {
            text-align: center;
            line-height: 50px;
            margin-left: 15px;
            color: #000;
            position: absolute;
            right: -5px;
            top: 20px;
            opacity: 0.1;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

        .l-bg-green {
            background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
            color: #fff;
        }

        .l-bg-orange {
            background: linear-gradient(to right, #f9900e, #ffba56) !important;
            color: #fff;
        }
    </style>
</head>

<body>
    @include('Assets.topbar')
    @include('Assets.header')

    <main id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card info-card sales-card l-bg-cyan h-100 d-flex flex-column">
                        <div class="card-body">
                            <div class="container mt-4">
                                <div id="map" style="height: 500px;"></div>
                            </div>
                            <script>
                                var locations = @json($locations);
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card info-card sales-card l-bg-cyan h-100 d-flex flex-column">
                        <div class="card-body">
                            <h4 class="fw-bold text-center">Selected Locations</h4>
                            <hr>
                            <ul id="selected-locations-list"></ul>
                            <div class="form-group mt-4">
                                <label for="location-name">Name:</label>
                                <input type="text" id="location-name" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                <label for="location-date">Date:</label>
                                <input type="date" id="location-date" class="form-control">
                            </div>
                            <div class="d-grid gap-2">
                                <button id="save-locations-btn" class="btn btn-success fw-bold mt-3">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Bootstrap Modal for 360 View -->
    <!-- Bootstrap Modal for Google Street View -->
    <div class="modal fade" id="streetViewModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Street View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="streetViewFrame" width="100%" height="500px" frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/streetview?key=AIzaSyCzf_j2zS1bqh4-hAB9WFiJz2Sqcxxu4iw&location=46.414382,10.013988&heading=210&pitch=10&fov=35"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>


    <script>
        let userLatitude = null;
        let userLongitude = null;

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
                    }
                ]
            });

            var selectedLocations = [];

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
                    if (location.view_url) {
                        $('#streetViewFrame').attr('src',
                            `https://www.google.com/maps/embed/v1/streetview?key={{ config('services.google_maps.key') }}&location=${location.latitude},${location.longitude}&heading=210&pitch=10&fov=35`
                        );
                        $('#streetViewModal').modal('show');
                    } else {
                        alert("No 360 view available for this location.");
                    }

                    if (!selectedLocations.some(loc => loc.id === location.id)) {
                        selectedLocations.push(location);
                        updateSelectedLocationsList();
                    }
                });
            });

            function updateSelectedLocationsList() {
                var list = document.getElementById('selected-locations-list');
                list.innerHTML = '';
                selectedLocations.forEach(function(location) {
                    var li = document.createElement('li');
                    li.className = 'location-item';
                    li.textContent = location.name;

                    var removeIcon = document.createElement('i');
                    removeIcon.className = 'fas fa-trash-alt remove-icon';
                    removeIcon.addEventListener('click', function() {
                        removeLocation(location.id);
                    });

                    li.appendChild(removeIcon);
                    list.appendChild(li);
                });
            }

            function removeLocation(locationId) {
                selectedLocations = selectedLocations.filter(loc => loc.id !== locationId);
                updateSelectedLocationsList();
            }

            document.getElementById('save-locations-btn').addEventListener('click', function() {
                var locationIds = selectedLocations.map(function(location) {
                    return location.id;
                });

                var name = document.getElementById('location-name').value;
                var date = document.getElementById('location-date').value;

                if (!name || !date) {
                    alert('Please fill in both name and date.');
                    return;
                }

                if (userLatitude === null || userLongitude === null) {
                    alert('Could not retrieve live location. Please ensure location services are enabled.');
                    return;
                }

                var payload = {
                    selectedLocations: locationIds,
                    name: name,
                    date: date,
                    liveLocation: {
                        latitude: userLatitude,
                        longitude: userLongitude
                    }
                };

                fetch('{{ route('saveUserLocations') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.text().then(text => {
                                throw new Error(text);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            window.location.href = '/handle-trip/' + data.tripId + '?latitude=' + userLatitude +
                                '&longitude=' + userLongitude;
                        } else {
                            alert('Failed to save locations: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred: ' + error.message);
                    });
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    userLatitude = position.coords.latitude;
                    userLongitude = position.coords.longitude;

                    var pos = {
                        lat: userLatitude,
                        lng: userLongitude
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
                        strokeColor: '#FFFFFF'
                    };
                    var liveLocationMarker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        label: liveLocationLabel,
                        icon: liveLocationIcon
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

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap"></script>
    @include('Assets.footer')
    @include('Assets.js')

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>
