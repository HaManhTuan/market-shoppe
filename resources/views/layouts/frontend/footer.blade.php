<footer id="footer">
    <div class="container">
           <!-- introduce-box -->
           <div id="introduce-box" class="row">
               <div class="col-md-4">
                   <div id="address-box">
                       <a href="#"><img src="{{ asset('frontend/assets/images/logo2.png') }}" alt="logo" /></a>
                       <div id="address-list">
                           <div class="tit-name">Địa chỉ:</div>
                           {{-- <div class="tit-contain">{{$dataConfig->address}}.</div>
                           <div class="tit-name">Liên hệ:</div>
                           <div class="tit-contain">{{$dataConfig->phone}}</div>
                           <div class="tit-name">Email:</div>
                           <div class="tit-contain">{{$dataConfig->email}}</div> --}}
                       </div>
                   </div>
               </div>
               <div class="col-md-6">
{{--                     <div class="row">
                       <div class="col-sm-4">
                           <div class="introduce-title">Company</div>
                           <ul id="introduce-company"  class="introduce-list">
                               <li><a href="#">About Us</a></li>
                               <li><a href="#">Testimonials</a></li>
                               <li><a href="#">Affiliate Program</a></li>
                               <li><a href="#">Terms & Conditions</a></li>
                               <li><a href="#">Contact Us</a></li>
                           </ul>
                       </div>
                       <div class="col-sm-4">
                           <div class="introduce-title">My Account</div>
                           <ul id = "introduce-Account" class="introduce-list">
                               <li><a href="#">My Order</a></li>
                               <li><a href="#">My Wishlist</a></li>
                               <li><a href="#">My Credit Slip</a></li>
                               <li><a href="#">My Addresses</a></li>
                               <li><a href="#">My Personal In</a></li>
                           </ul>
                       </div>
                       <div class="col-sm-4">
                           <div class="introduce-title">Support</div>
                           <ul id = "introduce-support"  class="introduce-list">
                               <li><a href="#">About Us</a></li>
                               <li><a href="#">Testimonials</a></li>
                               <li><a href="#">Affiliate Program</a></li>
                               <li><a href="#">Terms & Conditions</a></li>
                               <li><a href="#">Contact Us</a></li>
                           </ul>
                       </div>
                   </div> --}}
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
                       <li><a href="{{ url('/') }}" >KuteShop</a></li>
                   </ul>
               </div>
           </div><!-- /#footer-menu-box -->
       </div>
</footer>
