@extends('commons.layout')
@section('title')
Fights
@endsection

@section('page-title')
Fights Management
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">Fights Management</li>
@endsection

@section('page-header-actions')
    <a href="{{route('fights.create')}}" type="button" class="btn btn-icon btn-primary btn-outline"><i class="icon wb-plus" aria-hidden="true"></i> Add Fight</a>   
@endsection

@section('page-content')
<div class="row">
    <div class="col">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Fights List</h3>
                <div class="panel-actions panel-actions-keep">
                     <a class="panel-action" data-target="#filterFights" data-toggle="modal">
                        <i class="icon wb-more-vertical" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Fight no</th>
                                <th>Arena</th>
                                <th class="bg-blue-600 text-white">Meron</th>
                                <th class="bg-blue-600 text-white">LB</th>
                                <th class="bg-blue-600 text-white">WB</th>
                                <th class="bg-blue-600 text-white">WT</th>
                                <th class="bg-red-600 text-white">WALA</th>
                                <th class="bg-red-600 text-white">LB</th>
                                <th class="bg-red-600 text-white">WB</th>
                                <th class="bg-red-600 text-white">WT</th>
                                <th class="text-center">Schedule</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($fights as $key => $fight)
                            <tr>
                                <td>{{$fight->fight_no ?? 1}}</td>
                                <td>{{$fight->arena->name ?? ''}}</td>
                                <td class="bg-blue-600 text-white">{{$fight->meron ?? ''}}</td>
                                <td class="bg-blue-600 text-white">{{$fight->meron_lb ?? ''}}</td>
                                <td class="bg-blue-600 text-white">{{$fight->meron_wb ?? ''}}</td>
                                <td class="bg-blue-600 text-white">{{$fight->meron_wt ?? ''}}</td>
                                <td class="bg-red-600 text-white">{{$fight->wala ?? ''}}</td>
                                <td class="bg-red-600 text-white">{{$fight->wala_lb ?? ''}}</td>
                                <td class="bg-red-600 text-white">{{$fight->wala_wb ?? ''}}</td>
                                <td class="bg-red-600 text-white">{{$fight->wala_wt ?? ''}}</td>
                                <td class="text-center">{{$fight->schedule->toDateTimeString() ?? ''}}</td>
                                <td class="text-center">
                                    <a href="{{route('fights.edit',$fight->id)}}" class="btn btn-icon btn-default btn-outline" data-toggle="tooltip" data-title="Edit this fight"><i class="icon wb-pencil" aria-hidden="true"></i></a>
                                    <button type="button" class="btn btn-icon btn-danger btn-outline btn-destroy-model" data-toggle="tooltip" data-title="Delete this fight" data-url="{{route('fights.destroy',$fight->id)}}"><i class="icon wb-trash" aria-hidden="true"></i></button>
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
                        <p>Showing {{ $fights->firstItem() }} to {{ $fights->lastItem() }}
                        of total {{$fights->total()}} entries</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        {{ $fights->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterFights" aria-labelledby="filterFights" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Filter fights</h4>
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
