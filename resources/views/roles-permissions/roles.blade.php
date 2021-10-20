@extends('commons.layout')
@section('title')
    Roles and Permissions
@endsection
@section('page-title')
	Roles and Permissions
@endsection
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">System Management</li>
<li class="breadcrumb-item active">Roles Management</li>
@endsection
@section('page-content')
	<div class="page-content">
		<div class="row">
			<div class="col-lg-6 col-xl-6 col-md-6 col-xs-12">
				<div class="panel">
					<header class="panel-heading">
						<h3 class="panel-title">Roles</h3>
					
						@if(auth()->user()->hasPermissionTo('create role'))
						<div class="panel-actions">
	                  		<button class="btn btn-sm btn-outline btn-primary" id="add-role-btn" data-title="Add new role" aria-hidden="true">Add role</button>
		                </div>
						@endif
					</header>
					<div class="panel-body">
						<div class="wrap">
							<p>Click on the name of the role to view its assigned permissions</p>
							<div class="h-300 permission-list-container" data-plugin="scrollable" data-direction="vertical">
								<div data-role="container">
									<div data-role="content">
										<div class="list-group bg-blue-grey-100 bg-inherit  roles-container">
											@forelse ($roles as $roleKey => $role)
												<li class="list-group-item {{ $loop->first ? "active" : ""}}" >
													<a class="roles cursor-pointer" data-id={{$role->id}}>
														<i class="icon wb-user " aria-hidden="true"></i><span class="role-name">{{$role->name}}</span>
													</a>
													<div class="btn-group float-right">
														@if(auth()->user()->hasPermissionTo('assign permission'))
														<button class="btn btn-icon btn-sm btn-pure assign-permission" title="Assign Permission" data-url="{{url('raven/roles-and-permissions/'.$role->id .'/edit')}}">
															<i class="icon wb-plus" aria-hidden="true"></i>
														</button>
														@endif
														@if(auth()->user()->hasPermissionTo('update role'))
														<button class="btn btn-icon btn-sm btn-pure edit-role" data-id="{{$role->id}}" data-name="{{$role->name}}" title="Change role name">
															<i class="icon wb-edit" aria-hidden="true"></i>
														</button>
														@endif
														@if(auth()->user()->hasPermissionTo('delete role'))
														<button class="btn btn-icon btn-sm btn-pure delete-role-btn" title="Remove role" data-url="{{ url('raven/roles-and-permissions/' . $role->id) }}">
															<i class="icon wb-trash" aria-hidden="true"></i>
														</button>
														@endif
													</div>
												

												</li>
											@empty
												<p>No roles found</p>
											@endforelse
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-6 col-md-6 col-xs-12">
				<div class="panel">
					<header class="panel-heading">
						<h3 class="panel-title">Permissions</h3>
					</header>
					<div class="panel-body">
						<p>The list of permissions assigned to the selected role</p>
						<div class="wrap">
							<div class="h-300 permission-list-container" data-plugin="scrollable" data-direction="vertical">
								<div data-role="container">
									<div data-role="content">
										<div class="list-group bg-blue-grey-100 bg-inherit permission-list">
											<li class="list-group-item blue-grey-500 active" href="javascript:void(0)">
												<i class="icon wb-user" aria-hidden="true"></i> Administrator 1
											</li>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Panel Basic -->
		</div>
	</div>
	@include('roles-permissions.modals.add-role')
@endsection
@push('scripts')
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{asset('app/js/admin/users/roles.js')}}"></script>
	<script src="{{asset('app/js/admin/users/users-management.js')}}"></script>
@endpush