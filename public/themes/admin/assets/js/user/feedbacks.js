/**
 * Created by christian.labini on 10/23/15.
 */


$(document).ready(function ()
{


    $('#SearchMyBills').keyup(function(){
        $('#tblFeedbacks').dataTable().fnFilter($(this).val());
    });

    var BASE_URL = $('#hdnBaseUrl').val();
    loadDataTable();

    $('#tblFeedbacks').on('click','.view-feed', function(){
            var id = $(this).data('id');
            $.ajax({
               url: BASE_URL + "/admin/users/ajax?type=feedbacks-view&id="+id,
               method: 'get',
                beforeSend: function () {
                    $().iseziloading('show');
                },
                success: function(data){
                    $('#f_id').text(data.id);
                    $('#f_email').text(data.email);
                    $('#t_message').text(data.message);
                    $('#viewFeedBack').modal('show');
                    $().iseziloading('hide');

                    $.ajax({
                        url: BASE_URL + "/admin/users/ajax?type=feedbacks-update&Uid="+id,
                        method: 'get',
                        success: function(msg){
                            if(msg.result=='true'){
                            loadDataTable();
                            }
                        }
                    });


                }
            });
    });

    function loadDataTable(){
        $('#tblFeedbacks').dataTable().fnDestroy();
        $('#tblFeedbacks').dataTable({
            "aaSorting": [[ 5, "desc" ]],
            "bAutoWidth": false,
            "sDom": '<"top"f>rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/users/ajax?type=feedbacks-list",
            "lengthMenu": [
                [ 10, 50, -1],
                [ 15, 50, "All"]
            ],
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": false },
                { "aTargets": [ 2 ], "bSortable": false },
                { "aTargets": [ 3 ], "bSortable": false }
            ],
            "order": [0, 'asc'],

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
             *@include('emails.user.include.regards')
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

});