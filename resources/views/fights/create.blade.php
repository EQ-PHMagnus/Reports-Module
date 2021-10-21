@extends('commons.layout')
@section('title')
Create Affiliates
@endsection

@section('page-title')
Create Affiliates 
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('fights.index')}}">Affiliates Management</a></li>
<li class="breadcrumb-item active">Create Affiliates</li>
@endsection

@section('page-content')
<div class="row">
    <div class="col-8">
        <form class="panel" method="POST" action="{{route('fights.store')}}" autocomplete="off">
            @csrf
            <div class="panel-body">
                <div class="row ">
                    <div class="form-group col-12">
                        <h3>Fight Information</h3>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Fight no</label>
                        <input type="number" class="form-control" min="1" autocomplete="off" name="fight_no" value="{{old('fight_no')}}">
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Arena</label>
                        <select class="form-control" name="arena_id">
                            @forelse($arenas as $arena)
                                <option value="{{$arena->id}}" {{$arena->id == old('arena_id') ? 'selected' : ''}}>{{$arena->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Schedule</label>
                        <input type="datetime-local" class="form-control" autocomplete="off" name="schedule" value="{{old('schedule')}}">
                    </div>
                    <div class="form-group col-12">
                        <h3>Meron Information</h3>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Meron</label>
                        <input type="text" class="form-control" autocomplete="off" name="meron" value="{{old('meron')}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>LB</label>
                        <input type="text" class="form-control" autocomplete="off" name="meron_lb" value="{{old('meron_lb')}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>WB</label>
                        <input type="text" class="form-control" autocomplete="off" name="meron_wb" value="{{old('meron_wb')}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>WT</label>
                        <input type="text" class="form-control" autocomplete="off" name="meron_wt" value="{{old('meron_wt')}}">
                    </div>
                    <div class="form-group col-12">
                        <h3>Wala Information</h3>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Wala</label>
                        <input type="text" class="form-control" autocomplete="off" name="wala" value="{{old('wala')}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>LB</label>
                        <input type="text" class="form-control" autocomplete="off" name="wala_lb" value="{{old('wala_lb')}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>WB</label>
                        <input type="text" class="form-control" autocomplete="off" name="wala_wb" value="{{old('wala_wb')}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>WT</label>
                        <input type="text" class="form-control" autocomplete="off" name="wala_wt" value="{{old('wala_wt')}}">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row"> 
                    <div class="col-12 text-right">
                        <a href="{{route('fights.index')}}" class="btn btn-default btn-outline">Back</a>
                        <button class="btn btn-success btn-outline btn-submit-form">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
