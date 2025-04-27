<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>New - Locations</title>
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
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-12 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Sales <span>| Today</span></h5>
                                    <div class="container mt-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="locationForm" method="POST" action="{{ route('saveLocation') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="locationName" class="form-label">Location Name</label>
                                                        <input type="text" class="form-control" id="locationName" name="location_name" placeholder="Location Name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="locationIcon" class="form-label">Location Icon (PNG only)</label>
                                                        <input class="form-control" type="file" id="locationIcon" name="location_icon" accept="image/png" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="viewPicture" class="form-label">360° View Picture</label>
                                                        <input class="form-control" type="file" id="viewPicture" name="360_view_picture" accept="image/*" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        {{-- <label for="viewURL" class="form-label">360° View URL</label> --}}
                                                        <input type="hidden" class="form-control" id="viewURL" name="view_url" placeholder="Enter Google 360 view URL" required readonly>
                                                    </div>
                                                    <input type="hidden" id="latitude" name="latitude">
                                                    <input type="hidden" id="longitude" name="longitude">
                                                    <button type="submit" class="btn btn-primary mt-3">Save Location</button>
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="map" style="height: 800px; width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var map;
        var marker;
        var panorama;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 7.8731, lng: 80.7718 },
                zoom: 8
            });

            map.addListener('click', function(e) {
                placeMarkerAndPanTo(e.latLng, map);
            });
        }

        function placeMarkerAndPanTo(latLng, map) {
            if (marker) {
                marker.setPosition(latLng);
            } else {
                marker = new google.maps.Marker({
                    position: latLng,
                    map: map
                });
            }
            map.panTo(latLng);

            // Fill the form fields
            $('#latitude').val(latLng.lat());
            $('#longitude').val(latLng.lng());

            // Get Street View panorama and URL
            var streetViewService = new google.maps.StreetViewService();
            var STREET_VIEW_MAX_DISTANCE = 50;

            streetViewService.getPanorama({
                location: latLng,
                radius: STREET_VIEW_MAX_DISTANCE
            }, processStreetViewData);
        }

        function processStreetViewData(data, status) {
            if (status === google.maps.StreetViewStatus.OK) {
                var panoramaUrl = 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=' + data.location.latLng.lat() + ',' + data.location.latLng.lng() + '&heading=0&pitch=0&fov=75';
                $('#viewURL').val(panoramaUrl);
            } else {
                $('#viewURL').val('');
                alert('No Street View found at this location.');
            }
        }
    </script>
    @component('components.google-maps-script')
    @endcomponent
    @include('Admin.Footer')
</body>
</html>
