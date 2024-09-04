@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Create City</h4>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">City</li>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="cityForm" action="{{ route('admin.cities-store') }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">City Name:<span class="impStar"> *</span></label>
                                        <input class="form-control" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">City Slug<span class="impStar"> *</span></label>
                                        <input class="form-control" placeholder="Slug in english" type="text"
                                            name="slug" id="slug" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">State:<span class="impStar"> *</span> </label>
                                        <select class="form-control form-select" name="state_id" id="state_id">
                                            @foreach ($states as $main)
                                                <option value="{{ $main->id }}">{{ $main->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Status :</label>
                                        <select class="form-control form-select" name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">De-Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <center class="mt-2">
                                <a href="{{ route('admin.cities') }}"
                                    class="btn btn-sm btn-secondary waves-effect waves-light">Cancel</a>
                                <button type="submit" id="citySubmit" class="btn btn-sm btn-primary">
                                    Save
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
        function updateSlug() {
            var slugInput = document.getElementById("slug");

            slugInput.addEventListener("blur", function() {
                var slugValue = this.value.trim().toLowerCase();
                var slug = slugValue.replace(/[^a-zA-Z0-9]/g,
                        "-") // Replace all non-alphanumeric characters with hyphens
                    .replace(/-+/g, "-") // Replace multiple hyphens with a single one
                    .replace(/^-|-$/g, ""); // Remove hyphens from the start and end of the string
                this.value = slug;
            });

            slugInput.dispatchEvent(new Event("blur"));
        }

        document.addEventListener("DOMContentLoaded", updateSlug);

        $('#citySubmit').click(function(e) {
            e.preventDefault();
            // Submit the form
            var slug = $('#slug').val();
            var name = $('#name').val();
            if (name === '') {
                Swal.fire('Validation Error', 'Please enter name.', 'error');
                return;
            }
            if (slug === '') {
                Swal.fire('Validation Error', 'Please enter Slug.', 'error');
                return;
            }

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
            $('#cityForm').submit();
        });

        $(document).ready(function() {
            $('#name').on('blur', function() {
                var name = $(this).val();

                $.ajax({
                    url: '{{ route('admin.check-city') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#name').val('');

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'City name already exists!'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
