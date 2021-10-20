$(document).ready(function(){
	const permissionListContainer = $(".permission-list-container");
	const permissionList = $(".permission-list");

	function addNewRole(role){
		return  `<li class="list-group-item" >
					<a class="roles cursor-pointer" data-id="${role.id}">
						<i class="icon wb-user" aria-hidden="true"></i>${role.name}
					</a>
					<div class="btn-group float-right">
						<button class="btn btn-icon btn-sm btn-pure assign-permission" data-toggle="tooltip" data-title="Assign Permission" data-url="${baseUrl}/roles-and-permissions/${role.id}/edit">
							<i class="icon wb-plus" aria-hidden="true"></i>
						</button>
						<button class="btn btn-icon btn-sm btn-pure edit-role" data-toggle="tooltip" data-title="Change role name">
							<i class="icon wb-edit" aria-hidden="true"></i>
						</button>
						<button class="btn btn-icon btn-sm btn-pure delete-role" data-toggle="tooltip" data-title="Remove role">
							<i class="icon wb-trash" aria-hidden="true"></i>
						</button>
					</div>
				</li>`;
	}

	function permissionListItem(permission){
		let listitem = `<li class="list-group-item blue-grey-500 active" href="javascript:void(0)">
			${permission.name}
		</li>`;
		return listitem;
	}

	function noPermissions(){
		let noPermissions = `<li class="list-group-item blue-grey-500 active" href="javascript:void(0)">
			No permissions assigned
		</li>`;
		permissionList.html(noPermissions);
	}

	function emptyPermissionsList(){
		permissionList.html('');
	}

	function listRolesWithPermissions(roleId = 1){
		let url = `${baseUrl}/roles-and-permissions/${roleId}`;
		//Clear List
		emptyPermissionsList();

		$.get(url,function(data){
			let permissions = data.data;
			console.log(!isEmpty(permissions));
			if(!isEmpty(permissions)){
				$.each(permissions,function(index, permissionData) {
					permissionList.append(permissionListItem(permissionData));
				});
			}else{
				noPermissions();
			}


		});



	}

	// Initial View Roles
	if($('.roles').length > 1){
		let role = $(".roles").first();
		let roleId = role.data('id');
		listRolesWithPermissions(roleId);
	}

	$("#add-role-btn").on('click',function(event) {
		event.preventDefault();
		// Add role swal
		swal({
			text: 'Enter the name of the role you want to add.',
			content: {
				  	element: "input",
			    	attributes: {
			      	placeholder: "Role name",
			      	type: "text",
			      	name: "role_name",
		  		},
			},
			button: {
				text: "Add",
				closeModal: false,
			},
		})
		.then(role_name => {
			if (!role_name) throw swal(`Role name cannot be empty.`);
			let params = {
				_token : $("meta[name='csrf-token']").attr('content'),
				'X-CSRF-TOKEN' : $("meta[name='csrf-token']").attr('content'),
				role_name : role_name
			};

			let role =  axios({
				method: 'post',
				url: `${baseUrl}/roles-and-permissions`,
				data: params,
			}).then(res =>{
				// console.log(res);
				role = res.data.data;
				swal(`Role added successfully`);
				$(".roles-container").append(addNewRole(role));
			}).catch((err) => {
				let error = err.response.data.errors.role_name[0];
				console.log(error);
				swal(`Failed to add role.${error}`);
			});
		});

	});
	//****Click events***//

	// View Permissions when role is clicked
	$(".roles").off('click').click(function(e){
		e.preventDefault();
		let roleId = $(this).data('id');

		$(".roles").closest('li').removeClass('active');
		$(this).closest('li').addClass('active');
		listRolesWithPermissions(roleId);
	});

	// Go to permissions view
	$(document).off('click',".assign-permission")
	.on('click',".assign-permission",function(e){
		e.preventDefault();
		let editUrl = $(this).data('url');
		location.href = editUrl;
	});

	//Edit role name
	$(document).off('click',".edit-role")
	.on('click',".edit-role",function(e){
		e.preventDefault();
		let roleId = $(this).data('id');
		let _role_name = $(this).data('name');
		let self = $(this);
		// Edit role name swal
		swal({
			text: 'Enter the new name of the role.',
			content: {
				  	element: "input",
			    	attributes: {
			      	placeholder: "Role name",
			      	type: "text",
			      	name: "role_name",
					value: _role_name
		  		},
			},
			button: {
				text: "Change",
				closeModal: false,
			},
		})
		.then(role_name => {
			if (!role_name) throw swal(`Role name cannot be empty.`);
			let params = {
				_token : $("meta[name='csrf-token']").attr('content'),
				_method: "PATCH",
				role_name : role_name
			};

			let role =  axios({
				method: 'post',
				url: `${baseUrl}/roles-and-permissions/${roleId}`,
				data: params,
			}).then(res =>{
				// console.log(res);
				role = res.data.data;
				self.closest('.list-group-item').find('.role-name').html(role.name);
				swal(`Role updated successfully`);
			}).catch((err) => {
				console.log(err);
				let error = err.response.data.errors.role_name[0];
				swal(`Failed to update role.${error}`);
			});
		});
	});

	//Delete role
	$(".delete-role-btn").click(function() {
        var url = $(this).data('url');
        var token = $("meta[name='csrf-token']").attr('content');
        deleteItem(url, token);
    });
});
