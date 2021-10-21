@extends('commons.layout')
@section('title')
Create Agent
@endsection

@section('page-title')
Create Agent 
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('agents.index')}}">Agent Management</a></li>
<li class="breadcrumb-item active">Create Agent</li>
@endsection

@section('page-content')
<div class="row">
    <div class="col-8">
        <form class="panel" method="POST" action="{{route('agents.store')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="panel-body">
                <div class="row ">
                    <div class="form-group col-12">
                        <h3>Personal Information</h3>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" autocomplete="off" name="name" value="{{old('name')}}">
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Account Username</label>
                        <input type="text" class="form-control" placeholder="Enter Username" autocomplete="off" name="username" value="{{old('username')}}">
                    </div>

                    <div class="form-group col-md-6 col-xs-12">
                        <label>Address</label>
                        <textarea class="form-control" name="address">{{old('address')}}</textarea>
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" placeholder="Enter Mobile Number" autocomplete="off" name="mobile_number" value="{{old('mobile_number')}}">
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" autocomplete="off" name="dob" value="{{old('dob')}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Facebook</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span aria-hidden="true">https://facebook.com/</span>
                                </div>
                            </div>
                        <input type="text" class="form-control" autocomplete="off" name="facebook" value="{{old('facebook')}}">
                    </div>
                        
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Nationality</label>
                        <input type="text" class="form-control" placeholder="Enter Nationality" autocomplete="off" name="nationality" value="{{old('nationality','Filipino')}}">
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Occupation</label>
                        <input type="text" class="form-control" placeholder="Enter Occupation" autocomplete="off" name="occupation" value="{{old('occupation')}}">
                    </div>                     
                   
                    <div class="form-group col-md-3 col-xs-12">
                        <label>GIID</label>
                        <input type="file" class="form-control" placeholder="Enter ID" autocomplete="off" accept="image/*" name="identification">
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Recent Photo</label>
                        <input type="file" class="form-control" placeholder="Enter ID" autocomplete="off" accept="image/*" name="recent_photo">
                    </div>

                    <div class="form-group col-12">
                        <h3>Account Information</h3>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Role</label>
                        <select class="form-control" name="role">
                            @forelse(config('defaults.affiliates') as $role)
                                <option value="{{$role}}" {{$role == old('role') ? 'selected' : ''}}>{{$role}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Level</label>
                        <select class="form-control" name="level">
                            @forelse(config('defaults.agent_levels') as $level)
                                <option value="{{$level}}" {{$level == old('level') ? 'selected' : ''}}>{{$level}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Assign To</label>
                        <input type="text" class="form-control" id="assignTo" autocomplete="off" placeholder="Enter name of the agent/superagent">
                        <input type="hidden" name="agent_id" id="agent_id">
                    </div>

                    <div class="form-group col-md-3 col-xs-12">
                        <label>Points</label>
                        <input type="number" class="form-control" autocomplete="off" name="points" value="{{old('points',100)}}" min="0">
                    </div>
                    
                    <div class="form-group col-md-2 col-xs-12">
                        <label>Agent Code</label>
                        <input type="text" class="form-control" placeholder="Agent Code" autocomplete="off" name="agent_code" value="{{old('agent_code')}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" autocomplete="off" name="password">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password" autocomplete="off" name="password_confirmation">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row"> 
                    <div class="col-12 text-right">
                        <a href="{{route('agents.index')}}" class="btn btn-default btn-outline">Back</a>
                        <button class="btn btn-success btn-outline btn-submit-form">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
<link href="{{asset('global/vendor/jquery-ui/jquery-ui.min.css')}}"></script>
@endpush
@push('scripts')
   <script src="{{asset('global/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
   <script type="text/javascript">
       const searchAgent = "{{route('search-agent')}}";
   </script>
   <script type="text/javascript">
       $( "#assignTo" ).autocomplete({
            source: searchAgent,
            classes: {
                "ui-autocomplete": "highlight"
              },
            minLength: 2,
            select: function( event, ui ) {
                $( "#assignTo" ).val(ui.item.agent_code);
                $( "#agent_id" ).val(ui.item.id);
                console.log(ui.item.agent_code);
                return false;
            }
        }).autocomplete( "instance" )._renderItem =  function( ul, item ) {
            return $( "<li>" )
                .attr( "data-value", item.id )
                .append( "<div>" + item.agent_code + "<br>" + item.username + ' | ' + item.name + "</div>"  )
                .appendTo( ul );
        }
   </script>
@endpush
