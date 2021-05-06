@extends('layouts.frontend.app')
@section('content')
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <h2 class="page-heading" style="border-bottom: none">
                    <span class="page-heading-title">Danh mục</span>
                </h2>
                <div class="main-content" style="margin-top: 15px">
                    <div class="owl-carousel owl-theme"  data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                        @if (isset($cateParent) && count($cateParent) > 0)
                         @foreach ($cateParent as $item)
                            <div class="item">
                                <a href="{{ url('danh-muc/'.$item['url']) }}">
                                    <div class="box-category row" style="margin-left: 0px; margin-right: 0px;display: flex;
                                    justify-content: center;
                                    align-items: center;">
                                        <div class="image-category col-md-6">
                                            <img src="{{ asset('uploads/images/category/'.$item->icon) }}" class="img-category">
                                        </div>
                                        <div class="detail-category col-md-6">
                                            <p>{{ $item->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <h2 class="page-heading">
                    <span class="page-heading-title">Gợi ý hôm nay</span>
                </h2>
                <div class="latest-deals-product">
                    <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "10" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                        @if (count($recomendPro) > 0)
                        @foreach ($recomendPro as $element)
                            <li>
                                <div class="left-block">
                                    <a href="{{ url('san-pham/'.$element->url) }}"><img class="img-responsive" alt="product" src="{{ asset('uploads/images/products/'.$element->image) }}" /></a>

                                        <div class="add-to-cart">
                                            <a title="Add to Cart" class="addTocart" data-id="{{$element->id}}" data-name="{{$element->name}}" data-quantity="1" data-price="{{$element->promotional_price > 0 ? $element->promotional_price : $element->price }}" data-avatar="{{$element->image}}" data-url="{{$element->url}}" data-product_id="{{$element->id}}" data-action="{{ url('/add-cart') }}">Add to Cart</a>
                                        </div>

                                    <div class="price-percent-reduction2">
                                        -{{$element->sale}}%
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="#">{{ $element->name }}</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">{{ number_format($element->promotional_price)}}</span>
                                        <span class="price old-price">{{ number_format($element->price)}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <h2 class="page-heading">
                    <span class="page-heading-title">Siêu khuyến mại</span>
                </h2>
                <div class="latest-deals-product">
                    <ul class="product-list">
                        @if (count($salePro) > 0)
                        @foreach ($salePro as $element)
                            <li class="col-md-2-5">
                                <div class="left-block">
                                    <a href="{{ url('san-pham/'.$element->url) }}"><img class="img-responsive" alt="product" src="{{ asset('uploads/images/products/'.$element->image) }}" /></a>

                                        <div class="add-to-cart">
                                            <a title="Add to Cart" class="addTocart" data-id="{{$element->id}}" data-name="{{$element->name}}" data-quantity="1" data-price="{{$element->promotional_price > 0 ? $element->promotional_price : $element->price }}" data-avatar="{{$element->image}}" data-url="{{$element->url}}" data-product_id="{{$element->id}}" data-action="{{ url('/add-cart') }}">Add to Cart</a>
                                        </div>

                                    <div class="price-percent-reduction2">
                                        -{{$element->sale}}%
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="#">{{ $element->name }}</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">{{ number_format($element->promotional_price)}}</span>
                                        <span class="price old-price">{{ number_format($element->price)}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @foreach ($salePro as $element)
                        <li class="col-md-2-5">
                            <div class="left-block">
                                <a href="{{ url('san-pham/'.$element->url) }}"><img class="img-responsive" alt="product" src="{{ asset('uploads/images/products/'.$element->image) }}" /></a>

                                    <div class="add-to-cart">
                                        <a title="Add to Cart" class="addTocart" data-id="{{$element->id}}" data-name="{{$element->name}}" data-quantity="1" data-price="{{$element->promotional_price > 0 ? $element->promotional_price : $element->price }}" data-avatar="{{$element->image}}" data-url="{{$element->url}}" data-product_id="{{$element->id}}" data-action="{{ url('/add-cart') }}">Add to Cart</a>
                                    </div>

                                <div class="price-percent-reduction2">
                                    -{{$element->sale}}%
                                </div>
                            </div>
                            <div class="right-block">
                                <h5 class="product-name"><a href="#">{{ $element->name }}</a></h5>
                                <div class="content_price">
                                    <span class="price product-price">{{ number_format($element->promotional_price)}}</span>
                                    <span class="price old-price">{{ number_format($element->price)}}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                        @endif
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="content-wrap">
    <div class="container">
        <!-- blog list -->
        <div class="blog-list">
            <h2 class="page-heading">
                <span class="page-heading-title" onclick="">Tin tức</span>
            </h2>
            <div class="blog-list-wapper">
                <ul class="owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                    {{-- @foreach ($dataBlog as $element)
                    <li>
                        <div class="post-thumb image-hover2">
                            <a href="{{ url('bai-viet/'.$element->id) }}"><img src="{{ asset('public/uploads/images/blog/'.$element->image) }}" alt="Blog"></a>
                        </div>
                        <div class="post-desc">
                            <h5 class="post-title">
                                <a href="{{ url('bai-viet/'.$element->id) }}">{{$element->name}}</a>
                            </h5>
                            <div class="post-meta">
                                <span class="date">{{date("d-m-Y", strtotime($element->created_at))}}</span>

                            </div>
                            <div class="readmore">
                                <a href="{{ url('bai-viet/'.$element->id) }}">Đọc tiếp</a>
                            </div>
                        </div>
                    </li>
                    @endforeach --}}
                </ul>
            </div>
        </div>
        <!-- ./blog list -->
    </div> <!-- /.container -->
</div>
<script src="{{ asset('public/admin/notify.js') }}"></script>
<script>
$(".addTocart").click(function() {
   let id = $(this).data("id");
   let name = $(this).data("name");
   let price = $(this).data("price");
   let quantity = $(this).data("quantity");
   let avatar = $(this).data("avatar");
   let url = $(this).data("url");
   let product_id = $(this).data("product_id");
   let action = $(this).data("action");
   $.ajax({
        url: action,
        type: "POST",
        dataType: 'JSON',
        headers: {
              'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
        data: {id: id, product_name: name, price: price, qty: quantity, avatar: avatar
            , url: url, product_id: product_id},
        success: function(data){
            console.log(data);
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
<style>
    .product-list li.col-md-2-5 {
        width: 19%;
    }
     .box-category:hover {
        border: 1px solid #eaeaea;
    }
    .main-content .box-category .img-category {
        max-width: 100%;
    }
    .main-content .owl-controls .owl-prev{
        left: -24px;
    }
    .main-content .owl-controls .owl-next{
        right: -24px;
    }
    .main-content .owl-carousel .item {
        background: #ffffff;
    }
</style>
@endsection
