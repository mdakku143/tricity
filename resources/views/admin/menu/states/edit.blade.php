@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Edit State</h4>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">State</li>
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
                        <form id="stateForm" action="{{ route('admin.states-update') }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">State Name:<span class="impStar"> *</span></label>
                                            <input class="form-control" type="text" name="name" id="name"
                                                value="{{ $data->name ?? null }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">State Slug<span class="impStar"> *</span></label>
                                            <input class="form-control" placeholder="Slug in english" type="text"
                                                name="slug" id="slug" value="{{ $data->slug ?? null }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Country:<span class="impStar"> *</span></label>
                                            <select class="form-control form-select" name="country_id" id="country_id">
                                                @foreach ($countries as $main)
                                                    <option value="{{ $main->id }}"
                                                        {{ $data->country_id == $main->id ? 'selected' : '' }}>
                                                        {{ $main->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Status :</label>
                                            <select class="form-control form-select" name="status" id="status">
                                                <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="2" {{ $data->status == 0 ? 'selected' : '' }}>De-Active
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center class="mt-2">
                                <a href="{{ route('admin.states') }}"
                                    class="btn btn-sm btn-secondary waves-effect waves-light">Cancel</a>
                                <button type="submit" id="stateSubmit" class="btn btn-sm btn-primary">
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


        $('#stateSubmit').click(function(e) {
            e.preventDefault();
            // Submit the form
            let slug = $('#slug').val();
            let name = $('#name').val();
            let id = $('#id').val();
            if (name === '') {
                Swal.fire('Validation Error', 'Please enter name.', 'error');
                return;
            }
            if (slug === '') {
                Swal.fire('Validation Error', 'Please enter Slug.', 'error');
                return;
            }
            // $.ajax({
            //     url: '{{ route('admin.check-state') }}',
            //     method: 'POST',
            //     data: {
            //         _token: '{{ csrf_token() }}',
            //         name: name,
            //         id: id
            //     },
            //     success: function(response) {
            //         if (response.exists) {
            //             name.val('');
            //             Swal.fire({
            //                 icon: 'error',
            //                 title: 'Oops...',
            //                 text: 'State name already exists!'
            //             });
            //         } else {
            //             Swal.fire({
            //                 title: 'Updating',
            //                 text: 'Please wait...',
            //                 icon: 'info',
            //                 allowOutsideClick: false,
            //                 showConfirmButton: false,
            //                 willOpen: () => {
            //                     Swal.showLoading();
            //                 }
            //             });
            //             $('#stateForm').submit();

            //         }
            //     }
            // });
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
            $('#stateForm').submit();
        });
        $(document).ready(function() {
            $('#name').on('blur', function() {
                let name = $(this).val();
                let id = $('#id').val();
                $.ajax({
                    url: '{{ route('admin.check-state') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        id: id
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#name').val('');
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'State name already exists!'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
