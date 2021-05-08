@extends('layouts.frontend.app')
@section('content')
<style type="text/css" media="screen">
    .removeCart{
        cursor: pointer;
    }
</style>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="#" title="Return to Home">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Shop</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading no-line">
            <span class="page-heading-title2">Thông tin shop: {{ $userData->name_display }}</span>
        </h2>
        <!-- ../page heading-->
            <ul class="row product-list grid">
                @if (count($dataPro))
                    @foreach ($dataPro as $element)
                        <li class="col-sx-12 col-sm-3">
                            <div class="product-container">
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
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="sortPagiBar">
                {{ $dataPro->links('frontend.paginate') }}
           </div>
    </div>
</div>
<script src="{{ asset('public/admin/notify.js') }}"></script>
@endsection
