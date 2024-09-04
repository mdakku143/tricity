@extends('admin.layout.app')
@section('title', 'PHP News - Admin - Main Menu')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Create Main Menu</h4>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Main Menu</li>
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
            <div class="card">
                <div class="card-body">
                    <form id="MenuForm" action="{{ route('admin.main-menu-store') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Name<span class="impStar"> *</span></label>
                                        <input class="form-control" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Slug<span class="impStar"> *</span></label>
                                        <input class="form-control" type="text" name="slug" id="slug"
                                            placeholder="slug in english" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Status :</label>
                                        <select class="form-control form-select" name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">De-Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label for="">&nbsp;</label>
                            <center class="mt-2">
                                <a href="{{ route('admin.main-menu') }}"
                                    class="btn btn-sm btn-secondary waves-effect waves-light">Cancel</a>
                                <button type="submit" id="MenuSubmit" class="btn btn-sm btn-primary">
                                    Save
                                </button>
                            </center>
                        </div>

                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
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
    </script>
@endsection
