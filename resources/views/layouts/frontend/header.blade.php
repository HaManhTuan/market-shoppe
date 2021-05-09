<div id="header" class="header">
    <div class="top-header">
        <div class="container">
            <div class="nav-top-links">
                <a href="{{ url('/contact') }}"><img alt="email" src="{{ asset('frontend/assets/images/email.png') }}" />Liên hệ !</a>
                <a href="{{ url('/contact-product') }}"><img alt="phone" src="{{ asset('frontend/assets/images/phone.png') }}" />Đăng kí gian hàng !</a>
            </div>

            <div class="support-link">
                {{-- @foreach ($dataLandingHeader as $element)
                   <a href="{{ url('/introl/'.$element->url) }}">{{$element->name}}</a>
                @endforeach --}}


            </div>
             @if(Auth::guard('customers')->check())
                <div id="user-info-top" class="user-info pull-right">
                    <div class="dropdown">
                        <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span>{{Auth::guard('customers')->user()->name}}</span></a>
                        <ul class="dropdown-menu mega_dropdown" role="menu">
                            <li><a href="{{ url('/account') }}">Tài khoản</a></li>
                            <li><a href="{{ url('/dang-xuat') }}">Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
             @else
                <div id="user-info-top" class="user-info pull-right">
                    <div class="dropdown">
                        <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span>Tài khoản</span></a>
                        <ul class="dropdown-menu mega_dropdown" role="menu">
                            <li><a href="{{ url('/dang-nhap') }}">Đăng nhập</a></li>
                        </ul>
                    </div>
                </div>
             @endif
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div class="container main-header">
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo">
                <a href="{{ url('/') }}"><img alt="Kute Shop" src="{{ asset('uploads/images/config/'.$dataConfig->logo) }}" /></a>
            </div>
            <div class="col-xs-7 col-sm-7 header-search-box">
                <form class="form-inline" action="{{ url('/search') }}" method="GET">
                      <div class="form-group input-serach">
                        <input type="text" name="key" placeholder="Nhập từ khóa...">
                      </div>
                      <button type="submit" class="pull-right btn-search"></button>
                </form>
            </div>
            <div class="col-xs-5 col-sm-2 group-button-header">
                <div class="btn-cart" id="cart-block">
                    @if (isset($cart_data) && count($cart_data) > 0)
                        <a title="My cart" href="{{ url('/view-cart') }}">Giỏ hàng</a>
                        <span class="notify notify-right">{{ $count_cart }}</span>
                        <div class="cart-block">
                            <div class="cart-block-content">
                                <h5 class="cart-title">{{ $count_cart}} sản phẩm trong giỏ hàng</h5>
                                <div class="cart-block-list">
                                    <ul>
                                        @foreach ($cart_data as $element)
                                            <li class="product-info">
                                                <div class="p-left">
                                                    <a href="#" class="remove_link"></a>
                                                    <a href="#">
                                                    <img class="img-responsive" src="{{ asset('uploads/images/products/'.$element->attributes->avatar) }}" alt="p10">
                                                    </a>
                                                </div>
                                                <div class="p-right">
                                                    <p class="p-name">{{$element->name}}</p>
                                                    <p class="p-rice">{{number_format($element->price)}}</p>
                                                    <p>Qty: {{$element->quantity}}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                </ul>
                                </div>
                                <div class="toal-cart">
                                    <span>Tổng</span>
                                    <span class="toal-price pull-right">{{ number_format($cart_subtotal)}}</span>
                                </div>
                                <div class="cart-buttons">
                                    <a href="{{ url('view-cart') }}" class="btn-check-out">Xem </a>
                                </div>
                            </div>
                        </div>
                    @else
                    <a title="My cart" href="{{ url('/view-cart') }}">Giỏ hàng</a>
                    <span class="notify notify-right">0</span>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-2" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus">
                    <h4 class="title">
                        <span class="title-menu">Kute Shop</span>
                        <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars"></i></span>
                    </h4>
                    <div class="vertical-menu-content is-home">

                       {{--  <div class="all-category"><span class="open-cate">All Categories</span></div> --}}
                    </div>
                </div>
                </div>
                <div id="main-menu" class="col-sm-9 main-menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    @if ($cateRandom)
                                        @foreach ($cateRandom as $item)
                                            <li><a href="{{ url('danh-muc/'.$item['url']) }}">{{ $item->name }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
            </div>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <!-- userinfo on top-->
            <div id="user-info-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>
</div>
<style type="text/css" media="screen">
    .product-info .remove_link:hover{
        color: red !important;
    }
</style>
