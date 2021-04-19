@extends('layouts.admin.admin')
@section('content')
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>
<style>
    .error{
        color: brown;
        font-size: 14px;
        padding: 5px;
    }
    </style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Edit User</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">User</a></li>
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
                @if(Session::has('flash_message_error'))
                    <div class="col-md-7 alert alert-danger" role="alert">
                        {{ Session::get('flash_message_error') }}
                    </div>
                @endif
                <form action="{{ url('admin/user/edit-post-user') }}" method="POST" enctype="multipart/form-data" id="frm-edit-user">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $dataUserId->id }}">
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Name</label>
                        <input  type="text" value="{{ $dataUserId->name }}" class="col-md-7 form-control" id="name" name="name" data-rule-required="true"  data-msg-required="This field cannot be blank.">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Email</label>
                        <input  type="email" class="col-md-7 form-control" value="{{ $dataUserId->email }}" id="email" name="email" data-rule-required="true"  data-msg-required="This field cannot be blank.">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Password</label>
                        <input  type="password" class="col-md-7 form-control"  id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="form-label">Phone</label>
                        <input  type="text" value="{{ $dataUserId->phone }}" class="col-md-7 form-control" id="phone" name="phone" data-rule-required="true" data-msg-required="This field cannot be blank.">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="admin" {{ (isset($dataUserId) && $dataUserId->admin == "1") ? 'checked' : '' }}  class="custom-control-input"><span class="custom-control-label"> Active</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Edit
                            <span class="btn btn-primary btn-xs select-all">Select all</span>
                            <span class="btn btn-warning btn-xs deselect-all">Delselec all</span>
                        </label>
                        <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" data-rule-required="true" data-msg-required="This field cannot be blank.">
                            @foreach($roles as $id => $roles)
                            <option value="{{ $id }}" {{  isset($dataUserId) && $dataUserId->roles()->pluck('name', 'id')->contains($id) ? 'selected' : '' }}>{{ $roles }}</option>
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
        $("#frm-edit-user").validate();
    });
</script>
@endsection
