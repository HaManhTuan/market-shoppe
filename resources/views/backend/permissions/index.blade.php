@extends('layouts.admin.admin')
@section('content')
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>
<style>
    .rd-add-per:hover{
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
            <h2 class="pageheader-title">List Permission</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Permissions</a></li>
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
            <div class="card-header">
                @can('add_user')
                <span class="badge badge-primary rd-add-per" style="padding: 8px 15px;"
                ><i class="mdi mdi-plus" ></i> Add Permissions </span>
                @endcan
                <span class="dashboard-spinner spinner-custom custom-load"></span>
                @if(Session::has('flash_message_success'))
                      <script>
                        $(document).ready(function() {
                            $(".breadcrumb").notify("{{ Session::get('flash_message_success') }}", "success");
                        });
                      </script>
               @endif
            </div>
            <div class="card-body">
                <table class="table table-bordered" style="width:50%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col" style="width:200px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $key => $permission)
                        <tr>
                            <th scope="row"> {{ $permission->id ?? '' }}</th>
                            <td> {{ $permission->name ?? '' }}</td>
                            <td>
                                @can('edit_user')
                                <a href="{{ url('admin/user/edit-permissions/'.$permission->id) }}" class="btn btn-success"><i class="fas fa-pencil-alt mr-1"></i>Edit</a>
                                @endcan
                                @can('delete_user')
                                <a href="#" action="{{ url('admin/user/del-post-permissions') }}" class="btn btn-danger btn-del" data-id="{{ $permission->id }}"><i class="fas fa-trash mr-1"></i>Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/admin/assets/js/js-custom/myjs.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/del.js') }}"></script>
@endsection
