@extends('commons.layout')
@section('title')
    Assign Permission
@endsection
@section('page-title')
	Assign and Permissions
@endsection
@push('css')
	<link rel="stylesheet" href="{{asset('global/vendor/multi-select/multi-select.css')}}">
	<link rel="stylesheet" href="{{asset('global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css')}}">
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">System Management</li>
<li class="breadcrumb-item active">Assign And Permissions Management</li>
@endsection
@section('page-content')
	<div class="page-content">
		<div class="row">
			<div class="col-12">
				<div class="panel">
					<header class="panel-heading">
						<h3 class="panel-title">Assign permissions to role "{{$role->name}}"</h3>
						<div class="panel-actions">
							{{-- <a href="{{url('res/roles-and-permissions')}}"class="btn btn-sm btn-outline btn-default" data-toggle="tooltip" data-title="Go back" aria-hidden="true">Back</a> --}}
							{{-- <button class="btn btn-sm btn-outline btn-primary assign-permissions-btn" data-role-name="{{$role->name}}" id="" data-toggle="tooltip" data-title="Save assignment" aria-hidden="true">Save</button> --}}
						</div>
					</header>
					<div class="panel-body">

						<form id="assign-permission-form" action="{{url('raven/roles-and-permissions/assign-permissions')}}" method="POST">
							<div class="wrap permissons-page">
								{{csrf_field()}}
								<select class="multi-select form-control" name="permissions[]" multiple='multiple' id="select-permisssions">
			                      	@forelse($permissions as $permissionKey => $permission)
										<option value="{{$permission->id}}" {{$permissionByRole->contains($permission->id) ? "selected" : ""}}>{{$permission->name}}</option>
									@empty
										<option value="" disabled>No Permissions found</option>
									@endempty
			                    </select>
							</div>
							<input type="hidden" name="role_id" value="{{$role->id}}">
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
								<a href="{{url('raven/roles-and-permissions')}}"class="btn btn-sm btn-outline btn-default" data-toggle="tooltip" data-title="Go back" aria-hidden="true">Back</a>
								<button class="btn btn-sm btn-outline btn-primary assign-permissions-btn" data-role-name="{{$role->name}}" id="" data-toggle="tooltip" data-title="Save assignment" aria-hidden="true">Save</button>
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
    <script> const baseUrl = "{{asset('/')}}";</script>
    <script src="{{asset('app/js/admin/users/assign-permissions.js')}}"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
