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

    @if (!$customer->active_status)
        @include('User.activate', ['customer' => $customer]);

    @else{
        @include('User.header')

        @include('User.navbar')


        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12">
                        <div class="row">

                            <!-- Sales Card -->
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
                                                <h6>{{ $trips }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Sales Card -->


                            <!-- Customers Card -->
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
                                        <h5 class="card-title">Feedbacks</h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            {{-- <div class="ps-3">
                                                <h6>{{ $totalCustomers }}</h6>
                                                <span
                                                    class="{{ $registrationPercentageChange >= 0 ? 'text-success' : 'text-danger' }} small pt-1 fw-bold">
                                                    {{ number_format($registrationPercentageChange, 2) }}%
                                                </span>
                                                <span class="text-muted small pt-2 ps-1">
                                                    {{ $registrationPercentageChange >= 0 ? 'increase' : 'decrease' }}
                                                </span>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Customers Card -->
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div style="width: 80%; margin: auto;">
                                    <h2>Most Popular Destinations</h2>
                                    <canvas id="popularLocationsChart"></canvas>
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
        </main><!-- End #main -->

        @include('Admin.Footer')

        }
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('popularLocationsChart').getContext('2d');
            var popularLocationsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($locations),
                    datasets: [{
                        label: 'Number of Visits',
                        data: @json($counts),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
