<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @include('Assets.assets')
    <link rel="stylesheet" href="css/card.css">
</head>

<body>
    <!-- ======= Top Bar ======= -->
    @include('Assets.topbar')
    <!-- End Top Bar-->

    <!-- ======= Header ======= -->
    @include('Assets.header')
    <!-- End Header -->

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h3 class="fw-bold text-center mt-5">LOGIN</h3> <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-6 align-self-center">

                                    <div class="mb-5">
                                        <a class="weatherwidget-io" href="https://forecast7.com/en/7d8780d77/sri-lanka/"
                                            data-label_1="SRI LANKA" data-label_2="WEATHER" data-theme="original">SRI
                                            LANKA WEATHER</a>
                                        <script>
                                            ! function(d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (!d.getElementById(id)) {
                                                    js = d.createElement(s);
                                                    js.id = id;
                                                    js.src = 'https://weatherwidget.io/js/widget.min.js';
                                                    fjs.parentNode.insertBefore(js, fjs);
                                                }
                                            }(document, 'script', 'weatherwidget-io-js');
                                        </script>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror mt-3"
                                        name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link mt-4" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('Assets.footer')
    @include('Assets.js')
</body>

</html>
