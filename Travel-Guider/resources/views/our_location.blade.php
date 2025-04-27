<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Saved Locations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Saved Locations Map</h2>
        <div id="map" style="height: 800px;"></div>
    </div>

    <script>
        // Assuming $locations is passed to this view with ->with('locations', $locations)
        var locations = @json($locations);
    </script>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: {
                    lat: 7.8731,
                    lng: 80.7718
                }, // Center the map over Sri Lanka.
                disableDefaultUI: true, // Disable default UI controls
                styles: [
                    // Styling to hide various map features; adjust as needed
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

            // Display saved locations from database
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
            });

            // Attempt to get and display the user's live location
            // Attempt to get and display the user's live location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    // Create a custom label for the live location marker
                    var liveLocationLabel = {
                        text: 'Me', // Text for the label
                        color: '#FFFFFF', // Color of the text
                        fontSize: '14px', // Size of the text
                        fontWeight: 'bold', // Weight of the text
                    };
                    // Custom icon for the live location marker
                    var liveLocationIcon = {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 10, // Size of the custom icon
                        fillColor: '#4285F4', // Fill color of the custom icon
                        fillOpacity: 1,
                        strokeWeight: 2, // Border of the icon
                        strokeColor: '#FFFFFF', // Border color
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
                // Browser doesn't support Geolocation
                handleLocationError(false, map.getCenter());
            }

        }

        function handleLocationError(browserHasGeolocation, pos) {
            console.error(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            // Optionally, implement user-facing messages here
        }
    </script>

    @component('components.google-maps-script')
    @endcomponent
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
