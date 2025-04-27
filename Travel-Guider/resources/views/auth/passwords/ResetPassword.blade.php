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
    @include('User.header')

    @include('User.navbar')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Account Settings</h1>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Change Password</div>

                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input id="current_password" type="password" class="form-control"
                                        name="current_password" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input id="new_password" type="password" class="form-control" name="new_password"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation">Confirm New Password</label>
                                    <input id="new_password_confirmation" type="password" class="form-control"
                                        name="new_password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-header">Change Profile Picture</div>

                        <div class="card-body">
                            <form method="POST" action="/profile" enctype="multipart/form-data" id="profileForm">
                                @csrf
                                <input type="file" name="profile_picture" id="profilePicture"
                                    onchange="previewImage(event)" class="form-control">
                                <img id="preview" src="#" alt="Preview"
                                    style="max-width: 200px; display: none;">
                                <button type="submit" class="btn btn-primary mt-2">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main><!-- End #main -->


    @include('Admin.Footer')


    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>


</body>

</html>
