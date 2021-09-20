@extends('commons.layout')
@section('title')
Affiliates
@endsection

@section('page-title')
Affiliates Management
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">Affiliates Management</li>
@endsection

@section('page-header-actions')
    
@endsection

@section('page-content')
<div class="row">
    <div class="col">
        <div class="panel">
            <div class="panel-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>Name</th>
                            <th>Nickname</th>
                            <th>Mobile no.</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $key => $user)
                        <tr>
                            <td >{{$user->username ?? ''}}</td>
                            <td >{{$user->name ?? ''}}</td>
                            <td >{{$user->nickname ?? ''}}</td>
                            <td >{{$user->mobile_number ?? ''}}</td>
                            <td >{{$user->points ?? ''}}</td>
                        </tr>
                        @empty
                            <tr><td class="text-center" colspan="5">No records found</td></tr>
                        @endforelse
                    </tbody>
                </table>
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
 
@endsection
