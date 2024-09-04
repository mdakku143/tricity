@extends('admin.layout.app')
@section('title', 'TriCity - Reporters')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Edit Reporters</h4>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Reporters</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="container well">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="ReporterForm" action="{{ route('admin.reporters-update') }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Name <span class="impStar"> *</span></label>
                                        <input class="form-control" type="text" name="name" id="name"
                                            value="{{ $data->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Email <span class="impStar"> *</span></label>
                                        <input class="form-control" type="email" name="email" id="email"
                                            value="{{ $data->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Contact <span class="impStar"> *</span></label>
                                        <input class="form-control" type="number" name="contact" id="contact"
                                            value="{{ $data->contact }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Password <span class="impStar"> *</span></label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            value="{{ $data->password }}" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Confirm Password <span class="impStar"> *</span></label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div> --}}

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Aadhaar No <span class="impStar"> *</span></label>
                                        <input class="form-control" type="number" maxlength="12" name="aadhaar_no"
                                            id="aadhaar_no" value="{{ $data->aadhaar_no }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">X (tweeter) Id <span class="impStar"> *</span></label>
                                        <input class="form-control" type="text" name="x_id" id="x_id"
                                            value="{{ $data->x_id }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Facebook Id <span class="impStar"> *</span></label>
                                        <input class="form-control" type="text" name="facebook_id" id="facebook_id"
                                            value="{{ $data->facebook_id }}" required>
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
                                                <option value="{{ $state->id }}"
                                                    {{ $data->state == $state->id ? 'selected' : '' }}>
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
                                            @foreach ($cityData as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ $data->city == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Upload Aadhaar <span class="impStar"> *</span></label>
                                        <input class="form-control" type="file" name="upload_aadhaar"
                                            id="upload_aadhaar" required>
                                        @if ($data->upload_aadhaar)
                                            <a target="_blank"
                                                href="{{ asset('admin/assets/images/reporters/' . $data->upload_aadhaar) }}">
                                                view doc
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Profile Image <span class="impStar"> *</span></label>
                                        <input class="form-control" type="file" name="image" id="image"
                                            required>
                                        @if ($data->image)
                                            <a target="_blank"
                                                href="{{ asset('admin/assets/images/reporters/' . $data->image) }}">
                                                view profile
                                            </a>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Verified :</label>
                                        <select class="form-control form-select" name="is_verified" id="is_verified"
                                            required>
                                            <option value="1" {{ $data->is_verified == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="0" {{ $data->is_verified == 0 ? 'selected' : '' }}>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Status :</label>
                                        <select class="form-control form-select" name="status" id="status">
                                            <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>De-Active
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <textarea class="form-control" name="address" id="address" cols="30" rows="2">value="{{ $data->address }}"</textarea>
                                    </div>
                                </div>
                            </div>
                            <center class="mt-2">
                                <a href="{{ route('admin.reporters') }}"
                                    class="btn btn-sm btn-secondary waves-effect waves-light">Cancel</a>
                                <button type="submit" id="reporterSubmit" class="btn btn-sm btn-primary">
                                    Update
                                </button>
                            </center>
                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>
@endsection

@section('script')
    @parent
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
                // var password = $('#password').val();
                // var confirmPassword = $('#password-confirm').val();
                var aadhaarNo = $('#aadhaar_no').val().trim();
                var xId = $('#x_id').val().trim();
                var facebookId = $('#facebook_id').val().trim();
                var state = $('#state').val();
                var city = $('#city').val();
                // var image = $('#image').val();
                var isVerified = $('#is_verified').val();
                var status = $('#status').val();
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
                // if (password === '') {
                //     alert('Please enter Password');
                //     return;
                // }
                // if (confirmPassword === '') {
                //     alert('Please enter Confirm Password');
                //     return;
                // }
                // if (password !== confirmPassword) {
                //     alert('Password and Confirm Password do not match');
                //     return;
                // }
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
                // if (image === '') {
                //     alert('Please choose an image');
                //     return;
                // }
                if (isVerified === '') {
                    alert('Please select Verified status');
                    return;
                }
                if (status === '') {
                    alert('Please select Status');
                    return;
                }

                // If custom validation passes, show loading spinner
                Swal.fire({
                    title: 'Updating',
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
@endsection
