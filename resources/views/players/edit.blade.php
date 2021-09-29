@extends('commons.layout')
@section('title')
Edit Player
@endsection

@section('page-title')
Edit Player 
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{route('players.index')}}">Player Management</a></li>
<li class="breadcrumb-item active">Edit Player</li>
@endsection

@section('page-content')
<div class="row">
    <div class="col-8">
        <form class="panel" method="POST" action="{{route('players.update',$player->id)}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="panel-body">
                <div class="row ">
            		<div class="form-group col-12">
                        <h3>Personal Information</h3>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
            			<label>Name</label>
            			<input type="text" class="form-control" placeholder="Enter Name" autocomplete="off" name="name" value="{{old('name',$player->name)}}">
            		</div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Enter Username" autocomplete="off" name="username" value="{{old('username',$player->username)}}">
                    </div>
                   
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Address</label>
                        <textarea class="form-control" name="address">{{old('name',$player->address)}}</textarea>
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" placeholder="Enter Mobile Number" autocomplete="off" name="mobile_number" value="{{old('mobile_number',$player->mobile_number)}}">
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" autocomplete="off" name="dob" value="{{old('dob',$player->dob->format('Y-m-d'))}}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Facebook</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span aria-hidden="true">https://facebook.com/</span>
                                </div>
                            </div>
                        <input type="text" class="form-control" autocomplete="off" name="facebook" value="{{old('facebook',$player->facebook)}}">
                    </div>
                        
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Nationality</label>
                        <input type="text" class="form-control" placeholder="Enter Nationality" autocomplete="off" name="nationality" value="{{old('nationality',$player->nationality)}}">
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Occupation</label>
                        <input type="text" class="form-control" placeholder="Enter Occupation" autocomplete="off" name="occupation" value="{{old('occupation',$player->occupation)}}">
                    </div>                     
                   
                    <div class="form-group col-md-6 col-xs-12">
                        <label>GIID</label>
                        <input type="file" class="form-control" placeholder="Enter ID" autocomplete="off" accept="image/*" name="identification">
                        @php
                            $giid = $player->identification;
                            if(strpos($giid, 'picsum') === false){
                                $giid = asset('storage/'. $player->identification);
                            }
                        @endphp
                        <a class="inline-block mt-10" href="{{$giid}}" data-plugin="magnificPopup" data-main-class="mfp-img-mobile">
                          <img class="img-fluid" src="{{$giid}}" alt="..." width="220">
                        </a>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>Recent Photo</label>
                        <input type="file" class="form-control" placeholder="Enter ID" autocomplete="off" accept="image/*" name="recent_photo">
                        @php
                            $recent_photo = $player->recent_photo;
                            if(strpos($recent_photo, 'picsum') === false){
                                $recent_photo = asset('storage/'. $player->recent_photo);
                            }
                        @endphp
                        <a class="inline-block mt-10" href="{{$recent_photo}}" data-plugin="magnificPopup" data-main-class="mfp-img-mobile">
                          <img class="img-fluid" width="150" height="150" src="{{$recent_photo}}" alt="...">
                        </a>
                    </div> 
                    <div class="form-group col-12">
                        <h3>Account Information</h3>
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label>Assign To</label>
                        <input type="text" class="form-control" id="assignTo" autocomplete="off" placeholder="Enter name of the agent/superagent" value="{{old('role',$player->agent->agent_code ?? '')}}">
                        <input type="hidden" name="agent_id" id="agent_id" value="{{old('role',$player->agent->id ?? '')}}">
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label>Points</label>
                        <input type="number" class="form-control" autocomplete="off" name="points" value="{{old('points',$player->points)}}" min="0">
                    </div>
                    
                    <div class="form-group col-md-2 col-xs-12">
                        <label>Agent Code</label>
                        <input type="text" class="form-control" placeholder="Agent Code" autocomplete="off" name="agent_code" value="{{old('agent_code',$player->agent_code)}}">
                    </div>
                	</div>
            </div>
            <div class="panel-footer">
                <div class="row"> 
                    <div class="col-12 text-right">
                        <a href="{{route('players.index')}}" class="btn btn-default btn-outline">Back</a>
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
<link rel="stylesheet" href="{{asset('global/vendor/magnific-popup/magnific-popup.css')}}">
@endpush
@push('scripts')
   <script src="{{asset('global/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
   <script src="{{asset('global/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
   <script src="{{asset('global/js/Plugin/magnific-popup.js')}}"></script>
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