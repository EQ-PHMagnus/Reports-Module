$(document).ready(function () {
    // filter functions
    $(document).on('click','.btn-filter',function () {
        $('table[data-toggle="table"]').bootstrapTable('refresh');
    }); 
});