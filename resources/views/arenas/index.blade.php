@extends('commons.layout')
@section('title')
Arena
@endsection

@section('page-title')
Arena Management
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">Arena Management</li>
@endsection

@section('page-header-actions')
    <a href="{{route('arenas.create')}}" type="button" class="btn btn-icon btn-primary btn-outline"><i class="icon wb-plus" aria-hidden="true"></i> Add Arena</a>   
@endsection

@section('page-content')
<div class="row">
    <div class="col">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Arena List</h3>
                <div class="panel-actions panel-actions-keep">
                     <a class="panel-action" data-target="#filterArenas" data-toggle="modal">
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
                                <th>Status</th>
                                <th>Create_at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($arenas as $key => $arena)
                            <tr>
                                <td>{{$arena->name ?? ''}}</td>
                                <td>{{$arena->status ?? ''}}</td>
                                <td>{{$arena->created_at->toDateTimeString() ?? ''}}</td>
                                <td>
                                    <a href="{{route('arenas.edit',$arena->id)}}" class="btn btn-icon btn-default btn-outline" data-toggle="tooltip" data-title="Edit this arena"><i class="icon wb-pencil" aria-hidden="true"></i></a>
                                    <button type="button" class="btn btn-icon btn-danger btn-outline btn-destroy-model" data-toggle="tooltip" data-title="Delete this arena" data-url="{{route('arenas.destroy',$arena->id)}}"><i class="icon wb-trash" aria-hidden="true"></i></button>
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
                        <p>Showing {{ $arenas->firstItem() }} to {{ $arenas->lastItem() }}
                        of total {{$arenas->total()}} entries</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        {{ $arenas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterArenas" aria-labelledby="filterArenas" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Filter arenas</h4>
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
