

$(document).on('click', '.btn-confirmation', function (){
    
    var url           = $(this).data('url');
    var id            = $(this).data('id');
    var confirmation  = $(this).data('type');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3e8ef7',
        cancelButtonColor: '#c25811',
        confirmButtonText: confirmation + ' deposit'
        }).then((result) => {
            if (result.value) {
            $.ajax({
                type: 'PUT',
                url:  url,
                data:{
                '_token': $('input[name=_token]').val(),
                'id': id,
                'type': confirmation },
                success: function(data){
                    Swal.fire(
                    confirmation,
                    confirmation + 'has been approved.',
                    'success')
                    $('table[data-toggle="table"]').bootstrapTable('refresh');
                }
            })
        }
    });

});

