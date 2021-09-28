@extends('commons.layout')
@section('title')
Edit Affiliates
@endsection

@section('page-title')
Edit Affiliates 
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('users.index')}}">Affiliates Management</a></li>
<li class="breadcrumb-item active">Edit Affiliates</li>
@endsection

@section('page-content')
<div class="row">
    <div class="col-8">
        <form class="panel" method="POST" action="{{route('users.update',$user->id)}}" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="panel-body">
                <div class="row ">
            		<div class="form-group col-12">
                        <h3>Personal Information</h3>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
            			<label>Name</label>
            			<input type="text" class="form-control" placeholder="Enter Name" autocomplete="off" name="name" value="{{old('name',$user->name)}}">
            		</div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Enter Username" autocomplete="off" name="username" value="{{old('username',$user->username)}}">
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Nickname</label>
                        <input type="text" class="form-control" placeholder="Enter Nickname" autocomplete="off" name="nickname" value="{{old('nickname',$user->nickname)}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Address</label>
                        <textarea class="form-control" name="address">{{old('name',$user->address)}}</textarea>
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" placeholder="Enter Mobile Number" autocomplete="off" name="mobile_number" value="{{old('mobile_number',$user->mobile_number)}}">
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" autocomplete="off" name="dob" value="{{old('dob',$user->dob->format('Y-m-d'))}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Facebook</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span aria-hidden="true">https://facebook.com/</span>
                                </div>
                            </div>
                        <input type="text" class="form-control" autocomplete="off" name="facebook" value="{{old('facebook',$user->facebook)}}">
                    </div>
                        
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Occupation</label>
                        <input type="text" class="form-control" placeholder="Enter Occupation" autocomplete="off" name="occupation" value="{{old('occupation',$user->occupation)}}">
                    </div>                    
                   
                    {{-- <div class="form-group col-md-3 col-xs-12">
                        <label>Identification</label>
                        <input type="file" class="form-control" placeholder="Enter ID" autocomplete="off" accept="image/*" name="identification">
                    </div> 
                    <div class="form-group col-md-3 col-xs-12">
                        <a class="inline-block" href="{{asset('global/photos/placeholder.png')}}" data-plugin="magnificPopup" data-main-class="mfp-img-mobile">
                        <img class="img-fluid" src="{{asset('global/photos/placeholder.png')}}" alt="..." width="220">
                    </a>
                    </div>--}}
                    <div class="form-group col-12">
                        <h3>Account Information</h3>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Role</label>
                        <select class="form-control" name="role">
                            @forelse(config('defaults.affiliates') as $role)
                                <option value="{{$role}}" {{$role == old('role',$user->role) ? 'selected' : ''}}>{{$role}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label>Points</label>
                        <input type="number" class="form-control" autocomplete="off" name="points" value="{{old('points',$user->points)}}" min="0">
                    </div>
                    
                    <div class="form-group col-md-2 col-xs-12">
                        <label>Agent Code</label>
                        <input type="text" class="form-control" placeholder="Agent Code" autocomplete="off" name="agent_code" value="{{old('agent_code',$user->agent_code)}}">
                    </div>
                	</div>
            </div>
            <div class="panel-footer">
                <div class="row"> 
                    <div class="col-12 text-right">
                        <a href="{{route('users.index')}}" class="btn btn-default btn-outline">Back</a>
                        <button class="btn btn-success btn-outline btn-submit-form">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection