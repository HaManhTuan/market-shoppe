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
    background-color: #f53d2d;
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
    $("body").addClass('page-category');
    filter_data();
    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        //console.log(brand);
        $.ajax({
            url:"{{ url('/filter-product/'.$dataCate->url) }}",
            method:"POST",
            cache:false,
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
            data:{minimum_price:minimum_price, maximum_price:maximum_price, brand:brand},
            dataType: "JSON",
            success:function(data){
                console.log(data);
                $('.filter_data').html(data.output);
                $('#script').html(data.script);
            },
            error: function(err){
                console.log(err);
            }
        });
    }
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
    $('.common_selector').click(function(){
        filter_data();
    });
    function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
    }
    // CATEGORY FILTER
    $('.slider-range-price').each(function(){
            var min             = $(this).data('min');
            var max             = $(this).data('max');
            var unit            = $(this).data('unit');
            var value_min       = $(this).data('value-min');
            var value_max       = $(this).data('value-max');
            var label_reasult   = $(this).data('label-reasult');
            var t               = $(this);
            $( this ).slider({
              range: true,
              min: min,
              max: max,
              step: 100000,
              values: [ value_min, value_max ],
              stop: function( event, ui ) {
                var result = label_reasult +" "+ number_format(ui.values[ 0 ]) + unit +' - '+ number_format(ui.values[ 1 ]) + unit;
                //console.log(t);
                t.closest('.slider-range').find('.amount-range-price').html(result);
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                filter_data();
              }
            });
        })
  });
</script>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="{{ url('/')}}" title="Return to Home">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">{{ $dataCate->name}}</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block category -->
                <div class="block left-module">
                    <p class="title_block">Danh mục sản phẩm</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
                                    <li class="active">
                                        <span></span><a href="#">{{$dataCate->name}}</a>
                                        @if (count($dataCate->categories) > 0)
                                        <ul style="display: block;">
                                            @foreach($dataCate->categories as $element)
                                              <li><span></span><a href="{{ url('danh-muc/'.$element->url) }}">
                                                {{ $element->name}}
                                              </a></li>
                                            @endforeach
                                          </ul>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./block category  -->
                <!-- block filter -->

                <!-- ./block filter  -->
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title">{{$dataCate->name}}</span>
                    </h2>
                    <!-- PRODUCT LIST -->
                    <ul class="row product-list grid filter_data" id="myList">

                    </ul>
                    <!-- ./PRODUCT LIST -->
                </div>
                <!-- ./view-product-list-->
                  <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <button id="loadMore">Nhiều hơn</button>
                    </div>
                </div>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
<script id="script"></script>

@endsection
