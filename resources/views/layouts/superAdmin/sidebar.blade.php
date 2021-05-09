<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Trang chủ</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="navbar-light.htm">
                    <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">Hệ thống</span>
                    <span class="pcoded-badge label label-danger">100+</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('manager.email') }}">
                            <span class="pcoded-mtext">Email</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ url('manager/view-config') }}">
                            <span class="pcoded-mtext">Cấu hình</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="widget-data.htm">
                            <span class="pcoded-mtext">Bình luận</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Quản lý</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="#">
                    <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                    <span class="pcoded-mtext">Danh mục</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('manager.category') }}">
                            <span class="pcoded-mtext">Chính</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('manager.category.draff') }}">
                            <span class="pcoded-mtext">Chờ xác nhận</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('manager.product') }}">
                    <span class="pcoded-micon"><i class="feather icon-gitlab"></i></span>
                    <span class="pcoded-mtext">Sản phẩm</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('manager.brand') }}">
                    <span class="pcoded-micon"><i class="feather icon-command"></i></span>
                    <span class="pcoded-mtext">Thương hiệu</span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('manager/media/view-media') }}">
                    <span class="pcoded-micon"><i class="feather icon-package"></i></span>
                    <span class="pcoded-mtext">Hình ảnh</span>
                </a>
            </li>
            <li class=" ">
                <a href="{{ route('manager.stalls') }}">
                    <span class="pcoded-micon"><i class="feather icon-aperture rotate-refresh"></i></span>
                    <span class="pcoded-mtext">Quản lý gian hàng</span>
                </a>
            </li>
            <li class=" ">
                <a href="{{ url('manager/contact/view') }}">
                    <span class="pcoded-micon"><i class="feather icon-cpu"></i></span>
                    <span class="pcoded-mtext">Liên hệ</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
