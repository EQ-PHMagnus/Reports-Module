
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