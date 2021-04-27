 <div class="em-wrapper-area06">
    <div class="em-wrapper-brands">
        <div class=" slider-style02">
            <div class="em-slider em-slider-banners em-slider-navigation-icon" data-emslider-navigation="true" data-emslider-items="4" data-emslider-desktop="5" data-emslider-desktop-small="4" data-emslider-tablet="3" data-emslider-mobile="2">
               @if (count($cateParent) > 0)
                @foreach ($cateParent as $item)
                <div class="em-banners-item">
                    <a class="icon-banner-left pull-left" title="{{ $item->name }}" href="#" style="width:40%;float: left;">
                        <img class="img-responsive" alt="em_brand_01.jpg" src="{{ asset('uploads/images/category/'.$item->icon) }}" />
                    </a>
                    <div class="em-banner-right"  style="width:60%;float: left;">
                        <p style="margin-top: 30px;">{{ $item->name }}</p>
                    </div>
                </div>
                @endforeach
               @endif
            </div>
        </div><!-- /.slider-style02 -->
    </div>
</div>
