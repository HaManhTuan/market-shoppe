@extends('layouts.admin.admin')
@section('content')
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>
@if(Session::has('flash_message_success'))
<script>
  $(document).ready(function() {
      $(".breadcrumb").notify("{{ Session::get('flash_message_success') }}", "success");
  });
</script>
 @endif
<style>
    .rd-add:hover{
        cursor: pointer;
    }
    .custom-load{
        display: none;
        float: right;
        margin: 0px 8px;
        border: 3px solid transparent;
        border-top: 3px solid #5969ff;
        border-left: 3px solid #5969ff;
        -webkit-animation: 1s spin linear infinite;
        animation: 2s spin linear infinite;
    }
    .spinner-custom{
        width: 26px;
        height: 26px
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">List User
            </h2>

            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            @role('Admin')
            <div class="card-header"><span class="badge badge-primary rd-add" style="padding: 8px 15px;"
                ><i class="mdi mdi-plus" ></i> Add</span>
                <span class="dashboard-spinner spinner-custom custom-load"></span>
            </div>
            @endrole
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" style="text-align:center">ST</th>
                            <th scope="col">Role</th>
                            @can('edit_user')
                            <th scope="col">Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $stt = 1;
                        @endphp
                        @foreach ($dataUser as $item)
                        <tr>
                            <th scope="row">{{ $stt++ }}</th>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td align="center">
                                @if ($item['admin'] == "1")
                                <span class=" badge-dot badge-success mr-1"></span>
                                @else
                                <span class="badge-dot badge-brand mr-1"></span>
                                @endif
                            <td>
                                @foreach($item->roles()->pluck('name') as $role)
                                <span class="badge badge-info">{{ $role }}</span>
                            @endforeach</td>
                            @can('edit_user')
                            <td>
                                <button class="btn btn-primary" onclick="window.location.href='{{ url('admin/user/edit-user/'.$item['id']) }}'">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/admin/assets/js/js-custom/myjs.js') }}"></script>
@endsection
