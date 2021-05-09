<footer id="footer">
    <div class="container">
           <!-- introduce-box -->
           <div id="introduce-box" class="row">
               <div class="col-md-4">
                   <div id="address-box">
                       <a href="#"><img src="{{ asset('uploads/images/config/'.$dataConfig->logo) }}" alt="logo" /></a>
                       <div id="address-list">
                           <div class="tit-name">Địa chỉ:</div>
                           <div class="tit-contain">{{$dataConfig->address}}.</div>
                           <div class="tit-name">Liên hệ:</div>
                           <div class="tit-contain">{{$dataConfig->phone}}</div>
                           <div class="tit-name">Email:</div>
                           <div class="tit-contain">{{$dataConfig->email}}</div>
                       </div>
                   </div>
               </div>
               <div class="col-md-6">
                    <div class="row">
                       <div class="col-sm-4">
                           <div class="introduce-title">Gian hàng</div>
                           <ul id="introduce-company"  class="introduce-list">
                               <li><a href="{{ url('/contact-product') }}">Đăng kí gian hàng</a></li>
                           </ul>
                       </div>
                       <div class="col-sm-4">
                           <div class="introduce-title">Tài khỏan</div>
                           <ul id = "introduce-Account" class="introduce-list">
                               <li><a href="{{ url('/dang-nhap') }}">Tài khoản của bạn</a></li>
                           </ul>
                       </div>
                       <div class="col-sm-4">
                           <div class="introduce-title">Hỗ trợ</div>
                           <ul id = "introduce-support"  class="introduce-list">
                               <li><a href="{{ url('/contact') }}">Liên hệ với chúng tôi</a></li>
                           </ul>
                       </div>
                   </div>
               </div>
               <div class="col-md-3">
                   <div id="contact-box">
                       <div class="introduce-title">Let's Socialize</div>
                       <div class="social-link">
                           <a href="#"><i class="fa fa-facebook"></i></a>
                           <a href="#"><i class="fa fa-pinterest-p"></i></a>
                           <a href="#"><i class="fa fa-vk"></i></a>
                           <a href="#"><i class="fa fa-twitter"></i></a>
                           <a href="#"><i class="fa fa-google-plus"></i></a>
                       </div>
                   </div>

               </div>
           </div><!-- /#introduce-box -->

           <div id="footer-menu-box">
               <div class="col-sm-12">
                   <ul class="footer-menu-list">

                   </ul>
               </div>
           </div><!-- /#footer-menu-box -->
       </div>
</footer>
