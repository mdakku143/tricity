@extends('reporter.layout.app')

@section('title', 'Reporter Dashboard')

@section('content')
    <section class="login body-height mt-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="txt-howtowork login">
                    <div class="form_area">
                        <div class="alert alert-success">
                            <h3> {{ 'Dear ' . Auth::user()->name }}</h3>
                            </br>
                            <p>
                                Thank you for registering with us. Before you can begin using your account, our
                                administration team will need to verify your details. We appreciate your patience during
                                this process.
                            </p>
                            <p>
                                Rest assured, we will notify you via email as soon as your account is ready for use.
                            </p>
                            <br>
                            <h5>
                                Regards,
                                <br>
                                PHM
                            </h5>
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-primary">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
