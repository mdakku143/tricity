<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'PHM- Reporter Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="ITS - The Education Group" name="description" />
    <meta content="ITS - The Education Group" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('style')
        @include('reporter.layout.style')
    @show
</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        @include('reporter.layout.sidebar')




        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            @include('reporter.layout.navbar')
            <!-- ========== Topbar End ========== -->

            <div class="px-3">

                <!-- Start Content-->
                @yield('content')
                <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            @include('reporter.layout.footer')

            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @section('script')
        @include('reporter.layout.script')

        {{-- <script>
            if ($.fn.DataTable.isDataTable('#basic-datatable')) {
                $('#basic-datatable').DataTable().destroy();
            }
            $('#basic-datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csv',
                    exportOptions: {
                        modifier: {
                            selected: null // Export all records
                        },
                        columns: ':not(:last-child)'
                    }
                }]
            });
        </script> --}}
    @show

</body>

</html>
