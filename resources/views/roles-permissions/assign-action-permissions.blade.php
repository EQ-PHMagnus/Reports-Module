@extends('commons.layout')
@section('title')
    Assign Permission
@endsection
@section('page-title')
	Assign Permission
@endsection
@push('css')
	<link rel="stylesheet" href="{{asset('global/vendor/multi-select/multi-select.css')}}">
	<link rel="stylesheet" href="{{asset('global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css')}}">
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">System Management</li>
<li class="breadcrumb-item active">Assign Permissions</li>
@endsection
@section('page-content')
	<div class="page-content">
		<div class="row">
			<div class="col-12">
				<div class="panel">
					<header class="panel-heading">
						<h3 class="panel-title">Assign permissions to route "{{$routeName}}"</h3>
						<div class="panel-actions">
							<a href="{{url('res/permissions-and-actions')}}"class="btn btn-sm btn-outline btn-default" data-toggle="tooltip" data-title="Go back" aria-hidden="true">Back</a>
							<button class="btn btn-sm btn-outline btn-primary assign-permissions-btn" data-route-name="{{$routeName}}" data-toggle="tooltip" data-title="Save assignment" aria-hidden="true">Save</button>
						</div>
					</header>
					<div class="panel-body">
						<form id="assign-permission-form" action="{{url('res/permissions-and-actions/'.$routeName)}}" method="POST">
							<div class="wrap permissons-page">
								{{csrf_field()}}
								<input type="hidden" name="_method" value="PATCH"/>
								<select class="multi-select form-control" name="permissions[]" multiple='multiple' id="select-permisssions">
			                      	@forelse($permissions as $permissionKey => $permission)
										<option value="{{$permission->id}}" {{in_array($permission->id,$permissionByAction) ? "SELECTED" : ""}}>{{$permission->name}}</option>
									@empty
										<option value="" disabled>No Permissions found</option>
									@endempty
			                    </select>
							</div>
							<input type="hidden" name="route_name" value="{{$routeName}}">
						</form>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-6">
								<button class="btn btn-primary btn-outline btn-sm" id="select-all-permission-btn" type="button">select all</button>
								<button class="btn btn-primary btn-outline btn-sm" id="deselect-all-permission-btn" type="button">deselect all</button>
								<button class="btn btn-primary btn-outline btn-sm" id="add-permission-btn" type="button">Add Permission</button>
							</div>
							<div class="col-md-6 text-right">
								<a href="{{url('res/permissions-and-actions')}}"class="btn btn-sm btn-outline btn-default" data-toggle="tooltip" data-title="Go back" aria-hidden="true">Back</a>
			                  	<button class="btn btn-sm btn-outline btn-primary assign-permissions-btn" data-route-name="{{$routeName}}" data-toggle="tooltip" data-title="Save assignment" aria-hidden="true">Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Panel Basic -->
		</div>
	</div>
@endsection
@push('scripts')
	<script src="{{asset('global/vendor/multi-select/jquery.multi-select.js')}}"></script>
	<script src="{{asset('global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.js')}}"></script>
    <script src="{{asset('app/js/admin/system-management/assign-action-permissions.js')}}"></script>
@endpush
