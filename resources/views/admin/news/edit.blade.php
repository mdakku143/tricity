@extends('admin.layout.app')
@section('title', 'PHM News - Admin - News Edit')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Edit News</h4>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">News</li>
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
                        <form id="newsForm" action="{{ route('admin.news-update') }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Title <span class="impStar"> *</span></label>
                                        <textarea name="title" id="title" class="form-control">{{ $data->title }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Sub Title <span class="impStar"> *</span></label>
                                        <textarea name="sub_title" id="sub_title" class="form-control">{{ $data->sub_title }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Slug <span class="impStar"> *</span></label>
                                        <textarea name="slug" id="slug" class="form-control">{{ $data->slug }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Reporter :<span class="impStar"> *</span></label>
                                        <select class="form-control form-select" name="reporter_name" id="reporter_name"
                                            required>
                                            <option value="">--Select--</option>
                                            @foreach ($reporterData as $reporter)
                                                <option value="{{ $reporter->id }}"
                                                    {{ $data->reporter_name == $reporter->id ? 'selected' : '' }}>
                                                    {{ $reporter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">News Type<span class="impStar"> *</span></label>
                                        <select class="form-control form-select" name="type" id="type" required>
                                            <option value="1" {{ $data->type == 1 ? 'selected' : '' }}>Normal</option>
                                            <option value="2" {{ $data->type == 2 ? 'selected' : '' }}>Live News
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">News Category<span class="impStar"> *</span></label>
                                        <select class="form-control form-select" name="category" id="category" required>
                                            <option value="">--Select--</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $data->category == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Upload Image <span class="impStar"> *</span></label>
                                        <input class="form-control" type="file" name="image" id="image"
                                            required>
                                        @if ($data->image)
                                            <a target="_blank"
                                                href="{{ asset('admin/assets/images/news/' . $data->image) }}">
                                                View Image
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
                            <div class="row mt-2 d-none" id="liveUpdate">
                                <div class="container">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div id="input-container">
                                                        @if (isset($data->liveNews) && $data->liveNews->isNotEmpty())
                                                            @foreach ($newsDetails as $detail)
                                                                <div class="row mb-2">
                                                                    <div class="col-md-2">
                                                                        <h6 class="form-label">Time</h6>
                                                                        <input type="text" class="form-control type"
                                                                            name="times[]" value="{{ $detail->time }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <h6 class="form-label">Heading</h6>
                                                                        <input type="text"
                                                                            class="form-control headings"
                                                                            name="headings[]"
                                                                            value="{{ $detail->headings }}" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <h6 class="form-label">Sub Heading</h6>
                                                                        <input type="text"
                                                                            class="form-control sub_headings"
                                                                            name="sub_headings[]"
                                                                            value="{{ $detail->sub_headings }}" required>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger mt-4 remove-btn">
                                                                            <i class="fa fa-minus"></i> Remove
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif

                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-info mt-1"
                                                        id="add-btn">
                                                        <i class="fa fa-plus"></i> Add Input
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Meta Seo <span class="impStar"> *</span></label>
                                        <textarea name="meta_seo" id="meta_seo" class="form-control">{{ $data->meta_seo }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Meta Description<span class="impStar"> *</span></label>
                                        <textarea name="meta_desc" id="meta_desc" class="form-control">{{ $data->meta_desc }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Meta Keyword<span class="impStar"> *</span></label>
                                        <textarea name="meta_keyword" id="meta_keyword" class="form-control">{{ $data->meta_keyword }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group">
                                    <label for="">News Content:</label>
                                    <textarea class="form-control itsEdit" name="news_detail" id="editor">{!! $data->news_detail !!}</textarea>
                                </div>
                            </div>
                            <center class="mt-2">
                                <a href="{{ route('admin.news') }}"
                                    class="btn btn-sm btn-secondary waves-effect waves-light">Cancel</a>
                                <button type="submit" id="newsSubmit" class="btn btn-sm btn-primary">
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
            let slugInput = document.getElementById("slug");
            slugInput.addEventListener("blur", function() {
                let slugValue = this.value.trim().toLowerCase();
                let slug = slugValue.replace(/[^a-zA-Z0-9]/g,
                        "-") // Replace all non-alphanumeric characters with hyphens
                    .replace(/-+/g, "-") // Replace multiple hyphens with a single one
                    .replace(/^-|-$/g, ""); // Remove hyphens from the start and end of the string
                this.value = slug;
            });
            slugInput.dispatchEvent(new Event("blur"));
        }
        document.addEventListener("DOMContentLoaded", updateSlug);

        // type change
        document.addEventListener('DOMContentLoaded', function() {
            // Get the type dropdown and liveUpdate div
            let typeDropdown = document.getElementById('type');
            let liveDiv = document.getElementById('liveUpdate');

            // Add change event listener to the dropdown
            typeDropdown.addEventListener('change', function() {
                let typeId = this.value;
                if (typeId == '2') {
                    liveDiv.classList.remove('d-none');
                } else {
                    liveDiv.classList.add('d-none');
                }
            });

            // Trigger the change event on page load to set initial visibility
            typeDropdown.dispatchEvent(new Event('change'));
        });

        $(function() {
            function getCity() {
                const stateId = $('#state').val();
                $('#city').empty();
                $.ajax({
                    url: "{{ route('admin.news-get-city') }}",
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

            function attachRemoveEvent() {
                $('#input-container').on('click', '.remove-btn', function() {
                    $(this).closest('.row').remove();
                    checkMandatoryRows();
                });
            }

            function checkMandatoryRows() {
                if ($('#type').val() === '2' && $('#input-container .row').length === 0) {
                    let newRow = `
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                        <h6 class="form-label">Time</h6>
                                        <input type="text" class="form-control" name="times[]" required>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="form-label">Heading</h6>
                                        <input type="text" class="form-control headings" name="headings[]" required>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="form-label">Sub Heading</h6>
                                        <input type="text" class="form-control sub_headings" name="sub_headings[]" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-sm btn-danger mt-4 remove-btn">
                                            <i class="fa fa-minus"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            `;
                    $('#input-container').append(newRow);
                    attachRemoveEvent();
                }
            }

            $('#add-btn').click(function() {
                let newRow = `
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                        <h6 class="form-label">Time</h6>
                                        <input type="text" class="form-control" name="times[]" required>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="form-label">Heading</h6>
                                        <input type="text" class="form-control headings" name="headings[]" required>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="form-label">Sub Heading</h6>
                                        <input type="text" class="form-control sub_headings" name="sub_headings[]" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-sm btn-danger mt-4 remove-btn">
                                            <i class="fa fa-minus"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            `;
                $('#input-container').append(newRow);
                attachRemoveEvent();
            });

            $('#type').change(function() {
                if ($(this).val() === '2') {
                    $('#liveUpdate').removeClass('d-none');
                    checkMandatoryRows(); // Ensure there is at least one row if type is 2
                } else {
                    $('#liveUpdate').addClass('d-none');
                }
            });

            // Initial check to handle page load scenario
            $('#type').change();

            // Add event listener to dynamically added "Remove" buttons
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-btn')) {
                    event.target.closest('.row').remove();
                }
            });

            $('#newsSubmit').click(function(e) {
                e.preventDefault();

                // Get form values
                let title = $('#title').val();
                let subTitle = $('#sub_title').val();
                let slug = $('#slug').val();
                let reporterName = $('#reporter_name').val();
                let state = $('#state').val();
                let city = $('#city').val();
                let metaSeo = $('#meta_seo').val();
                let metaDesc = $('#meta_desc').val();
                let metaKeyword = $('#meta_keyword').val();
                // let image = $('#image').val();
                // let isVerified = $('#is_verified').val();
                let type = $('#type').val();
                let csrDetails = editors.length > 0 ? editors[0].getData().trim() : '';
                // Perform custom validation

                if (title === '') {
                    Swal.fire('Validation Error', 'Please enter Title.', 'error');
                    return;
                }

                if (subTitle === '') {
                    Swal.fire('Validation Error', 'Please enter Sub Title.', 'error');
                    return;
                }

                if (slug === '') {
                    Swal.fire('Validation Error', 'Please enter Slug.', 'error');
                    return;
                }

                if (reporterName === '') {
                    Swal.fire('Validation Error', 'Please select Reporter.', 'error');
                    return;
                }

                if (state === '') {
                    Swal.fire('Validation Error', 'Please select State.', 'error');
                    return;
                }

                if (city === '') {
                    Swal.fire('Validation Error', 'Please select City.', 'error');
                    return;
                }

                if (metaSeo === '') {
                    Swal.fire('Validation Error', 'Please enter Meta Seo.', 'error');
                    return;
                }

                if (metaDesc === '') {
                    Swal.fire('Validation Error', 'Please enter Meta Description.', 'error');
                    return;
                }

                if (metaKeyword === '') {
                    Swal.fire('Validation Error', 'Please enter Meta Keyword.', 'error');
                    return;
                }

                // if (image === '') {
                //     Swal.fire('Validation Error', 'Please upload an Image.', 'error');
                //     return;
                // }

                if (csrDetails === '') {
                    Swal.fire('Validation Error', 'Please enter News Content.', 'error');
                    return;
                }

                if (type == '2') {
                    // Validate dynamic rows
                    if (!validateAllRows()) {
                        Swal.fire('Validation Error', 'Please fill all headings and sub-headings.',
                            'error');
                        return;
                    }
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
                $('#newsForm').submit();
            });
            // Function to validate individual rows
            function validateRow(row) {
                let heading = $(row).find('.headings').val().trim();
                let subHeading = $(row).find('.sub_headings').val().trim();
                if (heading === '') {
                    return false; // Row is invalid
                }

                if (subHeading === '') {
                    return false; // Row is invalid
                }
                return true; // Row is valid
            }

            // Function to validate all rows
            function validateAllRows() {
                let isValid = true;

                $('#input-container .row').each(function() {
                    if (!validateRow(this)) {
                        isValid = false;
                        return false; // Exit loop on first invalid row
                    }
                });
                return isValid;
            }
        });
    </script>
@endsection
