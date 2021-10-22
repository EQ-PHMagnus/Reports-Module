function hasDecimal (num) {
	return !!(num % 1);
}

// Fetch info
async function fetchInfo(url) {
    return await $.get(url, function (json) {
        return json;
    })
}

function isEmpty(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

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

function openFile(file) {

    if(file !== undefined || file !== '' || file !== null){
        var splitFile   = file.split(".");
        var extension   = splitFile[1];
    }else{
        var extension = '';
    }

    switch(extension) {
        case 'csv':
        case 'xlsx':
            return 'excel';  
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


  