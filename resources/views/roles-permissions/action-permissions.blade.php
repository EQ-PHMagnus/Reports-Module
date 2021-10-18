@extends('commons.layout')
@section('title')
    Actions and Permissions
@endsection
@section('page-title')
	Actions and Permissions
@endsection
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">System Management</li>
<li class="breadcrumb-item active">Actions and Permissions</li>
@endsection
@section('page-content')
	<div class="page-content">
		<div class="row">
			<div class="col-lg-6 col-xl-6 col-xs-12">
				<div class="panel">
					<header class="panel-heading">
						<h3 class="panel-title">Actions</h3>
					</header>
					<div class="panel-body">
						<div class="wrap">
							<p>Click on the action names to view its assigned permissions</p>
							<div class="h-300 permission-list-container" data-plugin="scrollable" data-direction="vertical">
								<div data-role="container">
									<div data-role="content">
										@forelse ($permissableRoutes as $routeKeyName => $routes)
											<div class="card mb-0">
												<div class="card-header">
													<strong>{{$routeKeyName}}</strong>
												</div>
												<div class="card-body p-0">
													<ul class="list-group bg-inherit  routes-container">
														@forelse ($routes as $route)
														<li class="list-group-item" >
															<a class="actions cursor-pointer pl-10" data-action-name="{{$routeKeyName .'.'.$route}}">
																<span class="action-name">{{$route}}</span>
															</a>
															<div class="btn-group float-right">
																<button class="btn btn-icon btn-sm btn-pure assign-permission" data-toggle="tooltip" data-title="Assign Permission" data-url="{{url('res/permissions-and-actions/'. $routeKeyName . '.' . $route .'/edit')}}">
																	<i class="icon wb-plus" aria-hidden="true"></i>
																</button>
															</div>
														</li>
														@empty
														@endforelse
													</ul>
												</div>
											</div>
										@empty
											<p>No routes found</p
										@endforelse
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-6 col-xs-12">
				<div class="panel">
					<header class="panel-heading">
						<h3 class="panel-title">Permissions</h3>
					</header>
					<div class="panel-body">
						<p>The list of permissions assigned to the selected action</p>
						<div class="wrap">
							<div class="h-300 permission-list-container" data-plugin="scrollable" data-direction="vertical">
								<div data-role="container">
									<div data-role="content">
										<div class="list-group bg-blue-grey-100 bg-inherit permission-list">
											<li class="list-group-item blue-grey-500 active" href="javascript:void(0)">
												No permissions assigned
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
@endsection
@push('scripts')
    <script src="{{asset('app/js/admin/system-management/action-permissions.js')}}"></script>
@endpush
