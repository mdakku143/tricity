@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Home Banner</h4>
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
                        <div class="text-end mb-2">
                            <a href="{{ route('admin.home-banner-form') }}"
                                class="btn btn-sm btn-soft-success waves-effect waves-light">Add Home Banner</a>
                        </div>
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>Sub Title</th>
                                        <th>Banner</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (isset($homeData) && count($homeData) > 0)
                                        @php
                                            $n = 1;
                                        @endphp
                                        @foreach ($homeData as $home)
                                            <tr>
                                                <td>{{ $n++ }}</td>
                                                <td>{{ $home->title }}</td>
                                                <td>{{ $home->sub_title ?? 'NA' }}</td>
                                                <td>
                                                    @if (isset($home->image))
                                                        <img src="{{ asset('admin/assets/images/homebanner/' . $home->image) }}"
                                                            width="100px" height="50px" alt="home_banner">
                                                    @else
                                                        {{ 'NA' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($home->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">De-Active</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-success waves-effect waves-light edit-btn"
                                                        title="Edit"
                                                        href="{{ route('admin.home-banner-edit', $home->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @if ($home->status == '1')
                                                        <a href="javascript:void(0);" title="De-Active"
                                                            class="btn btn-sm btn-warning changeStatus" data-status="0"
                                                            data-id="{{ $home->id }}">
                                                            <i class="fa fa-ban"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0);" title="Active"
                                                            class="btn btn-sm btn-primary changeStatus" data-status="1"
                                                            data-id="{{ $home->id }}">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    @endif
                                                    <a class="btn btn-sm btn-danger deleteCategory" title="Delete"
                                                        data-id="{{ $home->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>

@endsection

@section('script')
    @parent
    <script>
        function changeStatus(id, status) {
            $.ajax({
                url: "{{ route('admin.home-banner-status') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    window.location = "{{ route('admin.home-banner') }}";
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
        $('.changeStatus').on('click', function() {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            Swal.fire({
                title: 'Updating status',
                text: 'Please wait...',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            changeStatus(id, status);
        });


        $(document).on('click', '.deleteCategory', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleting',
                        text: 'Please wait...',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    $.ajax({
                        url: appUrl + "/admin/home-banner-delete",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id
                        },
                        success: function(response) {
                            console.log(response.success);
                            if (response.success == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Data deleted successfully!',
                                });
                                window.location = "{{ route('admin.home-banner') }}";
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'An error occurred while deleting data!',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while deleting data!',
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
