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
                        <a class="nav-link"  href="{{ url('admin/dashboard') }}"  aria-expanded="false"><i class="fas fa-chart-area"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/product/view-product') }}"  aria-expanded="false">
                        <i class="fas fa-bus"></i>Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="
                            {{ url('admin/order/view') }}"  aria-expanded="false">
                        <i class="fas fa-dolly-flatbed"></i>Đơn hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="
                            {{ url('admin/comment/view') }}"  aria-expanded="false">
                        <i class="fas fa-dolly-flatbed"></i>Bình luận</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="
                            {{ url('admin/customer/view') }}"  aria-expanded="false">
                        <i class="fas fa-user-plus"></i>Khách hàng</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
