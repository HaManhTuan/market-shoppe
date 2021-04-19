@extends('layouts.admin.admin')
@section('content')
<style>
.error{
    color: brown;
    font-size: 14px;
    padding: 5px;
}
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Add Permission</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Permissions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('admin/user/add-post-permissions') }}" method="POST" enctype="multipart/form-data" id="frm-add-per">
                    @csrf
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Title</label>
                        <input id="inputText3" type="text" class="form-control" id="name" name="name" data-rule-required="true" data-msg-required="This field cannot be blank.">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/admin/assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>
<script>
    $(document).ready(function() {
        $("#frm-add-per").validate();
    });
</script>
@endsection
