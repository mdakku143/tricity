@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Edit Home Banner</h4>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Home Banner</li>
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
                        <form id="homeBannerForm" action="{{ route('admin.home-banner-update') }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Title <span class="impStar"> *</span></label>
                                        <input class="form-control" type="text" name="title" id="title"
                                            value="{{ $data->title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Sub Title <span class="impStar"> *</span></label>
                                        <input class="form-control" type="text" name="sub_title" id="sub_title"
                                            value="{{ $data->sub_title }}" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Upload File</label>
                                        <input class="form-control" type="file" name="image" id="image">
                                        @if (isset($data->image))
                                            <a class="viewFile"
                                                href="{{ asset('admin/assets/images/homebanner/' . $data->image) }}"
                                                target="_blank">View File</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Status :</label>
                                        <select class="form-control form-select" name="status" id="status" required>
                                            <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="2" {{ $data->status == 0 ? 'selected' : '' }}>De-Active
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group">
                                    <a href="{{ route('admin.home-banner') }}"
                                        class="btn btn-sm btn-secondary waves-effect waves-light">Cancel</a>
                                    <button type="submit" id="homeBannerSubmit" class="btn btn-sm btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
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

            $('#homeBannerSubmit').click(function(e) {
                e.preventDefault();
                // Custom validation
                // var title = $('#Title').val();
                // var subTitle = $('#SubTitle').val();

                // // Perform your custom validation here
                // if (title.trim() === '') {
                //     alert('Please enter Title');
                //     return;
                // }

                // if (subTitle.trim() === '') {
                //     alert('Please enter Sub Title');
                //     return;
                // }

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
                $('#homeBannerForm').submit();
            });
        });
    </script>
@endsection
