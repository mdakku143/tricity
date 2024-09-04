<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Log In | TriCity Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('/admin/assets/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('/admin/assets/js/config.js') }}"></script>
</head>

<body class="bg-primary d-flex justify-content-center align-items-center min-vh-100 p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-5">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="text-center w-75 mx-auto auth-logo mb-4">
                            <a href="index.html" class="logo-dark">
                                <span><img src="{{ asset('admin/assets/images/tricity-logo.png') }}" alt=""
                                        height="32"></span>
                            </a>

                            <h5>Admin Login</h5>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label" for="emailaddress">Email address</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <a href="pages-recoverpw.html" class="text-muted float-end"><small></small></a>
                                <label class="form-label" for="password">Password</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- <div class="form-group mb-3">
                                <div class="">
                                    <input class="form-check-input" type="checkbox" id="checkbox-signin" checked>
                                    <label class="form-check-label ms-2" for="checkbox-signin">Remember me</label>
                                </div>
                            </div> --}}

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary w-40" type="submit">Log In </button>
                                {{-- <a class="btn btn-info w-40" href="{{ route('reporter-login-form') }}">Reporter
                                    Login</a> --}}
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->
                {{-- 
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50"> <a href="pages-register.html" class="text-white-50 ms-1">Forgot your
                                password?</a></p>
                        <p class="text-white-50">Don't have an account? <a href="pages-register.html"
                                class="text-white font-weight-medium ms-1">Sign Up</a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row --> --}}

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <!-- App js -->
    <script src="{{ asset('/admin/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/app.js') }}"></script>

</body>

</html>
