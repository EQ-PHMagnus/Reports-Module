function hasDecimal (num) {
	return !!(num % 1);
}

// Fetch info
async function fetchInfo(url) {
    return await $.get(url, function (json) {
        return json;
    })
}

// Delete Item
async function deleteItem(url, token, isReload = true) {
    return await swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this action.",
        icon: 'warning',
        buttons: {
            cancel: true,
            confirm: true,
        },
    }).then(function (result) {
        if (result) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: token,
                    _method: 'DELETE'
                },
                statusCode: {
                    204: function (xhr) {
                        swal({
                            title: "Success",
                            text: "Review is successfully deleted.",
                            icon:"success"
                        }).then(function (confirm) {
                            if (isReload) {
                                window.location.reload();
                            }

                            return true;
                        });
                    },
                    500: function (xhr) {
                        swal({
                            title: "Error!",
                            type: "error"
                        }).then(function (confirm) {
                            if (isReload) {
                                window.location.reload();
                            }

                            return false;
                        });
                    }
                }
            });
            return result;
        }

    });
}

function isEmpty(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

// const access_token = Cookie._get('session');
//Create axios instance;
// const apiRequest = axios.create({
//     baseURL: `${baseURL}/`,
//     timeout: 1000,
//     headers: {
//         'Authorization': Cookie._get('session')
//     }
// });

function formatMoney(n, c, d, t) {
    c = isNaN(c = Math.abs(c)) ? 2 : c;
    d = d == undefined ? "." : d;
    t = t == undefined ? "," : t;
    s = n < 0 ? "-" : "";
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c)));
    j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

function removeMoneyFormat(a) {
    return (a == "") ? 0.00 : parseFloat(a.replace(/,/g, ''));
}

function computeSum(e) {
    let sum = 0;
    e.each(function () {
        let val = removeMoneyFormat($(this).val());
        sum = parseFloat(sum) + parseFloat(val);
    });

    return formatMoney(sum);
}

function isNormalInteger(str) {
    return /^\+?[1-9]\d*$/.test(str);
}

// Delete Item
async function deleteItem(url, token, isReload = true) {
    return await swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this",
        type: 'warning',
        buttons: {
            confirm: true,
            cancel: true,
        },
    }).then(function (result) {
        if (result) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: token,
                    _method: 'DELETE'
                },
                statusCode: {
                    204: function (xhr) {
                        swal({
                            title:"Success",
                            text:"Review is successfully deleted.",
                            icon: "success"
                        }).then(function (confirm) {
                            if (isReload) {
                                window.location.reload();
                            }

                            return true;
                        });
                    },
                    500: function (xhr) {
                        swal({
                            title: "Error!",
                            type: "error"
                        }).then(function (confirm) {
                            if (isReload) {
                                window.location.reload();
                            }
                            return false;
                        });
                    }
                }
            });
            return result;
        }

    });
}

// Approve Item
async function approveItem(url, token, isReload = true) {

    return await swal({
        title: 'Are you sure?',
        text: "Review will be approved.",
        icon: 'warning',
        buttons: {
            confirm: true,
            cancel: true,
        },
    }).then(function (result) {
        if (result) {
            swal({
                title: "Loading...",
                text: "Please wait while your request is being processed.",
                button: false,
                closeOnClickOutside: false
            });
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: token
                },
                success: function (xml, textStatus, xhr) {
                    if (xhr.status == '200') {
                        swal({
                            title: "Success",
                            text: "Review is successfully set as approved.",
                            icon:"success"

                        }).then(function (confirm) {
                            if (isReload) {
                                window.location.reload();
                            }

                            return true;
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal({
                        title: "Error!",
                        text: "Approving item has been interrupted",
                        icon: 'warning',
                    }).then(function (confirm) {
                        if (isReload) {
                            window.location.reload();
                        }
                        return true;
                    });
                },

            });
            return result;
        }

    });
}

// reject Item
async function rejectItem(url, token, isReload = true) {

    return await swal({
        title: 'Are you sure?',
        text: "Review will be rejected.",
        icon: 'warning',
        buttons: {
            confirm: true,
            cancel: true,
        },
    }).then(function (result) {
        if (result) {
            swal({
                title: "Loading...",
                text: "Please wait while your request is being processed.",
                button: false,
                closeOnClickOutside: false
            });
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: token
                },
                success: function (xml, textStatus, xhr) {
                    if (xhr.status == '200') {
                        swal({
                            title: "Success",
                            text:"Review is successfully set as rejected.",
                            icon: "success"

                        }).then(function (confirm) {
                            if (isReload) {
                                window.location.reload();
                            }

                            return true;
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal({
                        title: "Error!",
                        text: "Approving item has been interrupted",
                        icon: 'warning',
                    }).then(function (confirm) {
                        if (isReload) {
                            window.location.reload();
                        }
                        return true;
                    });
                },

            });
            return result;
        }

    });
}

$(document).ready(function () {
    $(".btn-link").click(function (event) {
        var link = $(this).data('href');
        window.location.href = link;
    });

    $(".numbers-only").keypress(function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    });
});

String.prototype.leftTrim = function () {
    return this.replace(/^\s+/, "");
}


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

function getDateToday(val){
    var d = new Date(),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

    if(val == 'm'){
        return month;
    }

    if(val == 'd'){
        return day;
    }

    if(val == 'y'){
        return year;
    }

}

function validateEmptyFields(){
    $('table').find('td.na').each (function() {
   
        if($(this).text() == '' || $(this).text() == null ){
            $(this).text('N/A');
        }
    });   

    $('table').find('td.na_file').each (function() {
        if($(this).html() == ''){
            $(this).html('N/A');
        }
    });   
}


function openFile(file) {

    if(file !== undefined || file !== '' || file !== null){
        var splitFile   = file.split(".");
        var extension   = splitFile[1];
    }else{
        var extension = '';
    }

    switch(extension) {
        case 'jpg':
        case 'png':
        case 'gif':
            return 'image';  // There's was a typo in the example where
        break;                         // the alert ended with pdf instead of gif.
        case 'zip':
        case 'rar':
            return 'file';
        break;
        case 'pdf':
            return 'pdf';
        break;
        default:
            return 'unknown';
    }
};

(function(document, window, $){
    'use strict';

    var Site = window.Site;
    $(document).ready(function(){
        if (Site){
            Site.run();
        }
    });
  })(document, window, jQuery);