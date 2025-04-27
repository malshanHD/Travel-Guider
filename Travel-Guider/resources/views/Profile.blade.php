<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('Admin.libraries')
    {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            drawChart('registration_chart_div', 'User Registrations Per Month', {!! json_encode($registrationData) !!});
            drawChart('trip_chart_div', 'Trips Per Month', {!! json_encode($tripData) !!});
            drawPieChart('location_chart_div', 'Most Popular Locations', {!! json_encode($popularLocations) !!});
        }

        function drawChart(elementId, title, data) {
            var chartData = [
                ['Month', 'Count'],
                ['January', data[1]],
                ['February', data[2]],
                ['March', data[3]],
                ['April', data[4]],
                ['May', data[5]],
                ['June', data[6]],
                ['July', data[7]],
                ['August', data[8]],
                ['September', data[9]],
                ['October', data[10]],
                ['November', data[11]],
                ['December', data[12]]
            ];

            var options = {
                title: title,
                hAxis: {
                    title: 'Month',
                    titleTextStyle: {
                        color: '#333'
                    }
                },
                vAxis: {
                    minValue: 0
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById(elementId));
            chart.draw(google.visualization.arrayToDataTable(chartData), options);
        }

        function drawPieChart(elementId, title, data) {
            var chartData = [
                ['Location', 'Count']
            ];
            for (var location in data) {
                chartData.push([location, data[location]]);
            }

            var options = {
                title: title
            };

            var chart = new google.visualization.PieChart(document.getElementById(elementId));
            chart.draw(google.visualization.arrayToDataTable(chartData), options);
        }
    </script> --}}
</head>

<body>

    @if (!$customer->active_status)
        {
        @include('User.activate', ['customer' => $customer]);
        }

    @else{
        @include('User.header')

        @include('User.navbar')


        <main id="main" class="main">

            <div class="pagetitle">
                <h1>My Profile</h1>
            </div><!-- End Page Title -->

            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="/profile-update" method="post">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="firstname" class="fw-bold fst-italic">First Name</label>
                            <input type="text" name="firstname" id="firstname"
                                class="form-control fw-bold text-secondory" placeholder="first name"
                                value="{{ $customer->first_name }}">
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="fw-bold fst-italic">Last Name</label>
                            <input type="text" name="lastname" id="lastname"
                                class="form-control fw-bold text-secondory" placeholder="last name"
                                value="{{ $customer->last_name }}">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="email" class="fw-bold fst-italic">Email</label>
                            <input type="text" name="email" id="email"
                                class="form-control fw-bold text-secondory" placeholder="email"
                                value="{{ $customer->email }}">
                        </div>
                        <div class="col-md-6">
                            <label for="contact" class="fw-bold fst-italic">Contact number</label>
                            <input type="text" name="contact" id="contact"
                                class="form-control fw-bold text-secondory" placeholder="contact"
                                value="{{ $customer->phone_number }}">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="City" class="fw-bold fst-italic">City</label>
                            <input type="text" name="City" id="City"
                                class="form-control fw-bold text-secondory" placeholder="City"
                                value="{{ $customer->city }}">
                        </div>
                        <div class="col-md-3">
                            <label for="state" class="fw-bold fst-italic">state</label>
                            <input type="text" name="state" id="state"
                                class="form-control fw-bold text-secondory" placeholder="state"
                                value="{{ $customer->state }}">
                        </div>
                        <div class="col-md-3">
                            <label for="Zipcode" class="fw-bold fst-italic">Zip code</label>
                            <input type="text" name="Zipcode" id="Zipcode"
                                class="form-control fw-bold text-secondory" placeholder="Zip code"
                                value="{{ $customer->zip_code }}">
                        </div>
                        <div class="col-md-3">
                            <label for="country" class="fw-bold fst-italic">country</label>
                            <input type="text" name="country" id="country"
                                class="form-control fw-bold text-secondory" placeholder="country"
                                value="{{ $customer->country }}">
                        </div>
                    </div>

                    <div class="row mt-5">
                        <input type="submit" value="Update" class="btn btn-success">
                    </div>
                </form>
            </div>

            
        </main><!-- End #main -->


        @include('Admin.Footer')

        }
    @endif

    

</body>

</html>
