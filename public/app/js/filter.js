
function dataRequest(params) {

    var obj = {};
    $('.filters').each(function(){
        obj[$(this).attr('name')] = $(this).val();
    });
    params.data['filters'] = obj;
    var operator = '?';
    var loc = window.location.href
    if(window.location.href.indexOf('?') > -1){
        operator = '&';
    }
    jQuery.get(loc.replace('#', '') + operator + $.param(params.data)).then(function(res) {
        params.success(res);
    });
}

function exportReports() {

    var params       = {};
    var obj          = {};
    params['data']   = {};
    $('.filters').each(function(){
        obj[$(this).attr('name')] = $(this).val();
    });
    params.data['filters'] = obj;
    return location.href = window.location.href + '?' + $.param(params.data) + '&export=true';
}

// FOR LIST
$(document).on('click','.btn-filter-search',function () {
    $('table[data-toggle="table"]').bootstrapTable('refresh');
});

$(document).on('click', '.btn-filter-export', exportReports);

// search
$(document).on('keyup','.search input',function () {
    $('table[data-toggle="table"]').bootstrapTable('refresh');
});