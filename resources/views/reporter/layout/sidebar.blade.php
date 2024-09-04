<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="#" class="logo-light">
            <img src="{{ asset('/admin/assets/images/tricity-logo.png') }}" alt="logo" class="logo-lg" height="40">
            <img src="{{ asset('/admin/assets/images/favicon.png') }}" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a href="#" class="logo-dark">
            <img src="{{ asset('/admin/assets/images/logo.svg') }}" alt="dark logo" class="logo-lg" height="28">
            <img src="{{ asset('/admin/assets/images/logo.svg') }}" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    @if (Auth::guard('web')->check())
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

                {{-- Reporter --}}
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
            </ul>
        </div>
    @endif
</div>
