@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Create E-book</h4>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">E-books</li>
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
            <div class="card">
                <div class="card-body">
                    <form id="ebookForm" action="{{ route('admin.ebooks-store') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Name<span class="impStar"> *</span></label>
                                    <input class="form-control" type="text" name="name" id="name" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Upload E-book<span class="impStar"> *</span></label>
                                    <input class="form-control" type="file" name="file" id="file" accept=".pdf"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select class="form-control form-select" name="status" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">De-Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <center class="mt-2">
                            <a href="{{ route('admin.ebooks') }}"
                                class="btn btn-sm btn-secondary waves-effect waves-light">Cancel</a>
                            <button type="submit" id="ebookSubmit" class="btn btn-sm btn-primary">
                                Save
                            </button>
                        </center>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $('#ebookSubmit').click(function(e) {
            e.preventDefault();
            // Submit the form
            let name = $('#name').val();
            let fileInput = document.getElementById('file');
            let file = fileInput.files[0]; // Get the selected file
            let maxSize = 2 * 1024 * 1024; // 2MB max size

            // Validate Name
            if (name === '') {
                Swal.fire('Validation Error', 'Please enter a name.', 'error');
                return;
            }

            // Validate if a file is selected
            if (!file) {
                Swal.fire('Validation Error', 'Please choose a file.', 'error');
                return;
            }

            // Validate File Type
            if (file.type !== 'application/pdf') {
                Swal.fire('Validation Error', 'Please upload a valid PDF file.', 'error');
                return;
            }

            // Validate File Size
            if (file.size > maxSize) {
                Swal.fire('Validation Error', 'File size should not exceed 2MB.', 'error');
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
            $('#ebookForm').submit();
        });
    </script>
@endsection
