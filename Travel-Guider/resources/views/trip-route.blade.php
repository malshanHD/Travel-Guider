<!DOCTYPE html>
<html>

<head>
    <title>Travel Route</title>
    @include('Assets.assets')

    <style>
        #map {
            height: 400px;
            width: 100%;
        }

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

    @component('components.google-maps-script')
    @endcomponent

    <script>
        let locations = @json($locations);
        let totalWaitingTimeInMinutes = {{ $totalWaitingTimeInMinutes }};
        let currentLatitude;
        let currentLongitude;

        function initMap() {
            if (isNaN(currentLatitude) || isNaN(currentLongitude)) {
                console.error('Invalid coordinates for current location');
                window.alert('Invalid coordinates for current location');
                return;
            }

            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: { lat: parseFloat(currentLatitude), lng: parseFloat(currentLongitude) }
            });

            const directionsService = new google.maps.DirectionsService();
            const blueRouteRenderer = new google.maps.DirectionsRenderer({
                polylineOptions: {
                    strokeColor: "#0000FF",
                    strokeOpacity: 0.8,
                    strokeWeight: 6
                },
                suppressMarkers: false
            });
            const redRouteRenderer = new google.maps.DirectionsRenderer({
                polylineOptions: {
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.8,
                    strokeWeight: 6
                },
                suppressMarkers: false
            });

            blueRouteRenderer.setMap(map);
            redRouteRenderer.setMap(map);

            const userMarker = new google.maps.Marker({
                position: { lat: parseFloat(currentLatitude), lng: parseFloat(currentLongitude) },
                map: map,
                title: "Your Location",
                icon: {
                    url: "https://maps.google.com/mapfiles/kml/shapes/homegardenbusiness.png" 
                }
            });

            let waypoints = locations.map(location => {
                if (isNaN(location.latitude) || isNaN(location.longitude)) {
                    console.error('Invalid coordinates for location:', location);
                    return null;
                }
                return {
                    location: {
                        lat: parseFloat(location.latitude),
                        lng: parseFloat(location.longitude)
                    },
                    stopover: true
                };
            }).filter(w => w !== null);

            if (waypoints.length < 1) {
                console.error('Not enough valid waypoints to draw a route');
                return;
            }

            const origin = { lat: parseFloat(currentLatitude), lng: parseFloat(currentLongitude) };
            const firstWaypoint = waypoints[0].location;
            const destination = waypoints.pop().location;
            const remainingWaypoints = waypoints.slice(1);

            directionsService.route({
                origin: origin,
                destination: firstWaypoint,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    blueRouteRenderer.setDirections(response);
                } else {
                    console.error('Directions request failed due to ' + status);
                    window.alert('Directions request failed due to ' + status);
                }
            });

            directionsService.route({
                origin: firstWaypoint,
                destination: destination,
                waypoints: remainingWaypoints,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    redRouteRenderer.setDirections(response);
                    const route = response.routes[0];
                    const waypointOrder = route.waypoint_order;

                    let sortedLocationNames = [locations[0].name];

                    for (let i = 0; i < waypointOrder.length; i++) {
                        sortedLocationNames.push(locations[waypointOrder[i] + 1].name);
                    }

                    sortedLocationNames.push(locations[waypointOrder.length + 1].name);

                    const sortedLocationsContainer = document.getElementById('sortedLocationsContainer');
                    sortedLocationsContainer.innerHTML = '';

                    sortedLocationNames.forEach(name => {
                        const card = document.createElement('div');
                        card.className = 'card l-bg-green-dark fw-bold';
                        card.innerHTML = `<div class="card-body">${name}</div>`;
                        sortedLocationsContainer.appendChild(card);
                    });

                    let totalDistance = 0;
                    let totalTime = 0;
                    for (const leg of route.legs) {
                        totalDistance += leg.distance.value;
                        totalTime += leg.duration.value;
                    }

                    totalTime += totalWaitingTimeInMinutes * 60;

                    let totalDistanceInKm = totalDistance / 1000;
                    let totalTravelTimeInMinutes = totalTime / 60;

                    document.getElementById('totalDistance').innerText =
                        `Total Distance: ${totalDistanceInKm.toFixed(2)} km`;
                    document.getElementById('totalTime').innerText =
                        `Total Time: ${totalTravelTimeInMinutes.toFixed(2)} minutes`;
                } else {
                    console.error('Directions request failed due to ' + status);
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }

        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    currentLatitude = position.coords.latitude;
                    currentLongitude = position.coords.longitude;
                    initMap();
                }, function(error) {
                    console.error('Error getting current location:', error);
                    window.alert('Error getting current location: ' + error.message);
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
                window.alert('Geolocation is not supported by this browser.');
            }
        }

        window.addEventListener('load', function() {
            if (typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
                getCurrentLocation();
            } else {
                console.error('Google Maps API not loaded');
                window.alert('Google Maps API not loaded');
            }
        });
    </script>
</head>

<body>
    @include('Assets.topbar')
    @include('Assets.header')
    <main id="main">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="card info-card sales-card l-bg-cyan h-100 d-flex flex-column">
                        <div class="card-body">
                            <div id="map" style="height: 600px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="totalDistance"></div>
                    <div id="totalTime"></div>
                    <ul id="list"></ul>
                    <div id="sortedLocationsContainer"></div>
                </div>
            </div>
        </div>
    </main>

    @include('Assets.js')

</body>

</html>
