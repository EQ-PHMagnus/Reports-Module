@extends('commons.layout')
@section('title')
Create Arena
@endsection

@section('page-title')
Create Arena 
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('arenas.index')}}">Arena Management</a></li>
<li class="breadcrumb-item active">Create Arena</li>
@endsection

@section('page-content')
<div class="row">
    <div class="col-8">
        <form class="panel" method="POST" action="{{route('arenas.store')}}" autocomplete="off">
            @csrf
            <div class="panel-body">
                <div class="row ">
                    <div class="form-group col-12">
                        <h3>Arena Information</h3>
                    </div>
                    <div class="form-group col-md-8 col-xs-12">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" autocomplete="off" name="name" value="{{old('name')}}">
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label>Status</label>
                        <select class="form-control"autocomplete="off" name="status">
                            @forelse(config('defaults.arena-status') as $status)
                                <option value="{{$status}}" {{$status == old('status') ? 'selected' : ''}}>{{ucfirst($status)}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>            
                </div>
            </div>
            <div class="panel-footer">
                <div class="row"> 
                    <div class="col-12 text-right">
                        <a href="{{route('arenas.index')}}" class="btn btn-default btn-outline">Back</a>
                        <button class="btn btn-success btn-outline btn-submit-form">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
