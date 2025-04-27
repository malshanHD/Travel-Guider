<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('Admin.libraries')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
    </script>
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

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Total planned trips</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $totalPlannedTrips }}</h6>
                                            <span
                                                class="{{ $tripPercentageChange >= 0 ? 'text-success' : 'text-danger' }} small pt-1 fw-bold">
                                                {{ number_format($tripPercentageChange, 2) }}%
                                            </span>
                                            <span class="text-muted small pt-2 ps-1">
                                                {{ $tripPercentageChange >= 0 ? 'increase' : 'decrease' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Total Revenue</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-rupee"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$formattedPrice}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Customers</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $totalCustomers }}</h6>
                                            <span
                                                class="{{ $registrationPercentageChange >= 0 ? 'text-success' : 'text-danger' }} small pt-1 fw-bold">
                                                {{ number_format($registrationPercentageChange, 2) }}%
                                            </span>
                                            <span class="text-muted small pt-2 ps-1">
                                                {{ $registrationPercentageChange >= 0 ? 'increase' : 'decrease' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div id="registration_chart_div" style="width: 100%; height: 500px;"></div>
                            <div id="trip_chart_div" style="width: 100%; height: 500px;"></div>
                            <div id="location_chart_div" style="width: 100%; height: 500px;"></div>
                            <!-- Pie Chart Container -->
                        </div>
                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <!-- Recent Activity -->
                </div><!-- End Right side columns -->
            </div>
        </section>
    </main><!-- End #main -->

    @include('Admin.Footer')

</body>

</html>
