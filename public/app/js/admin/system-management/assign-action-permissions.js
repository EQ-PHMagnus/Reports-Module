$(document).ready(function() {
	/**
	 * Initialize multiselect function
	 */
	$('#select-permisssions').multiSelect({
		 selectableHeader: "<div class='custom-header'>Available Permissions</div>",
		 selectionHeader: "<div class='custom-header'>Selected Permission</div>",
	});

	/**
	 * Add permission
	 */
	$("#add-permission-btn").off('click').click(function(event) {
		event.preventDefault();
		// Add role swal
		swal({
			text: 'Enter the kind of the permission you want to add.',
			content: {
				  	element: "input",
			    	attributes: {
				      	placeholder: "Permission short description",
				      	type: "text",
				      	name: "permission",
						autocomplete : 'off',
						class: "permission_names"
			  		},
			},
			button: {
				text: "Add",
				closeModal: false,
			},
		})
		.then(permission_name => {
			if (!permission_name) throw swal(`Permission name cannot be empty.`);

			let params = {
				_token : $("meta[name='csrf-token']").attr('content'),
				permission_name : permission_name
			};

			let newPermission =  axios({
				method: 'post',
				url: `${baseUrl}/permissions-and-routes`,
				data: params,
			}).then(res =>{
				let permission = res.data.data;
				swal(`Permission added successfully`);
				$('#select-permisssions').multiSelect('addOption', { value: permission.id, text: permission.name, index: 0 });
			}).catch((err) => {
				let error = err.response.data.errors.permission_name[0];
				swal(`Failed to add permission.${error}`);
			});
		});
	});

	/**
	 * Select All
	 */
	 $('#select-all-permission-btn').click(function(){
		$('#select-permisssions').multiSelect('select_all');
		return false;
	});
	/**
	 * Deselect All
	 */
	$('#deselect-all-permission-btn').click(function(){
		$('#select-permisssions').multiSelect('deselect_all');
		return false;
	});
	/**
	 * Refresh selection
	 */
	 $('#refresh-btn').on('click', function(){
	   $('#select-permisssions').multiSelect('refresh');
	   return false;
	 });

	 /**
	  * Submit Assignment
	  */
	 $(".assign-permissions-btn").click(function(event) {
	 	event.preventDefault();
		let route_name = $(this).data('route-name');
		
		swal({
	        title: 'Are you sure?',
	        text: `Assign all these permission to action "${route_name}"`,
	        type: 'warning',
	        buttons: {
	            cancel: true,
	            confirm: true,
	        },
	    }).then(confirm => {
			if(!confirm) return null;

			$("#assign-permission-form").submit();
		});
	 });
});
