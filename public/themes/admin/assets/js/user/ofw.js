/**
 * Returns the name of the currently set context.
 *
 * @author name <christian.labini@republisys.com>
 * @date 26-Aug-2015
 */


/**
 * This method show the data tables for user list module.
 *
 * @param.
 *
 * @return void
 */
$(document).ready(function ()
{


    $('#SearchMyBills').keyup(function(){
        $('#tblOFW').dataTable().fnFilter($(this).val());
    });

    var BASE_URL = $('#hdnBaseUrl').val();


    $('#tblOFW').dataTable({
        "aaSorting": [[ 5, "desc" ]],
        "bAutoWidth": false,
        "sDom": '<"top"f>rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/users/ajax?type=batch-list",
        "lengthMenu": [
            [ 10, 50, -1],
            [ 15, 50, "All"]
        ],
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": false },
            { "aTargets": [ 2 ], "bSortable": false },
            { "aTargets": [ 3 ], "bSortable": true },
            { "aTargets": [ 4 ], "bSortable": false }
        ],
        "order": [0, 'desc'],

        "fnRowCallback": function (row, data, index)
        {
            if (data[6] == 'Active') {
                $(row).addClass('highlight');
            } else {
                $(row).addClass('gray');
            }
        },
        "language": {
            //Hide Previous and Next in DataTable
            "paginate": {
                "previous": "<div class = 'prevBtn'></div>",
                "next": "<div class = 'nextBtn'></div>"
            }
        },
        /**
         * Fills datatable with empty rows
         *
         * Set default Table size when Table is empty
         */
        "fnDrawCallback": function (oSettings)
        {
            var total_count = oSettings.fnRecordsTotal();
            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
            var show_num = oSettings._iDisplayLength;
            var tr_count = $(this).children('tbody').children('tr').length;
            var missing = show_num - tr_count;

            //Set default Table size when Table is empty
            if (show_num < total_count && missing > 0) {
                for (var i = 0; i < missing; i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else if (show_num > total_count) {
                for (var i = 0; i < (show_num - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else if (total_count == 0) {
                for (var i = 0; i < (14 - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            }
        }
    });

    $('#tblOFW').on('click',' #ofw-registration', function(e){
        e.preventDefault();
        $('#name, #username, #email, #amount, .total-list, .total-amount, .batch-id').empty();

        var id = $(this).data("id");
        var res = [];
        var total_amount = [];
        $.ajax({
            url: 'ofw/getOFWList/'+id,
            method: 'get',
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            data: id,
            beforeSend: function () {
                $().iseziloading('show');
            },
            success: function (data) {
                $().iseziloading('hide');
                $('#batchListModal').modal('show');
                $.each(data, function(index, ofw) {
                    var exists = '';
                    if(ofw.isExisting){
                        exists = '(Existing)'
                    }

                    var count = index +1;
                    $('#name').append(count+'. '+ofw.name+'<br/>');
                    $('#username').append(ofw.username+exists+'<br/>');
                    $('#email').append(ofw.email+exists+'<br/>');
                    $('#amount').append(ofw.amount+'<br/>');
                    res.push(count);
                    total_amount.push(ofw.total_amount);
                });
                $('.batch-id').append(id);
                $('.total-list').append(res[res.length-1]);
                $('.total-amount').append(total_amount[total_amount.length-1]);
            }
        });

    });

    var ofwList = [];
    var totalList = 0;

    function ofwBatch(){
        this.firstName                 = '';
        this.lastName                  = '';
        this.username                  = '';
        this.email                     = '';
        this.country                   = '';
        this.state                     = '';
        this.salutation                = '';
        this.ofwId                     = '';
        this.batchID                   = '';
    }

    function saveOfwBatch(ofw){
        var ofwBatchList = new ofwBatch();
        ofwBatchList.firstName = ofw.firstName;
        ofwBatchList.lastName = ofw.lastName;
        ofwBatchList.username = ofw.username;
        ofwBatchList.email = ofw.email;
        ofwBatchList.country = ofw.countryId;
        ofwBatchList.state = ofw.stateId;
        ofwBatchList.salutation = ofw.salutation;
        ofwBatchList.ofwId = ofw.ofwId;
        ofwBatchList.batchID = ofw.batchID;
        return ofwBatchList;
    }

    $('#tblOFW').on('click','#ofw-process', function(e){
        e.preventDefault();
        /*$('#name, #username, #email, #amount, .total-list, .total-amount, .batch-id').empty();*/
        $('#processModal').modal('show');
        $('#text-w').html('Are you sure you want to process?');
        $('#confirm-process').click(function(){
            var id = $('#ofw-process').data("id");
            var res = [];
            var total_amount = [];
            $.ajax({
                url: 'ofw/getOFWList/'+id,
                method: 'get',
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: id,
                beforeSend: function () {
                    $().iseziloading('show');
                },
                success: function (data) {
                    $().iseziloading('hide');
                    $.each(data, function(index, ofw) {
                        if(!ofw.isExisting){
                            ofwList[totalList] = saveOfwBatch(ofw);
                            totalList++;
                        }
                    });

                    var formData = new FormData();
                    formData.append('ofwDetails', JSON.stringify({details:ofwList}));

                    $.ajax({
                        url: 'ofwRegistration',
                        method: 'post',
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: 'json',
                        data: formData,
                        beforeSend: function () {
                            $().iseziloading('show');
                        },
                        success: function (data) {
                            $().iseziloading('hide');
                            dtReload();
                        }
                    });

                }
            });
        })

    });

    $('#tblOFW').on('click','#ofw-reload', function(e){
        e.preventDefault();
        $('#processModal').modal('show');
        $('#text-w').html('Are you sure you want to reload?');
        $('#confirm-process').click(function(){
            var id = $('#ofw-reload').data("id");
            var res = [];
            var total_amount = [];
            $.ajax({
                url: 'ofw/getOFWList/'+id,
                method: 'get',
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                data: id,
                beforeSend: function () {
                    $().iseziloading('show');
                },
                success: function (data) {
                    $.each(data, function(index, ofw) {

                        var formData = new FormData();
                        formData.append('user_username', ofw.username);
                        formData.append('user_amount', ofw.amount);
                        dtReload();
                        $().iseziloading('hide');
                        $.ajax({
                            url: 'ofwReload',
                            method: 'post',
                            processData: false,
                            contentType: false,
                            cache: false,
                            dataType: 'json',
                            data: formData,
                            beforeSend: function () {
                            },
                            success: function (data) {

                            }
                        });

                    });

                }
            });
        });

    });


});

function CloseModal()
{
    $.fn.colorbox.close();
}

function dtReload(){
    $('#tblOFW').dataTable().fnDestroy();
    $('#tblOFW').dataTable({
        "aaSorting": [[ 5, "desc" ]],
        "bAutoWidth": false,
        "sDom": '<"top"f>rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/users/ajax?type=batch-list",
        "lengthMenu": [
            [ 12, 50, -1],
            [ 15, 50, "All"]
        ],
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": true },
            { "aTargets": [ 4 ], "bSortable": false }
        ],
        "order": [0, 'desc'],

        "fnRowCallback": function (row, data, index)
        {
            if (data[6] == 'Active') {
                $(row).addClass('highlight');
            } else {
                $(row).addClass('gray');
            }
        },
        "language": {
            //Hide Previous and Next in DataTable
            "paginate": {
                "previous": "<div class = 'prevBtn'></div>",
                "next": "<div class = 'nextBtn'></div>"
            }
        },
        /**
         * Fills datatable with empty rows
         *
         * Set default Table size when Table is empty
         */
        "fnDrawCallback": function (oSettings)
        {
            var total_count = oSettings.fnRecordsTotal();
            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
            var show_num = oSettings._iDisplayLength;
            var tr_count = $(this).children('tbody').children('tr').length;
            var missing = show_num - tr_count;

            //Set default Table size when Table is empty
            if (show_num < total_count && missing > 0) {
                for (var i = 0; i < missing; i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else if (show_num > total_count) {
                for (var i = 0; i < (show_num - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else if (total_count == 0) {
                for (var i = 0; i < (14 - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            }
        }
    });
}



function dtReload(){
    var BASE_URL = $('#hdnBaseUrl').val();
    $('#tblOFW').dataTable().fnDestroy();
    $('#tblOFW').dataTable({
        "aaSorting": [[ 5, "desc" ]],
        "bAutoWidth": false,
        "sDom": '<"top"f>rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/users/ajax?type=batch-list",
        "lengthMenu": [
            [ 12, 50, -1],
            [ 15, 50, "All"]
        ],
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": true },
            { "aTargets": [ 4 ], "bSortable": false }
        ],
        "order": [0, 'desc'],

        "fnRowCallback": function (row, data, index)
        {
            if (data[6] == 'Active') {
                $(row).addClass('highlight');
            } else {
                $(row).addClass('gray');
            }
        },
        "language": {
            //Hide Previous and Next in DataTable
            "paginate": {
                "previous": "<div class = 'prevBtn'></div>",
                "next": "<div class = 'nextBtn'></div>"
            }
        },
        /**
         * Fills datatable with empty rows
         *
         * Set default Table size when Table is empty
         */
        "fnDrawCallback": function (oSettings)
        {
            var total_count = oSettings.fnRecordsTotal();
            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
            var show_num = oSettings._iDisplayLength;
            var tr_count = $(this).children('tbody').children('tr').length;
            var missing = show_num - tr_count;

            //Set default Table size when Table is empty
            if (show_num < total_count && missing > 0) {
                for (var i = 0; i < missing; i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else if (show_num > total_count) {
                for (var i = 0; i < (show_num - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else if (total_count == 0) {
                for (var i = 0; i < (14 - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            }
        }
    });
}