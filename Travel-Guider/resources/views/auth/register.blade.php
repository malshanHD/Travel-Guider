<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h3><b>Create your Account</b></h3>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="container mt-3">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mt-3">
                                    <input type="text" name="name" id="name" class="form-control input"
                                        placeholder="First name">
                                </div>

                                <div class="col-md-6 col-sm-12 mt-3">
                                    <input type="text" name="lastName" id="lastName" class="form-control"
                                        placeholder="Last name">

                                </div>

                                <div class="col-md-6 col-sm-12 mt-3">
                                    <label for="formGroupExampleInput">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Date of birthday</label>
                                        <input type="date" class="form-control" id="dob" name="dob">
                                    </div>
                                </div>

                                <div class="col-md-5 col-sm-12 mt-3">
                                    <input type="text" name="city" id="city" class="form-control"
                                        placeholder="City">
                                </div>

                                <div class="col-md-4 col-sm-12 mt-3">
                                    <input type="text" name="state" id="state" class="form-control"
                                        placeholder="State">
                                </div>

                                <div class="col-md-3 col-sm-12 mt-3">
                                    <input type="text" name="zip" id="zip" class="form-control"
                                        placeholder="Zip Code">
                                </div>

                                <div class="col-md-6 col-sm-12 mt-4">
                                    <label for="formGroupExampleInput">Nationality</label>
                                    <div class="country-container">
                                        <select class="countries form-control form-control-sm" name="countries"
                                            id="countries">
                                            <option class="text-Secondary" value="" selected>Select your country
                                            </option>
                                            <option value="LK">Sri Lanka</option>
                                        </select>
                                        <span class="flag" id="flag"></span>
                                    </div>
                                </div>

                                <div class="col-md-5 col-sm-12 mt-3">
                                    <label for="formGroupExampleInput">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="" selected>Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="col-md-5 col-sm-12 mt-4">
                                    <input type="tel" name="telephone" id="telephone" class="form-control"
                                        placeholder="Contact No.">
                                </div>
                            </div>

                            <hr>
                            <div class="row mt-4">

                                <div class="col-md-6 ">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="confirm password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 mt-5">
                                    <div class="form-check">
                                        <input type="checkbox" name="checkbox" class="form-check-input"
                                            id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">I agree to terms &
                                            conditions of
                                            Paradise travel lanka </label>
                                        <p class="text-danger"><i><b> click <a href="#">here</a> to view terms &
                                                    conditions</i> </b></p>
                                        @error('checkbox')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_level" value="2">

                            <div class="row">
                                <div class="col-md-8 col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Register') }}
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-sm-0">
                            <img src="/system_images/loginIconnew.png" style="width:100%;" alt="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>
