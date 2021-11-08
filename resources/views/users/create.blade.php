@extends('commons.layout')
@section('title')
Create User
@endsection

@section('page-title')
Create User
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('users.index')}}">User Management</a></li>
<li class="breadcrumb-item active">Create User</li>
@endsection

@section('page-content')
<div class="row">
    <div class="col-8">
        <form class="panel" method="POST" action="{{route('users.store')}}" autocomplete="off">
            @csrf
            <div class="panel-body">
                <div class="row ">
                    <div class="form-group col-12">
                        <h3>Personal Information</h3>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Name</label>
                        <input  type="text" class="form-control" placeholder="Enter Name" autocomplete="off" name="name" value="{{old('name')}}">
                    </div>
                  
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Enter Email" autocomplete="off" name="email" value="{{old('email')}}">
                    </div>

                    <div class="form-group col-md-6 col-xs-12">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" placeholder="Enter Mobile Number" autocomplete="off" name="mobile_number" value="{{old('mobile_number')}}">
                    </div>


                    <div class="form-group col-12">
                        <h3>Account Information</h3>
                    </div>

                    <div class="form-group col-md-6 col-xs-12">
                        <label>Password</label>
                        <div class="input-group ">
                            <input type="password" class="form-control" placeholder="Password" autocomplete="off" name="password">
                            <span class="input-group-btn">
                                <button tabindex="-1"  type="button" class="btn btn-primary btn-show-pass"><i class="icon wb-eye-close" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Confirm Password</label>
                        <div class="input-group ">
                            <input type="password" class="form-control" placeholder="Confirm Password" autocomplete="off" name="password_confirmation">
                            <span class="input-group-btn">
                                <button tabindex="-1"  type="button" class="btn btn-primary btn-show-pass"><i class="icon wb-eye-close" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Role</label>
                        <select class="form-control" name="role">
                            @forelse(config('defaults.system-users') as $role)
                                <option value="{{$role}}" {{$role == old('role') ? 'selected' : ''}}>{{$role}}</option>
                            @empty
                            @endforelse
                        </select>
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
