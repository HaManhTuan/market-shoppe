@extends('layouts.frontend.app')
@section('content')
<style>
#loading
{
 text-align:center;
 background: url('{{ asset('frontend/loader.gif') }}') no-repeat center;
 height: 150px;
}
#loadMore {
    padding: 10px;
    text-align: center;
    background-color: #4c311d;
    color: #fff;
    border-width: 0 1px 1px 0;
    border-style: solid;
    border-color: #fff;
    box-shadow: 0 1px 1px #ccc;
    transition: all 600ms ease-in-out;
    -webkit-transition: all 600ms ease-in-out;
    -moz-transition: all 600ms ease-in-out;
    -o-transition: all 600ms ease-in-out;
}
#loadMore:hover {
    background-color: #958457;
    color: #fff;
}
</style>
<script>
  jQuery(document).ready(function($) {
    $("body").removeClass('home');
    $("body").addClass('product-page right-sidebar');
  });
</script>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="#" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <a href="{{ url('danh-muc/'.$dataCate->url) }}" title="Return to Home">{{$dataCate->name}}</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">{{$dataPro->name}}</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block best sellers -->
                <div class="block left-module">
                    <p class="title_block">Sản phẩm mới</p>
                    <div class="block_content">
                        <ul class="products-block best-sell">
                          @foreach ($dataTop4News as $element)
                             <li>
                                    <div class="products-block-left">
                                        <a href="{{ url('san-pham/'.$element->url) }}">
                                            <img src="{{ asset('uploads/images/products/'.$element->image) }}" alt="SPECIAL PRODUCTS">
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="{{ url('san-pham/'.$element->url) }}">{{$element->name}}</a>
                                        </p>
                                        <p class="product-price">{{number_format($element->price)}}</p>
                                    </div>
                                </li>
                          @endforeach
                            </ul>
                    </div>
                </div>
                <!-- left silide -->
{{--                 <div class="col-left-slide left-module">
                    <div class="banner-opacity">
                        <a href="#"><img src="assets/data/ads-banner.jpg" alt="ads-banner"></a>
                    </div>
                </div> --}}
                <!--./left silde-->
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- Product -->
                    <div id="product">
                        <div class="primary-box row">
                            <div class="pb-left-column col-xs-12 col-sm-6">
                                <!-- product-imge-->
                                <div class="product-image">
                                    <div class="product-full">
                                        <img id="product-zoom" src='{{ asset('uploads/images/products/'.$dataPro->image) }}' data-zoom-image="{{ asset('uploads/images/products/'.$dataPro->image) }}"/>
                                    </div>
                                    <div class="product-img-thumb" id="gallery_01">
                                        <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="20" data-loop="true">
                                          @foreach ($dataImage as $item)
                                           <li>
                                                <a href="#" data-image="{{ asset('uploads/images/products/'.$item->img)}}" data-zoom-image="{{ asset('uploads/images/products/'.$item->img)}}">
                                                    <img id="product-zoom"  src="{{ asset('uploads/images/products/'.$item->img)}}" />
                                                </a>
                                            </li>
                                          @endforeach

                                        </ul>
                                    </div>
                                </div>
                                <!-- product-imge-->
                            </div>
                            <div class="pb-right-column col-xs-12 col-sm-6">
                                <form action="{{ url('/add-cart') }}" method="POST" onsubmit="return false;" id="frm-cart">
                                    @csrf
                                <h1 class="product-name">{{$dataPro->name}}</h1>
                                <input type="hidden" name="product_name" id="product_name" value="{{ $dataPro->name }}">
                              @if($dataPro->promotional_price != 0)
                              <input type="hidden" name="price" id="price" value="{{ $dataPro->promotional_price }}">
                              @endif
                              @if($dataPro->promotional_price == 0)
                              <input type="hidden" name="price" id="price" value="{{ $dataPro->price }}">
                              @endif
                              <input type="hidden" name="product_id" id="product_id" value="{{ $dataPro->id }}">
                              <input type="hidden" name="avatar" id="avatar" value="{{ $dataPro->image }}">
                              <input type="hidden" name="url" id="url" value="{{ $dataPro->url }}">
                                <input type="hidden" name="product_id" value="{{$dataPro->id}}">
                                <div class="product-price-group">
                                  @if ($dataPro->promotional_price > 0)
                                    <span class="price">{{number_format($dataPro->promotional_price)}} đ</span>
                                    <span class="old-price">{{number_format($dataPro->price)}} đ</span>
                                    <span class="discount">-{{ $dataPro->sale}}%</span>
                                  @else
                                   <span class="price">{{number_format($dataPro->price)}} đ</span>
                                  @endif
                                </div>

                                <div class="info-orther">
                                    <p>Trạng thái: <span class="in-stock">{{$dataPro->stock < 1 ? "Hết hàng" : "Còn hàng"}}</span></p>
                                </div>
                                <div class="product-desc">
                                   {!! $dataPro->description!!}
                                </div>
                                <div class="form-inline" style="display: flex;">
                                     <label>Số lượng: </label>
                                        <input type="number" name="qty" class="form-control qty-edit" style="margin: 0px 30px;width: 80px;"  value="1"/>
                                </div>
                                @if ($dataPro->stock > 0)
                                    <div class="form-action">
                                    <div class="button-group">
                                        <a class="btn-add-cart" href="#" id="addCart">Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                                @endif


                                </form>
                            </div>
                        </div>
                        <!-- tab product -->
                        <div class="product-tab">
                            <ul class="nav-tab">
                                <li class="active">
                                    <a aria-expanded="false" data-toggle="tab" href="#product-detail">Chi tiết sản phẩm</a>
                                </li>
                                <li>
                                    <a aria-expanded="true" data-toggle="tab" href="#information">Bình luận</a>
                                </li>
                            </ul>
                            <div class="tab-container">
                                <div id="product-detail" class="tab-panel active">
                                   {!! $dataPro->content!!}
                                </div>
                                <div id="information" class="tab-panel">
                                    <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#{{$dataPro->url}}" data-numposts="5" data-width="100%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ./tab product -->
                        <!-- box product -->
                        <div class="page-product-box">
                            <h3 class="heading">Sản phẩm tương tự</h3>
                            <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                              @foreach ($dataReleast as $item1)
                                <li>
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="{{ url('san-pham/'.$item1->url) }}">
                                                <img class="img-responsive" alt="product" src="{{ asset('uploads/images/products/'.$item1->image) }}" />
                                            </a>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#add">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="{{ url('san-pham/'.$item1->url) }}">{{ $item1->name}}</a></h5>
                                            <div class="content_price">
                                              @if ($item1->promotional_price < 0)
                                                <span class="price product-price">{{ number_format($item1->promotional_price) }} đ</span>
                                                <span class="price old-price">{{ number_format($item1->price) }} đ</span>
                                              @else
                                                  <span class="price product-price">{{ number_format($item1->price) }} đ</span>
                                              @endif

                                            </div>
                                        </div>
                                    </div>
                                </li>
                              @endforeach


                            </ul>
                        </div>
                        <!-- ./box product -->
                        <!-- box product -->
                        <div class="page-product-box">
                            <h3 class="heading">Sản khẩm khác</h3>
                            <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                              @foreach ($dataNews as $element1)
                                  <li>
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="{{ url('san-pham/'.$element1->url) }}">
                                                <img class="img-responsive" alt="product" src="{{ asset('uploads/images/products/'.$element1->image) }}" />
                                            </a>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#add">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="{{ url('san-pham/'.$element1->url) }}">{{ $element1->name}}</a></a></h5>
                                            <div class="content_price">
                                                 @if ($element1->promotional_price < 0)
                                                <span class="price product-price">{{ number_format($element1->promotional_price) }} đ</span>
                                                <span class="price old-price">{{ number_format($element1->price) }} đ</span>
                                              @else
                                                  <span class="price product-price">{{ number_format($element1->price) }} đ</span>
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>

                              @endforeach
                            </ul>
                        </div>
                        <!-- ./box product -->
                    </div>
                <!-- Product -->
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
<script src="{{ asset('admin/notify.js') }}"></script>
<script>
function number_format(number, decimals, dec_point, thousands_sep) {
    // * example 1: number_format(1234.5678, 2, '.', '');
    // * returns 1: 1234.57
    number = number.toString().replace(/[(,)|(.)]/g, "");

    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}
  $('.qty-edit').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
 $("#addCart").click(function() {
    let action = $("#frm-cart").attr('action');
    let method = $("#frm-cart").attr('method');
    let form   = $("#frm-cart").serialize();
    //console.log(form);
    $.ajax({
        url: action,
        type: method,
        dataType: 'JSON',
        data: form,
        success: function(data){
              if (data.status =="_success") {
                    $('html, body').animate({scrollTop: 0}, 2000);
                    $("#cart-block").html(data['cartblock']);
                    $.notify(data.success,"success");

              }
              else
              {
                 $('html, body').animate({scrollTop: 0}, 'slow');
                  $.notify(data.msg,"error");
              }
        },
        error: function(err){
            console.log(err);
        }
    });
 });
</script>
@endsection
