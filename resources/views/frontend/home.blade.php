@extends('layouts.frontend.app')
@section('content')
@include('layouts.frontend.area01')
<!-- /.em-wrapper-area01 -->
 <div class="em-main-container em-col2-left-layout">
     <div class="row">
         <div class="col-sm-24 em-col-main">
             <div class="row">
                    <div class="em-wrapper-area03">
                        <div class="col-sm-16">
                            <img style="max-width: 100%" src="https://cf.shopee.vn/file/ee956d0faea9477133a136df2c935797_xxhdpi" alt="">
                        </div>
                        <div class="col-sm-8">
                            <img style="max-width: 100%" src="https://cf.shopee.vn/file/79a117453d41d6285ea71b5fbc1d109d_xhdpi" alt="">
                            <img style="max-width: 100%; margin-top: 5px" src="https://cf.shopee.vn/file/79a117453d41d6285ea71b5fbc1d109d_xhdpi" alt="">
                        </div>
                 </div>
             </div>
             <div class="row list-category">
                @include('layouts.frontend.area06')
                <!-- /.em-wrapper-area06 -->
             </div>
            <!-- /.em-wrapper-area03 -->

             <div class="em-wrapper-new-arrivals-tabs">
                 <div class="em-new-arrivals-tabs em-line-01">
                     <div class="emtabs-ajaxblock-loaded">
                         <div class="em-tabs-widget tabs-widget ">
                             <div class="widget-title em-widget-title">
                                 <h3><span>Gợi ý hôm nay</span></h3>
                             </div>
                             <div  class="em-tabs emtabs r-tabs">
                                 <div class="em-tabs-content tab-content">
                                    <div class="wrapper button-show01 button-hide-text em-wrapper-loaded">
                                        <div class="emfilter-ajaxblock-loaded">
                                            <div class="em-grid-20 ">

                                                <div class="widget em-filterproducts-grid">
                                                    <div class="widget-products em-widget-products">
                                                        <div class="emcatalog-desktop-4">
                                                            <div class="products-grid ">
                                                                @if (count($recomendPro) > 0)
                                                                    @foreach ($recomendPro as $item)
                                                                        <div class="item" style="  ">
                                                                            <div class="product-item">
                                                                                <div class="product-shop-top">
                                                                                    <a href="#" title="{{ $item->name }}" class="product-image">
                                                                                        @if ($item->sale > 0)
                                                                                        <ul class="productlabels_icons">
                                                                                            <li class="label special">
                                                                                                <p>
                                                                                                    <span>-{{ $item->sale }}%</span> </p>
                                                                                            </li>
                                                                                        </ul>
                                                                                        @endif
                                                                                        <img style="" class="img-responsive" src="{{ asset('uploads/images/products/'.$item->image)}}" height="350" width="350">
                                                                                    </a>
                                                                                </div><!-- /.product-shop-top -->

                                                                                <div class="product-shop">
                                                                                    <div class="f-fix">
                                                                                        <!--product name-->
                                                                                        <h3 style="min-height: 19px;" class="product-name"><a href="#" title=""> {{ $item->name }}</a></h3>
                                                                                        @if ($item->sale > 0)
                                                                                        <div class="price-box">
                                                                                            <p class="old-price">
                                                                                                <span class="price-label">Regular Price:</span>
                                                                                                <span class="price" id="old-price-184-emprice-165caa30959cee82d2cf6c2c473c2079">đ {{  number_format($item->price)  }}</span>
                                                                                            </p>
                                                                                            <p class="special-price">
                                                                                                <span class="price-label">Special Price</span>
                                                                                                <span class="price" content="90" id="product-price-184-emprice-165caa30959cee82d2cf6c2c473c2079">đ {{  number_format($item->promotional_price	)  }}</span>
                                                                                            </p>
                                                                                        </div>
                                                                                        @else
                                                                                        <div class="price-box">
                                                                                            <span class="regular-price" id="product-price-177-emprice-659da6b027ea5433ad0a985675d8fd89">
                                                                                                    <span class="price">đ {{  number_format($item->price)  }}</span> </span>

                                                                                        </div>
                                                                                        @endif




                                                                                    </div>
                                                                                </div><!-- /.product-shop -->
                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                @endif
                                                              <!-- item --><!-- item -->
                                                            </div><!-- /.products-grid -->
                                                        </div><!-- /.emcatalog-desktop-4 -->
                                                    </div><!-- /.widget-products -->
                                                </div><!-- /.widget -->

                                            </div><!-- /#em_fashion_new_arrivals_tab01 -->
                                        </div>
                                    </div>

                                 </div><!-- /.tab-content -->
                             </div><!-- /#emtabs_1 -->
                         </div>
                     </div>
                 </div><!-- /.em-new-arrivals-tabs -->
             </div><!-- /.em-wrapper-new-arrivals-tabs -->

             <div class="em-wrapper-banners hidden-xs">
                 <div class="em-effect06">
                     <a class="em-eff06-03" title="em-sample-title" href="#"> <img class="img-responsive" alt="em-sample-alt" src="{{ asset('frontend/images/wysiwyg/em_ads_10.jpg') }}" /> </a>
                 </div>
             </div><!-- /.em-wrapper-banners -->

             <div class="em-best-sales em-wrapper-product-15">
                 <div class="emfilter-ajaxblock-loaded">
                     <div class="em-grid-15 custom-product-grid">
                         <div class="widget-title em-widget-title">
                             <h3><span>Giảm giá nhiều nhất</span></h3>
                         </div>
                         <div  class="em-tabs emtabs r-tabs">
                            <div class="em-tabs-content tab-content">
                               <div class="wrapper button-show01 button-hide-text em-wrapper-loaded">
                                   <div class="emfilter-ajaxblock-loaded">
                                       <div class="em-grid-20 ">

                                           <div class="widget em-filterproducts-grid">
                                               <div class="widget-products em-widget-products">
                                                   <div class="emcatalog-desktop-4">
                                                       <div class="products-grid ">
                                                           @if (count($recomendPro) > 0)
                                                               @foreach ($recomendPro as $item)
                                                                   <div class="item" style="  ">
                                                                       <div class="product-item">
                                                                           <div class="product-shop-top">
                                                                               <a href="#" title="{{ $item->name }}" class="product-image">
                                                                                   @if ($item->sale > 0)
                                                                                   <ul class="productlabels_icons">
                                                                                       <li class="label special">
                                                                                           <p>
                                                                                               <span>-{{ $item->sale }}%</span> </p>
                                                                                       </li>
                                                                                   </ul>
                                                                                   @endif
                                                                                   <img style="" class="img-responsive" src="{{ asset('uploads/images/products/'.$item->image)}}" height="350" width="350">
                                                                               </a>
                                                                           </div><!-- /.product-shop-top -->

                                                                           <div class="product-shop">
                                                                               <div class="f-fix">
                                                                                   <!--product name-->
                                                                                   <h3 style="min-height: 19px;" class="product-name"><a href="#" title=""> {{ $item->name }}</a></h3>
                                                                                   @if ($item->sale > 0)
                                                                                   <div class="price-box">
                                                                                       <p class="old-price">
                                                                                           <span class="price-label">Regular Price:</span>
                                                                                           <span class="price" id="old-price-184-emprice-165caa30959cee82d2cf6c2c473c2079">đ {{  number_format($item->price)  }}</span>
                                                                                       </p>
                                                                                       <p class="special-price">
                                                                                           <span class="price-label">Special Price</span>
                                                                                           <span class="price" content="90" id="product-price-184-emprice-165caa30959cee82d2cf6c2c473c2079">đ {{  number_format($item->promotional_price	)  }}</span>
                                                                                       </p>
                                                                                   </div>
                                                                                   @else
                                                                                   <div class="price-box">
                                                                                       <span class="regular-price" id="product-price-177-emprice-659da6b027ea5433ad0a985675d8fd89">
                                                                                               <span class="price">đ {{  number_format($item->price)  }}</span> </span>

                                                                                   </div>
                                                                                   @endif




                                                                               </div>
                                                                           </div><!-- /.product-shop -->
                                                                       </div>
                                                                   </div>
                                                               @endforeach

                                                           @endif
                                                         <!-- item --><!-- item -->
                                                       </div><!-- /.products-grid -->
                                                   </div><!-- /.emcatalog-desktop-4 -->
                                               </div><!-- /.widget-products -->
                                           </div><!-- /.widget -->

                                       </div><!-- /#em_fashion_new_arrivals_tab01 -->
                                   </div>
                               </div>

                            </div><!-- /.tab-content -->
                        </div><!-- /#emtabs_1 -->


                     </div><!-- /.em-grid-15 -->
                 </div>
             </div><!-- /.em-best-sales -->
         </div><!-- /.em-col-main -->
        <!-- /.em-sidebar -->
     </div>
 </div><!-- /.em-main-container -->
@include('layouts.frontend.area04')
<!-- /.em-wrapper-area04 -->
@include('layouts.frontend.area05')
<!-- /.em-wrapper-area05 -->


@endsection
