@extends('commons.layout')
@section('title')
User
@endsection

@section('page-title')
User Management
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">User Management</li>
@endsection

@section('page-header-actions')
    <a href="{{route('users.create')}}" type="button" class="btn btn-icon btn-primary btn-outline"><i class="icon wb-plus" aria-hidden="true"></i> Add User</a>
@endsection

@section('page-content')
<div class="row">
    <div class="col">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">User List</h3>
                <div class="panel-actions panel-actions-keep">
                     <a class="panel-action" data-target="#filterUsers" data-toggle="modal">
                        <i class="icon wb-more-vertical" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Mobile no.</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $key => $user)
                            <tr>
                                <td>{{$user->name ?? ''}}</td>
                                <td>{{$user->username ?? ''}}</td>
                                <td>{{$user->roles->first()->name ?? ''}}</td>
                                <td>{{$user->email ?? ''}}</td>
                                <td>{{$user->mobile_number ?? ''}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-icon btn-default btn-outline" data-toggle="tooltip" data-title="Edit this user"><i class="icon wb-pencil" aria-hidden="true"></i></a>
                                    <button type="button" class="btn btn-icon btn-danger btn-outline btn-destroy-model" data-toggle="tooltip" data-title="Delete this user" data-url="{{route('users.destroy',$user->id)}}"><i class="icon wb-trash" aria-hidden="true"></i></button>
                                    <!-- <button type="button" class="btn btn-icon btn-primary btn-outline" data-toggle="tooltip" data-title="Transact" ><i class="icon fa-money" aria-hidden="true"></i></button> -->
                                </td>
                            </tr>
                            @empty
                                <tr><td class="text-center" colspan="5">No records found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-center">
                        <p>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }}
                        of total {{$users->total()}} entries</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterUsers" aria-labelledby="filterUsers" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Filter Users</h4>
                </div>
                <div class="modal-body">
                    <form method="GET" autocomplete="off">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search" value="{{request('search')}}" autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block">Submit</button>
                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
