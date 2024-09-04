<div class="navbar-custom">
    <div class="topbar">
        <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="#" class="logo-light">
                    <img src="{{ asset('/admin/assets/images/logo.svg') }}" alt="logo" class="logo-lg" height="22">
                    <img src="{{ asset('/admin/assets/images/logo.svg') }}" alt="small logo" class="logo-sm"
                        height="22">
                </a>

                <!-- Brand Logo Dark -->
                <a href="#" class="logo-dark">
                    <img src="{{ asset('/admin/assets/images/logo.svg') }}" alt="dark logo" class="logo-lg"
                        height="22">
                    <img src="{{ asset('/admin/assets/images/logo.svg') }}" alt="small logo" class="logo-sm"
                        height="22">
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-4">

            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen font-size-24"></i>
                </a>
            </li>


            {{-- <li class="nav-link" id="theme-mode">
                <i class="bx bx-moon font-size-24"></i>
            </li> --}}

            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('/admin/assets/images/users/avatar-4.jpg') }}" alt="user-image"
                        class="rounded-circle">
                    <span class="ms-1 d-none d-md-inline-block">
                        {{-- @dd(Auth::user()) --}}
                        {{ Auth::user()->name ?? 'Name Not Set' }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Lock Screen</span>
                    </a> --}}

                    <div class="dropdown-divider"></div>

                    {{-- <!-- item-->
                    <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a> --}}

                    <a class="dropdown-item" href="{{ route('reporter.logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('reporter.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>

        </ul>
    </div>
</div>
