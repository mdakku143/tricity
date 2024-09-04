<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="#" class="logo-light">
            <img src="{{ asset('/admin/assets/images/logo.jpg') }}" alt="logo" class="logo-lg" height="40">
            <img src="{{ asset('/admin/assets/images/favicon.jpg') }}" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a href="#" class="logo-dark">
            <img src="{{ asset('/admin/assets/images/logo.jpg') }}" alt="logo" class="logo-lg" height="40">
            <img src="{{ asset('/admin/assets/images/favicon.jpg') }}" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">
            <li class="menu-title"></li>
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text">Dashboard</span>
                    {{-- <span class="badge bg-primary rounded ms-auto">01</span> --}}
                </a>
            </li>
            @if (Auth::guard('web')->check())
                {{-- #Main Menu --}}
                <li class="menu-item">
                    <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="mdi mdi-menu"></i></span>
                        <span class="menu-text">Master</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuExpages">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{ route('admin.main-menu') }}" class="menu-link">
                                    <span class="menu-text">Main Menu</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.states') }}" class="menu-link">
                                    <span class="menu-text">State</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.cities') }}" class="menu-link">
                                    <span class="menu-text">City</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Home Banner --}}
                <li class="menu-item">
                    <a href="{{ route('admin.home-banner') }}" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bxs-flag"></i></span>
                        <span class="menu-text">Home Banner</span>
                    </a>
                </li>
                {{-- News --}}
                <li class="menu-item">
                    <a href="{{ route('admin.news') }}" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-news"></i></span>
                        <span class="menu-text">News</span>
                    </a>
                </li>

                {{-- Reporter --}}
                <li class="menu-item">
                    <a href="{{ route('admin.reporters') }}" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                        <span class="menu-text">Reporters</span>
                    </a>
                </li>
                {{-- E-books --}}
                <li class="menu-item">
                    <a href="{{ route('admin.ebooks') }}" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                        <span class="menu-text">E-books</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
