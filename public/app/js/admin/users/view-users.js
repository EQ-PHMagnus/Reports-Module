    var forApprovalTable = $('#ForApprovalTable').DataTable({
        dom: 'Blfrtip',
        // scrollX: true,
        "aaSorting": [],
        'processing': false,
        'serverSide': true,
        "paging": true, 
        'bFilter':true,
        'serverMethod': 'post',
        'ajax': {
            'url': adminUrl + '/get-applicant-list/0',
        },
        'buttons':[
          {
              extend: 'excel',
              text: 'Export',
              className: 'btn-primary export-btn',
              exportOptions: {
                  columns: 'th:not(.not-exported)',
                  modifier : {
                      // DataTables core
                      order : 'index',  // 'current', 'applied', 'index',  'original'
                      page : 'all',      // 'all',     'current'
                      search : 'none'     // 'none',    'applied', 'removed'
                  }
              }
          }
        ],
        'columns': [
            { data: null },
            { data: null },
            { data: 'email' },
            { data: 'username'},
            { data: 'reference_no' },
            { data: 'registration_type' },
            { data: 'created_at' },
            { data: null }
        ],
        'columnDefs' : [
          {
              "searchable": false,
              "orderable": false,
              "targets": 0,

          },
          {
            'targets' : 1,
            'render' : function ( url, type, full) {
              return full['first_name'] + ' ' + full['last_name'];
            }
          },
          {
            'targets' : 5,
            'render' : function ( url, type, full) {
              return full['registration_type'] == 1 ? 'Commissionship' : 'Enlistment';
            }
          },
          {
            'targets' : 7,
            'render' : function ( url, type, full) {
                var actionButtons = `<div class="actions text-center">`;
                if (full['actions'] && full['actions']['view-details']){
                    actionButtons += `<button data-name="user" data-url="${full['actions']['view-details']}" class="btn btn-danger btn-details m-2" data-toggle="modal" data-target="#previewModal"> View Details </button>`
                }
                if (full['actions'] && full['actions']['edit-details']){
                    actionButtons += `<a href="${full['actions']['edit-details']}" target="_blank" class="btn btn-danger"> Edit Details </a>`
                }
                actionButtons += `</div>`;
        
              return actionButtons;
            }
          },
        ],
        "lengthMenu": [[10, 25, 50, 100, 200, 500, -1], [10, 25, 50, 100, 200, 500, "All"]],
         orderCellsTop: true,
         fixedHeader: false,
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['nosort']
        }],
        "order": [[ 1, 'asc' ]]
    });

    forApprovalTable.on( 'draw.dt', function () {
        var PageInfo = forApprovalTable.page.info();
        forApprovalTable.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    } ).draw();

    var approvedTable = $('#ApprovedTable').DataTable({
        dom: 'Blfrtip',
        // scrollX: true,
        "aaSorting": [],
        'processing': false,
        'serverSide': true,
        "paging": true, 
        'bFilter':true,
        'serverMethod': 'post',
        'ajax': {
            'url': adminUrl + '/get-applicant-list/1',
        },
        'buttons':[
            {
                extend: 'excel',
                text: 'Export',
                className: 'btn-primary export-btn',
                exportOptions: {
                    columns: 'th:not(.not-exported)',
                    modifier : {
                        // DataTables core
                        order : 'index',  // 'current', 'applied', 'index',  'original'
                        page : 'all',      // 'all',     'current'
                        search : 'none'     // 'none',    'applied', 'removed'
                    }
                }
            }
          ],
          'columns': [
              { data: null },
              { data: null },
              { data: 'email' },
              { data: 'username'},
              { data: 'reference_no' },
              { data: 'registration_type' },
              { data: 'created_at' },
              { data: null }
          ],
          'columnDefs' : [
            {
                "searchable": false,
                "orderable": false,
                "targets": 0
            },
            {
              'targets' : 1,
              'render' : function ( url, type, full) {
                return full['first_name'] + ' ' + full['last_name'];
              }
            },
            {
              'targets' : 5,
              'render' : function ( url, type, full) {
                return full['registration_type'] == 1 ? 'Commissionship' : 'Enlistment';
              }
            },
            {
              'targets' : 7,
              'render' : function ( url, type, full) {
                  var actionButtons = `<div class="actions text-center">`;
                  if (full['actions'] && full['actions']['view-details']){
                      actionButtons += `<button data-name="user" data-url="${full['actions']['view-details']}" class="btn btn-danger btn-details m-2" data-toggle="modal" data-target="#previewModal"> View Details </button>`
                  }
                  if (full['actions'] && full['actions']['edit-details']){
                      actionButtons += `<a href="${full['actions']['edit-details']}" target="_blank" class="btn btn-danger"> Edit Details </a>`
                  }
                  actionButtons += `</div>`;
          
                return actionButtons;
              }
            },
          ],
          "lengthMenu": [[10, 25, 50, 100, 200, 500, -1], [10, 25, 50, 100, 200, 500, "All"]],
           orderCellsTop: true,
           fixedHeader: false,
          'aoColumnDefs': [{
              'bSortable': false,
              'aTargets': ['nosort']
          }],
          "order": [[ 1, 'asc' ]]
    });

    approvedTable.on( 'draw.dt', function () {
        var PageInfo = approvedTable.page.info();
        approvedTable.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    } ).draw();

    var rejectedTable = $('#RejectedTable').DataTable({
        dom: 'Blfrtip',
        // scrollX: true,
        "aaSorting": [],
        'processing': false,
        'serverSide': true,
        "paging": true, 
        'bFilter':true,
        'serverMethod': 'post',
        'ajax': {
            'url': adminUrl + '/get-applicant-list/2',
        },
        'buttons':[
            {
                extend: 'excel',
                text: 'Export',
                className: 'btn-primary export-btn',
                exportOptions: {
                    columns: 'th:not(.not-exported)',
                    modifier : {
                        // DataTables core
                        order : 'index',  // 'current', 'applied', 'index',  'original'
                        page : 'all',      // 'all',     'current'
                        search : 'none'     // 'none',    'applied', 'removed'
                    }
                }
            }
          ],
          'columns': [
              { data: null },
              { data: null },
              { data: 'email' },
              { data: 'username'},
              { data: 'reference_no' },
              { data: 'registration_type' },
              { data: 'created_at' },
              { data: 'updated_at' }
          ],
          'columnDefs' : [
            {
                "searchable": false,
                "orderable": false,
                "targets": 0
            },
            {
              'targets' : 1,
              'render' : function ( url, type, full) {
                return full['first_name'] + ' ' + full['last_name'];
              }
            },
            {
              'targets' : 5,
              'render' : function ( url, type, full) {
                return full['registration_type'] == 1 ? 'Commissionship' : 'Enlistment';
              }
            },
          ],
          "lengthMenu": [[10, 25, 50, 100, 200, 500, -1], [10, 25, 50, 100, 200, 500, "All"]],
           orderCellsTop: true,
           fixedHeader: false,
          'aoColumnDefs': [{
              'bSortable': false,
              'aTargets': ['nosort']
          }],
          "order": [[ 1, 'asc' ]]
    });

    rejectedTable.on( 'draw.dt', function () {
        var PageInfo = rejectedTable.page.info();
        rejectedTable.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    } ).draw();

    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );

    $('.dt-buttons').addClass('float-right');
    $('.dataTables_filter').addClass('mt-2');
