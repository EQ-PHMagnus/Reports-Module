function destroyModel(e){
	e.preventDefault();

	const url = $(this).data('url');
	console.log(url);
	Swal.fire({
	  	title: 'Are you sure you want to delete this record?',
	  	showDenyButton: false,
	  	showCancelButton: true,
	  	confirmButtonText: 'Yes',
	  	denyButtonText: `No`,
	}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
	  	if (result.isConfirmed) {
		    const deleteModel = new Promise((resolve,reject) => {
				$.ajax({
			        url, 
			        type: 'DELETE',
			        dataType: "JSON",
			        success:(data) => { resolve(data) },
			        error : (error) => { reject(error.statusText || 'Something went wrong!') }
				});
			});

			deleteModel.then((res) => {
	    		Swal.fire({
				  icon: 'success',
				  title: 'Success',
				  text: 'Record deleted successfully!',
				  showConfirmButton : false
				});
				location.reload();
	    	}).catch((error) => {
	    		Swal.fire({
				  icon: 'Error',
				  title: 'Oops. Something went wrong!',
				  text: error
				});
	    	})
	  	}
	});
	
	e.stopPropagation();
}

