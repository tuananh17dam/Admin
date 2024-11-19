<!-- ========== Left Sidebar Start ========== -->

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="vertical-menu border-end" style="background-color: light;">
    <div data-simplebar class="h-100">
        <!-- Sidebar Menu -->
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title text-center" style="color: #0077be; font-size: 1.75rem;">
                    Menu
                </li>

                <!-- Home -->
                <li>
                    <a href="{{url('/index')}}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="home" class="me-2 icon-lg icon-static"></i>
                        <span>Trang chủ</span>
                    </a>
                </li><br>

                <!-- Admin Links -->
                @if(auth()->user()->role === 'admin')
                <li>
                    <a href="{{ url('/don-hang') }}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="shopping-cart" class="me-2 icon-lg icon-static"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li><br>
                <li>
                    <a href="{{ url('/san-pham') }}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="box" class="me-2 icon-lg icon-static"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li><br>
                <li>
                    <a href="{{ url('khach-hang') }}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="users" class="me-2 icon-lg icon-static"></i>
                        <span>Khách hàng</span>
                    </a>
                </li><br>
                <li>
                    <a href="{{ url('/user') }}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="user-check" class="me-2 icon-lg icon-static"></i>
                        <span>Tài khoản bán hàng</span>
                    </a>
                </li><br>
                <li>
                    <a href="{{ url('/thong-ke') }}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="bar-chart-2" class="me-2 icon-lg icon-static"></i>
                        <span>Thống kê</span>
                    </a>
                </li>
                @endif

                <!-- Seller Links -->
                @if(auth()->user()->role === 'seller')
                <li>
                    <a href="{{ url('donhang-seller') }}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="shopping-cart" class="me-2 icon-lg icon-static"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li><br>
                <li>
                    <a href="{{ url('/san-pham') }}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="box" class="me-2 icon-lg icon-static"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li><br>
                <li>
                    <a href="{{ url('/khach-hang') }}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="users" class="me-2 icon-lg icon-static"></i>
                        <span>Khách hàng</span>
                    </a>
                </li><br>
                <li>
                    <a href="{{ url('/thong-ke') }}" class="btn-sidebar d-flex align-items-center px-3 py-2 text-decoration-none">
                        <i data-feather="bar-chart-2" class="me-2 icon-lg icon-static"></i>
                        <span>Thống kê</span>
                    </a><br>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->

<style>
    .vertical-menu {
        width: 250px;
    }

    .btn-sidebar {
        color: black !important; /* Đảm bảo chữ luôn là đen */
        font-size: 1.1rem;
        font-weight: 500;
        background-color: white;
        border-radius: 8px;
    }

    .btn-sidebar:hover,
    .btn-sidebar.active,
    .btn-sidebar:focus {
        color: black !important; /* Đảm bảo chữ luôn là đen khi hover, active, focus */
        background-color: #00FFFF;
    }

    .icon-lg {
        font-size: 1.3em;
    }

    .icon-static {
        color: inherit !important; /* Giữ màu của icon theo màu mặc định */
    }

    .menu-title {
        color: #0077be;
        font-size: 1.75rem;
    }

    .sidebar-menu {
        background-color: white;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        feather.replace();
    });
</script>
