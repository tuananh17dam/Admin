<header id="page-topbar">
    <div class="navbar-header" style="background-color: azure;">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color: azure;">
                <a href="{{url('/index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="build/images/logo-01.png" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="build/images/logo-01.png" alt="" height="24"> <span class="logo-txt">Tuan Anh</span>
                    </span>
                </a>


            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars">

                </i>
            </button>


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">

                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item right-bar-toggle me-2">
                    <i data-feather="settings" class="icon-lg"></i>
                </button>
            </div> -->

            <!-- nut an cua tai khoan -->
            <div class="dropdown d-inline-block">
                <button type="button" style="background-color: azure;"
                    class="btn header-item topbar-light"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::check()) <!-- Kiểm tra xem người dùng đã đăng nhập chưa -->
                    <img class="rounded-circle header-profile-user"
                        src="{{ Auth::user()->avatar ? asset('build/images/users/' . Auth::user()->avatar) : asset('build/images/logo-01.png') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->name }}</span>
                    @else
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset('build/images/users/avatar-1.jpg') }}" alt="Default Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">Guest</span> <!-- Hiển thị "Guest" nếu chưa đăng nhập -->
                    @endif

                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-end" style="background-color: azure;">
                    <!-- item-->
                    <!-- <a class="dropdown-item" href="#!"><i
                            class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item text-danger" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="mdi mdi-logout font-size-16 align-middle me-1"></i> <span key="t-logout">Log
                            Out</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>