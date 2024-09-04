<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Log In | TriCity Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/icon/tricity-logo-light.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('frontend/images/icon/favicon.png') }}" type="image/x-icon" />

    <!-- App css -->
    <link href="{{ asset('admin/assets/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
</head>

<body class="bg-primary">
    <div class="container mt-4">
        <div class="card">
            <div class="card-body p-4">
                <div class="text-center w-75 mx-auto auth-logo mb-4">
                    <a href="index.html" class="logo-dark">
                        <span><img src="{{ asset('admin/assets/images/tricity-logo.png') }}" alt=""
                                height="32"></span>
                    </a>

                    <h5>Reporter Registration Form</h5>

                    {{-- <a href="index.html" class="logo-light">
                                <span><img src="{{ asset('admin/assets/images/logo-light.png') }}" alt=""
                                        height="22"></span>
                            </a> --}}
                </div>

                <form id="ReporterForm" action="{{ route('reporter.register') }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Name <span class="impStar"> *</span></label>
                                <input class="form-control" type="text" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email <span class="impStar"> *</span></label>
                                <input class="form-control" type="email" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contact <span class="impStar"> *</span></label>
                                <input class="form-control" type="number" name="contact" id="contact" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Password <span class="impStar"> *</span></label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Confirm Password <span class="impStar"> *</span></label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Aadhaar No <span class="impStar"> *</span></label>
                                <input class="form-control" type="number" maxlength="12" name="aadhaar_no"
                                    id="aadhaar_no" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">X (tweeter) Id <span class="impStar"> *</span></label>
                                <input class="form-control" type="text" name="x_id" id="x_id" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Facebook Id <span class="impStar"> *</span></label>
                                <input class="form-control" type="text" name="facebook_id" id="facebook_id"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Upload Image <span class="impStar"> *</span></label>
                                <input class="form-control" type="file" name="image" id="image" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">State <span class="impStar"> *</span></label>
                                <select class="form-control form-select" name="state" id="state" required>
                                    <option value="">--Select--</option>
                                    @foreach ($stateData as $state)
                                        <option value="{{ $state->id }}">
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">City <span class="impStar"> *</span></label>
                                <select class="form-control form-select" name="city" id="city" required>
                                    <option value="">--Select--</option>
                                    {{-- @foreach ($mainMenu as $main)
                                            <option value="{{ $main->Id }}">{{ $main->CategoryName }}</option>
                                        @endforeach --}}
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea class="form-control" name="address" id="address" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <center class="mt-2">
                        <a href="{{ route('reporter-login') }}"
                            class="btn btn-sm btn-secondary waves-effect waves-light">Cancel</a>
                        <button type="submit" id="reporterSubmit" class="btn btn-sm btn-primary">
                            Save
                        </button>
                    </center>
                </form>
            </div> <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script src="{{ asset('frontend/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(function() {
            function getCity() {
                const stateId = $('#state').val();
                $('#city').empty();
                $.ajax({
                    url: "{{ route('admin.reporters-get-city') }}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: stateId
                    },
                    success: function(response) {
                        if (response.success == true) {
                            var emptyRow = `<option value="">--Select--</option>`;
                            $('#city').append(emptyRow);
                            $.each(response.data, function(index, item) {
                                var row = `
                                            <option value="` + item.id + `">` + item.name + `</option>
                                        `;
                                $('#city').append(row);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while saving data!',
                        });
                    }
                });
            }
            $('#state').change(function() {
                getCity();
            });

            $('#reporterSubmit').click(function(e) {
                e.preventDefault();

                // Gather form values
                var name = $('#name').val().trim();
                var email = $('#email').val().trim();
                var contact = $('#contact').val().trim();
                var password = $('#password').val();
                var confirmPassword = $('#password-confirm').val();
                var aadhaarNo = $('#aadhaar_no').val().trim();
                var xId = $('#x_id').val().trim();
                var facebookId = $('#facebook_id').val().trim();
                var state = $('#state').val();
                var city = $('#city').val();
                var image = $('#image').val();
                var address = $('#address').val().trim();

                // Custom validation
                if (name === '') {
                    alert('Please enter Name');
                    return;
                }
                if (email === '') {
                    alert('Please enter Email');
                    return;
                }
                if (contact === '') {
                    alert('Please enter Contact');
                    return;
                }
                if (!/^\d+$/.test(contact)) {
                    alert('Please enter a valid Contact number');
                    return;
                }
                if (password === '') {
                    alert('Please enter Password');
                    return;
                }
                if (confirmPassword === '') {
                    alert('Please enter Confirm Password');
                    return;
                }
                if (password !== confirmPassword) {
                    alert('Password and Confirm Password do not match');
                    return;
                }
                if (aadhaarNo === '') {
                    alert('Please enter Aadhaar No');
                    return;
                }
                if (!/^\d{12}$/.test(aadhaarNo)) {
                    alert('Aadhaar Number must be a 12-digit number');
                    return;
                }
                if (xId === '') {
                    alert('Please enter X (Twitter) Id');
                    return;
                }
                if (facebookId === '') {
                    alert('Please enter Facebook Id');
                    return;
                }
                if (state === '') {
                    alert('Please select State');
                    return;
                }
                if (city === '') {
                    alert('Please select City');
                    return;
                }
                if (image === '') {
                    alert('Please choose an image');
                    return;
                }

                // If custom validation passes, show loading spinner
                Swal.fire({
                    title: 'Storing',
                    text: 'Please wait...',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit the form
                $('#ReporterForm').submit();
            });

        });
    </script>
</body>

</html>
