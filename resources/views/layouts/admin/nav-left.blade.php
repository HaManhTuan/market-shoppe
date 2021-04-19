<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}" href="{{ url('admin/dashboard') }}"  aria-expanded="false"><i class="fas fa-chart-area"></i>Dashboard</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('admin/user/view')) ? 'active' : '' || (request()->is('admin/user/roles')) ? 'active' : '' 
                            || (request()->is('admin/user/permissions')) ? 'active' : ''}}" href="#" data-toggle="collapse"
                        aria-expanded="false" data-target="#submenu-1"  aria-expanded="false">
                        <i class="fa fa-fw fa-user-circle"></i>User</a>
                        <div id="submenu-1" class="collapse submenu {{ (request()->is('admin/user/view')) ? 'show' : '' || (request()->is('admin/user/roles')) ? 'show' : '' 
                            || (request()->is('admin/user/permissions')) ? 'show' : ''}} " style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('admin/user/view')) ? 'active' : '' }}" href="{{ url('admin/user/view') }}">User</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('admin/user/roles')) ? 'active' : '' }}" href="{{ url('admin/user/roles') }}">Role</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('admin/user/permissions')) ? 'active' : '' }}" href="{{ url('admin/user/permissions') }}">Permission</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/category/view-category')) ? 'active' : '' }}" href="{{ url('admin/category/view-category') }}"  aria-expanded="false">
                        <i class="fas fa-barcode"></i>Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/product/view-product')) ? 'active' : '' }}" href="{{ url('admin/product/view-product') }}"  aria-expanded="false">
                        <i class="fas fa-bus"></i>Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/order/view')) ? 'active' : '' }}" href="
                            {{ url('admin/order/view') }}"  aria-expanded="false">
                        <i class="fas fa-dolly-flatbed"></i>Đơn hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/customer/view')) ? 'active' : '' }}" href="
                            {{ url('admin/customer/view') }}"  aria-expanded="false">
                        <i class="fas fa-user-plus"></i>Khách hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/blog/view-blog')) ? 'active' : '' }}" href="{{ url('admin/blog/view-blog') }}"  aria-expanded="false">
                        <i class="far fa-newspaper"></i>Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/brand/view-brand')) ? 'active' : '' }}" href="
                            {{ url('admin/brand/view-brand') }}"  aria-expanded="false">
                        <i class="fab fa-accusoft"></i>Thương hiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" 
                        data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-gavel"></i>
                        Cấu hình</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/media/view-media') }}">Hình ảnh</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/config/view-config') }}">Nội dung</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/landingpage/view') }}">Landing Page</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/contact/view')) ? 'active' : '' }}" href="
                            {{ url('admin/contact/view') }}"  aria-expanded="false">
                        <i class="fab fa-weixin"></i>Liên hệ</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
