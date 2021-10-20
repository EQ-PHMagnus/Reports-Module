$(document).ready(function(){
	const permissionListContainer = $(".permission-list-container");
	const permissionList = $(".permission-list");

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

	function listPermissionsByAction(action){
		if(action){

			let url = `${baseUrl}/permissions-and-actions/${action}`;
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
		}else{
			noPermissions();
		}



	}


	//****Click events***//
	// View Permissions when role is clicked
	$(".actions").off('click').click(function(e){
		e.preventDefault();
		let actionName = $(this).data('action-name');

		$(".actions").closest('li').removeClass('active');
		$(this).closest('li').addClass('active');
		listPermissionsByAction(actionName);
	});

	// Go to permissions view
	$(document).off('click',".assign-permission")
	.on('click',".assign-permission",function(e){
		e.preventDefault();
		let editUrl = $(this).data('url');
		location.href = editUrl;
	});
});
