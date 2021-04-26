<div class="em-wrapper-header">
    <div id="em-mheader" class="visible-xs container">
    <div id="em-mheader-top" class="row">
        <div id="em-mheader-logo" class="col-xs-4">
            <div class="em-logo"><a href="index.html" title="Fashion Commerce" class="logo"><strong>Fashion Commerce</strong><img src="{{ asset('frontend/images/logo_small.png')}}" alt="Fashion Commerce" /></a>
            </div>
        </div><!-- /#em-mheader-logo -->
        <div class="col-xs-20">
            <div class="em-top-search">
                <div class="em-header-search-mobile">
                    <form method="get">
                        <div class="form-search no_cate_search">
                            <div class="text-search">
                                <input id="search-mobile" type="text" name="q" value="" class="input-text" maxlength="128" />
                                <button type="submit" title="Search" class="button"><span><span>Search</span></span>
                                </button>
                                <div id="search_autocomplete_mobile" class="search-autocomplete"></div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.em-header-search-mobile -->
            </div><!-- /.em-top-search -->
            <div class="em-top-cart">
                <div class="em-wrapper-topcart-mobile em-no-quickshop">
                    <div class="em-container-topcart">
                        <div class="em-summary-topcart">
                            <a id="em-amount-cart-link" title="Shopping Cart" class="em-amount-topcart" href="cart.html"> <span class="em-topcart-text">My Cart:</span> <span class="em-topcart-qty">0</span> </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.em-top-cart -->
            <div id="em-mheader-wrapper-menu"> <span class="visible-xs fa fa-bars" id="em-mheader-menu-icon"></span>
                <div id="em-mheader-menu-content" style="display: none;">
                    <div class="em-wrapper-top">
                        <div class="em-language-currency row">
                            <div class="col-sm-24">
                                <div class="form-language em-language-style-mobile">
                                    <ul>
                                        <li class="selected">
                                            <a href="#" title="English"> <img alt="english" src="{{ asset('frontend/images/language/english.png')}}" /> </a>
                                        </li>
                                        <li class="">
                                            <a href="#" title="French"> <img alt="french" src="{{ asset('frontend/images/language/french.png')}}" /> </a>
                                        </li>
                                        <li class="">
                                            <a href="#" title="German"> <img alt="german" src="{{ asset('frontend/images/language/german.png')}}" /> </a>
                                        </li>
                                    </ul>
                                </div><!-- /.form-language -->
                                <div class="em-currency-style-mobile">
                                    <ul class="list-inline">
                                        <li class=""> <a href="#"> AUD </a>
                                        </li>
                                        <li class=""> <a href="#"> EUR </a>
                                        </li>
                                        <li class=" selected"> <a href="#"> USD </a>
                                        </li>
                                    </ul>
                                </div><!-- /.em-currency-style-mobile -->
                            </div>
                        </div><!-- /.em-language-currency -->
                        <div class="em-top-links row">
                            <div class="">
                                <ul class="top-header-link links">
                                    <li class="first col-xs-8"> <a title="Log In" class="login-link fa fa-user" href="#"><span>Log In</span></a>
                                    </li>
                                    <li class="col-xs-8"> <a title="Sign up" class='signup-link fa fa-sign-out' href="#"><span>Sign up</span></a>
                                    </li>
                                    <li class="last col-xs-8"> <a href="#" class="checkout-link fa fa-shopping-cart"><span>Cart</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.em-top-links -->
                    </div><!-- /.em-wrapper-top -->
                    <div class="row mobile-main-menu toggle-menu">
                        <div class="col-sm-24">
                            <div class="em-top-menu">
                                <div class="em-menu-mobile">
                                    <div class="megamenu-wrapper wrapper-7_5505">
                                        <div class="em_nav" id="toogle_menu_7_5505">

                                        </div>
                                    </div><!-- /.megamenu-wrapper -->
                                </div>
                            </div><!-- /.em-top-menu -->
                        </div>
                    </div><!-- /.mobile-main-menu -->
                    <div class="row mobile-block">
                        <div class="col-sm-24">
                            <ul class="em-mobile-help">
                                <li><a href="#" target="_blank"><span class="fa fa-download">&nbsp;</span>Download App</a>
                                </li>
                                <li><a href="#"><span class="fa fa-question-circle">&nbsp;</span>Help Center</a>
                                </li>
                                <li><a href="#"><span class="fa fa-star">&nbsp;</span>Feedback</a>
                                </li>
                                <li><a href="#"><span class="fa fa-comment-o">&nbsp;</span>Blog</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.mobile-block -->
                </div>
            </div><!-- /.em-mheader-wrapper-menu -->
        </div>
    </div><!-- /#em-mheader-top -->
    </div><!-- /#em-mheader -->
    <div class="hidden-xs em-header-style08">
        <div class="em-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-24">
                        <div class="f-left">
                            <div class="em-language-currency">
                                <div class="form-language toolbar-switch em-language-style01">
                                    <div class="toolbar-title">
                                        <select id="em-hoverUl-language" title="Your Language">
                                            <option value="English" selected="selected">English</option>
                                            <option value="French">French</option>
                                            <option value="German">German</option>
                                        </select>
                                    </div>
                                </div><!-- /.em-language-style01 -->
                                <div class="toolbar-switch em-currency-style01">
                                    <div class="toolbar-title">
                                        <select id="em-hoverUl-currency" name="currency" title="Select Your Currency" onchange="setLocation(this.value)">
                                            <option value="AUD"> AUD</option>
                                            <option value="EUR"> EUR</option>
                                            <option value="USD" selected="selected"> USD</option>
                                        </select>
                                    </div>
                                </div><!-- /.em-currency-style01 -->
                            </div><!-- /.em-language-currency -->
                        </div><!-- /.f-left -->
                        <div class="">
                            <div class="em-search f-right">
                                <div class="em-top-search">
                                    <div class="em-wrapper-js-search em-search-style01">
                                        <div class="em-wrapper-search em-no-category-search"> <a class="em-search-icon" title="Search" href="javascript:void(0);"><span>Search</span></a>
                                            <div class="em-container-js-search" style="display: none;">
                                                <form id="search_mini_form" method="get">
                                                    <div class="form-search no_cate_search">
                                                        <div class="text-search">
                                                            <label for="search">Search:</label>
                                                            <input id="search" type="text" name="q" value="" class="input-text" maxlength="128" placeholder="Search entire store here..." />
                                                            <button type="submit" title="Search" class="button"><span><span>Search</span></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form><!-- /#search_mini_form -->
                                            </div>
                                        </div>
                                    </div><!-- /.em-wrapper-js-search -->
                                </div>
                            </div><!-- /.em-search -->
                            <div class="em-top-links">
                                <div class="f-right"></div>
                                <div class="f-right">
                                    <ul class="em-links-wishlist">
                                        <li class="first last"><a href="wishlist.html" title="Wishlist">Wishlist</a></li>
                                    </ul>
                                </div>
                                <ul class="list-inline f-right">
                                    <li><a class="em-register-link" href="register.html" title="Register">Register</a></li>
                                </ul>
                                <div id="em-login-link" class="account-link f-right em-non-login">
                                    <a href="login.html" class="link-account" id="link-login" title="Login">Login</a>
                                    <div class="em-account" id="em-account-login-form" style="display: none;">
                                        <form method="post" id="top-login-form">
                                            <input name="form_key" type="hidden" value="LqnwQyvcDpOju7G3" />
                                            <div class="block-content">
                                                <p class="login-title h6 primary">Login</p>
                                                <p class="login-desc">If you have an account with us, please log in.</p>
                                                <ul class="form-list">
                                                    <li>
                                                        <label for="mini-login">Email Address<em>*</em>
                                                        </label>
                                                        <input type="text" name="login[username]" id="mini-login" class="input-text required-entry validate-email" />
                                                    </li>
                                                    <li>
                                                        <label for="mini-password">Password<em>*</em>
                                                        </label>
                                                        <input type="password" name="login[password]" id="mini-password" class="input-text required-entry validate-password" />
                                                    </li>
                                                    <li><span class="required">* Required Fields</span>
                                                    </li>
                                                </ul>
                                                <div class="action-forgot">
                                                    <div class="login_forgotpassword">
                                                        <p><a href="#">Forgot Your Password?</a>
                                                        </p>
                                                        <p><span>Don't have an account?</span><a class="create-account-link-wishlist" href="h.html#" title="Sign Up">Sign Up</a>
                                                        </p>
                                                    </div>
                                                    <div class="actions">
                                                        <button type="submit" class="button"><span><span>Login</span></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form><!-- /#top-login-form -->
                                    </div><!-- /#em-account-login-form -->
                                </div><!-- /#em-login-link -->
                            </div><!-- /.em-top-links -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.em-header-top -->
        <div class="em-header-bottom">
            <div class="container em-menu-fix-pos">
                <div class="row">
                    <div class="col-sm-24">
                        <div class="em-logo f-left"><a href="index.html" title="Fashion Commerce" class="logo"><strong>Fashion Commerce</strong><img class="retina-img" src="{{ asset('frontend/images/logo.png')}}" alt="Fashion Commerce" /></a>
                        </div>
                        <div class="em-top-cart-sticky em-top-cart f-right">
                            <div class="em-wrapper-js-topcart em-wrapper-topcart em-no-quickshop">
                                <div class="em-container-topcart">
                                    <div class="em-summary-topcart">
                                        <a class="em-amount-js-topcart em-amount-topcart" title="Shopping Cart" href="cart.html"> <span class="em-topcart-text">My Cart:</span> <span class="em-topcart-qty">0</span> </a>
                                    </div>
                                    <div class="em-container-js-topcart topcart-popup" style="display:none">
                                        <div class="topcart-popup-content">
                                            <p class="em-block-subtitle">Shopping Cart</p>
                                            <div class="topcart-content">
                                                <p class="amount-content "> You have no items in your shopping cart.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.em-wrapper-js-topcart -->
                        </div><!-- /.em-top-cart -->
                        <div class="em-menu-hoz f-right col-md-18">
                            <div id="em-main-megamenu">
                                <div class="em-menu">
                                    <div class="megamenu-wrapper wrapper-4_7164">
                                        <div class="em_nav" id="toogle_menu_4_7164">
                                            <div class="shopee-searchbar__main">
                                                <form role="search" class="shopee-searchbar-input" autocomplete="off">
                                                    <input aria-label="Deal 0Đ cho phái đẹp" class="shopee-searchbar-input__input" maxlength="128" placeholder="Áo thun Nam" autocomplete="off" value="">
                                                </form>
                                                <button type="button" class="btn btn-solid-primary btn--s btn--inline">
                                                    <svg height="19" viewBox="0 0 19 19" width="19" class="shopee-svg-icon ">
                                                        <g fill-rule="evenodd" stroke="none" stroke-width="1">
                                                            <g transform="translate(-1016 -32)">
                                                                <g>
                                                                    <g transform="translate(405 21)">
                                                                        <g transform="translate(611 11)">
                                                                            <path d="m8 16c4.418278 0 8-3.581722 8-8s-3.581722-8-8-8-8 3.581722-8 8 3.581722 8 8 8zm0-2c-3.3137085 0-6-2.6862915-6-6s2.6862915-6 6-6 6 2.6862915 6 6-2.6862915 6-6 6z"></path>
                                                                            <path d="m12.2972351 13.7114222 4.9799555 4.919354c.3929077.3881263 1.0260608.3842503 1.4141871-.0086574.3881263-.3929076.3842503-1.0260607-.0086574-1.414187l-4.9799554-4.919354c-.3929077-.3881263-1.0260608-.3842503-1.4141871.0086573-.3881263.3929077-.3842503 1.0260608.0086573 1.4141871z"></path>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div><!-- /.em_nav -->
                                    </div><!-- /.megamenu-wrapper -->
                                </div><!-- /.em-menu -->
                            </div><!-- /#em-main-megamenu -->
                        </div><!-- /.em-menu-hoz -->
                    </div>
                </div>
            </div><!-- /.container -->
        </div><!-- /.em-header-bottom -->
    </div>
</div>
<style>
.shopee-searchbar-input, .shopee-searchbar__main {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -moz-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
}
.shopee-searchbar-input {
    background-color: #fff;
    border-color: #fff;
}
.shopee-searchbar-input {
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    padding-left: .625rem;
}
.shopee-searchbar-input__input {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -moz-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -moz-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    outline: none;
    border: none;
    padding: 0;
    margin: 0;
    line-height: normal;
}
.shopee-searchbar>.btn-solid-primary {
    background: #fb5533;
}
.btn-solid-primary {
    color: #fff;
    background: #ee4d2d;
}
.btn--s {
    height: 34px;
    padding: 0 15px;
    min-width: 60px;
    max-width: 190px;
}
</style>
