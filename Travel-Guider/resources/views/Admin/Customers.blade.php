<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Customers</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('Admin.libraries')

</head>

<body>

    @include('Admin.header')

    @include('Admin.navbar')

    @auth
        <main id="main" class="main">

            <div class="pagetitle mt-5">
                <h1>Our Customers</h1>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Zip code</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Registration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr class="table-primary">
                                        <th scope="row">{{ $customer->id }}</th>
                                        <td>{{ $customer->first_name }}</td>
                                        <td>{{ $customer->last_name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->city }}</td>
                                        <td>{{ $customer->state }}</td>
                                        <td>{{ $customer->zip_code }}</td>
                                        <td>{{ $customer->country }}</td>
                                        <td>{{ $customer->gender }}</td>
                                        <td>{{ $customer->dob }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td class="text-center">
                                            @if ($customer->active_status)
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-danger">Yet to Complete</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    @endauth
    @include('Admin.Footer')

</body>

</html>
