@extends('reporter.layout.app')

@section('title', 'Reporter Dashboard')

@section('content')
    <div class="container">
        <h2>Verify Your Email Address</h2>
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success" role="alert">
                A new verification link has been sent to your email address.
            </div>
        @endif
        <p>Before proceeding, please check your email for a verification link.</p>
        <p>If you did not receive the email, <a href="{{ route('reporter.verification.resend') }}">click here to request
                another</a>.</p>
    </div>
@endsection



<!doctype html>
<html lang="en">

<head>
    <title>Mind First - Forgot Password</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/whychooseus-mh-logo-01.svg') }}">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('frontend/common-style.css') }}">

</head>

<body>
    <section class="login body-height" id="forgot-password">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 col-sm-12 p-0">
                    <div class="left_side txt-section">
                        <div class="logo">
                            <img src="{{ asset('frontend/assets/images/w-logo.svg') }}" width="100%" alt="login_logo">
                        </div>

                        <img src="{{ asset('frontend/assets/images/mind_bg_images.svg') }}" width="100%"
                            alt="">


                        <h2 class="txt-white" id="login_heading"></h2>
                        <p class="txt-white" id="login_para"></p>

                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <div class="txt-howtowork login" id="forgot-password">
                        <div class="headingbx form_area">



                            <div class="alert alert-success">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-primary">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-8">


                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf

                                        <div>
                                            <button type="submit" class="btn btn-default form-control">
                                                {{ __('Resend Verification Email') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form method="GET" action="{{ route('logout') }}">
                                        @csrf

                                        <button type="submit" class="btn btn-default form-control">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend/frontend_custom.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const textareasss = [
                document.getElementById('login_heading'),
                document.getElementById('login_para'),

            ];

            const appUrl = '{{ config('app.url') }}';

            // Fetch existing data
            try {
                const response = await fetch(appUrl + '/sidebar', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',

                    },
                });

                const result = await response.json();
                console.log(result);

                if (result.data) {
                    // Populate textareas with existing data
                    textareasss[0].innerHTML = result.data.heading;
                    textareasss[1].innerHTML = result.data.paragraph;
                    responseData = result.data;
                }
            } catch (error) {
                console.error('Error fetching existing data:', error);
            }
        });
    </script>
</body>

</html>
