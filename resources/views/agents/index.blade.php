@extends('commons.layout')
@section('title')
Agents
@endsection

@section('page-title')
Agents Management
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">Agents Management</li>
@endsection

@section('page-header-actions')
    <a href="{{route('agents.create')}}" type="button" class="btn btn-icon btn-primary btn-outline"><i class="icon wb-plus" aria-hidden="true"></i> Add Agent</a>   
@endsection

@section('page-content')
<div class="row">
    <div class="col">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Agents List</h3>
                <div class="panel-actions panel-actions-keep">
                     <a class="panel-action" data-target="#filterAgents" data-toggle="modal" title="Search and Filters">
                        <i class="icon fa-filter font-size-20" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Agent Code</th>
                                <th>Type</th>
                                <th class="text-center">Agent Level</th>
                                <th>Player Account</th>
                                <th>Player Name</th>
                                <th class="text-center">Current Credits</th>
                                <th>Joined Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agents as $key => $agent)
                            <tr>
                                <td>{{$agent->agent_code ?? ''}}</td>
                                <td>{{$agent->role ?? ''}}</td>
                                <td class="text-center">{{$agent->level ?? ''}}</td>
                                <td>{{$agent->username ?? ''}}</td>
                                <td>{{$agent->name ?? ''}}</td>
                                <td class="text-center">{{$agent->points ? moneyFormat($agent->points): ''}}</td>
                                <td>{{$agent->created_at->toDateTimeString() ?? ''}}</td>
                                <td>
                                    <a href="{{route('agents.edit',$agent->id)}}" class="btn btn-icon btn-default btn-outline" title="Edit this agent"><i class="icon wb-pencil" aria-hidden="true"></i></a>
                                    <button type="button" class="btn btn-icon btn-danger btn-outline btn-destroy-model" title="Delete this agent" data-url="{{route('agents.destroy',$agent->id)}}"><i class="icon wb-trash" aria-hidden="true"></i></button>
                                    {{-- <button type="button" class="btn btn-icon btn-primary btn-outline" data-toggle="tooltip" data-title="Transact" ><i class="icon fa-money" aria-hidden="true"></i></button> --}}
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
                        <p>Showing {{ $agents->firstItem() }} to {{ $agents->lastItem() }}
                        of total {{$agents->total()}} entries</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        {{ $agents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterAgents" aria-labelledby="filterAgents" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <form  method="GET" autocomplete="off" id="filterForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Search and Filter Agents</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Search</label>
                                <input type="text" class="form-control" name="search" placeholder="Agent Code, Username or Full name" value="{{request('search')}}" autocomplete="off">
                            </div>
                            <div class="form-group col-12">
                                <label>From</label>
                                <input type="date" class="form-control" name="from" value="{{request()->input('from',\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'))}}" autocomplete="off">
                            </div>
                            <div class="form-group col-12">
                                <label>To</label>
                                <input type="date" class="form-control" name="to" value="{{request()->input('to',date('Y-m-d'))}}" autocomplete="off">
                            </div>
                            <input type="hidden" name="export" value="false" id="export">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                        <a href="{{route('agents.index')}}" class="btn btn-secondary btn-block">Reset</a>
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-block btn-export">Export</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
