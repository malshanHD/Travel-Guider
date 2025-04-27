<!DOCTYPE html>
<html>

<head>
    <title>Travel Route</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    @component('components.google-maps-script')
    @endcomponent
    <script>
        let locations = @json($locations);
        let totalWaitingTimeInMinutes = {{ $totalWaitingTimeInMinutes }};

        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: {
                    lat: 9.6615,
                    lng: 80.0255
                }
            });

            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer({
                polylineOptions: {
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.8,
                    strokeWeight: 6
                }
            });
            directionsRenderer.setMap(map);

            let waypoints = locations.map(location => ({
                location: {
                    lat: parseFloat(location.latitude),
                    lng: parseFloat(location.longitude)
                },
                stopover: true
            }));

            if (waypoints.length < 2) return; // Need at least 2 points to draw a route

            const origin = waypoints.shift().location;
            const destination = waypoints.pop().location;

            directionsService.route({
                origin: origin,
                destination: destination,
                waypoints: waypoints,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);
                    const route = response.routes[0];
                    let totalDistance = 0;
                    let totalTime = 0; // This is the driving time
                    for (const leg of route.legs) {
                        totalDistance += leg.distance.value;
                        totalTime += leg.duration.value; // in seconds
                    }

                    // Convert driving time to minutes and add waiting time
                    let totalTravelTimeInMinutes = (totalTime / 60) + totalWaitingTimeInMinutes;

                    document.getElementById('totalDistance').innerText =
                        `Total Distance: ${(totalDistance / 1000).toFixed(2)} km`;
                    document.getElementById('totalTime').innerText =
                        `Estimated Time: ${totalTravelTimeInMinutes.toFixed(2)} minutes (including waiting time)`;
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>
</head>

<body>
    <div id="map"></div>
    <div id="totalDistance"></div>
    <div id="totalTime"></div>
</body>

</html>
