@extends('layouts.admin.admin')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
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
            <h2 class="pageheader-title">Edit Roles</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('admin/user/edit-post-roles') }}" method="POST" enctype="multipart/form-data" id="frm-edit-role">
                    @csrf
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Title</label>
                        <input id="inputText3" type="hidden" class="form-control" id="id" name="id"
                        value="{{ isset($role) ? $role->id : '' }}">
                        <input id="inputText3" type="text" class="form-control" id="name" name="name"
                         data-rule-required="true" data-msg-required="This field cannot be blank."
                         value="{{ isset($role) ? $role->name : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Permission
                            <span class="btn btn-primary btn-xs select-all">Select all</span>
                            <span class="btn btn-warning btn-xs deselect-all">Delselec all</span>
                        </label>
                        <select name="permission[]" id="permission" class="form-control select2" multiple="multiple" data-rule-required="true" data-msg-required="This field cannot be blank.">
                            @foreach($permissions as $id => $permissions)
                                <option value="{{ $id }}" {{ (isset($role) && $role->permissions()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.select-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', 'selected')
        $select2.trigger('change')
      })
      $('.deselect-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', '')
        $select2.trigger('change')
      })
      $('.select2').select2()
</script>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $("#frm-edit-role").validate();
    });
</script>
@endsection
