<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin - Regitstration</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('Admin.libraries')

</head>

<body>

    @include('Admin.header')

    @include('Admin.navbar')

    @auth
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Admin registration</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </nav>
            </div>

            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12 fw-bold">
                        @php
                            $isDisabled = Auth::user()->user_Level == 3 ? true : false;
                        @endphp
                        <form action="/saveadmin" method="post">
                            @csrf
                            <div class="row">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        {{ $isDisabled ? 'disabled' : '' }}>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Email <span class="text-danger">*</span></label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        {{ $isDisabled ? 'disabled' : '' }}>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <input type="submit" value="Submit" class="btn btn-success mt-3"
                                        {{ $isDisabled ? 'disabled' : '' }}>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <hr class="mt-3 mb-3">
            <div class="pagetitle mt-5">
                <h1>List of admins</h1>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Vaified at</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if ($user->is_active)
                                        <tr class="table-primary">
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->email_verified_at }}</td>
                                            <td>
                                                @if ($user->user_Level == 3)
                                                    Low level admin
                                                @else
                                                    High level admin
                                                @endif
                                            </td>
                                            <td class="text-center fw-bold">
                                                @if (!$isDisabled)
                                                    <a href="/admin-banned/{{ $user->id }}"><i
                                                            class="bi bi-ban text-danger"></i></a>
                                                @else
                                                    <span class="text-muted"><i class="bi bi-ban text-danger"></i></span>
                                                @endif

                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-warning">
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->email_verified_at }}</td>
                                            <td>
                                                @if ($user->user_Level == 3)
                                                    Low level admin
                                                @else
                                                    High level admin
                                                @endif
                                            </td>
                                            <td class="text-center fw-bold">
                                                @if (!$isDisabled)
                                                    <a href="/admin-active/{{ $user->id }}"><i
                                                            class="bi bi-bootstrap-reboot text-success"></i></a>
                                                @else
                                                    <span class="text-muted"><i class="bi bi-bootstrap-reboot"></i></span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
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
