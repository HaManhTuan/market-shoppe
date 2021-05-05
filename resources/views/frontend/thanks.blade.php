@extends('layouts.frontend.app')
@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <h3 align="center" style="margin-top: 100px;">Đơn hàng của bạn đang được xử lý.</h3>
        <h2 align="center" style="margin-top: 10px;">Cảm ơn bạn đã đặt hàng ở cửa hàng của chúng tôi</h2>
    </div>
</div>
<script src="{{ asset('admin/notify.js') }}"></script>
<script>
  jQuery(document).ready(function($) {
    $("body").removeClass('home');
    $("body").addClass('page-category');
    setTimeout(function(){window.location.href="{{ url('/') }}"}, 2500)
  });
</script>
@endsection
