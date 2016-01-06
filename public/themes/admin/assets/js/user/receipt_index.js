/**
 * Returns the name of the currently set context.
 *
 * @author name <jimmy.buyco@estansaas.com>
 * @date 07-Nov-2014
 * @param
 * @return
 * @changes
 * @edited by
 */




/**
 * This method show the data tables for uploaded bills/rejected bills view.
 *
 * @param.
 *
 * @return void
 */


$(document).ready(function(){
    var BASE_URL = $('#hdnBaseUrl').val();


if(document.getElementById('status').value==1)
{
    document.getElementById('status').value="0";
}
if(document.getElementById('status').value==2)
{
       document.getElementById('status').value="0";
}

    $('#tblUploadedReceipts').dataTable({
        "sDom": '<"top"f>rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=bill-list",
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": false },
            { "aTargets": [ 1 ], "bSortable": false },
            { "aTargets": [ 2 ], "bSortable": false },
            { "aTargets": [ 3 ], "bSortable": true },
            { "aTargets": [ 4 ], "bSortable": false }
        ],
        "lengthMenu": [[ 12, 50, -1], [ 15, 50, "All"]],

        /*
	     * Fills datatable with missing rows
	     */
        "fnDrawCallback" : function(oSettings) {

	        var total_count = oSettings.fnRecordsTotal();
	            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
	            var show_num = oSettings._iDisplayLength;
	            var tr_count = $(this).children('tbody').children('tr').length;
	            var missing = show_num - tr_count;
	            if (show_num < total_count && missing > 0){
	              for(var i = 0; i < missing; i++){
	                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
	              }
	            }
	            else  if (show_num > total_count) {
	              for(var i = 0; i < (show_num - tr_count); i++) {
	                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
	              }
	            }

	            else if (total_count == 0) {
		            for(var i = 0; i < (14 - tr_count); i++) {
		                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
		            }
		        }

	     },
        "fnRowCallback": function ( row, data, index ) {
            if(data[4]==0)
            {
                $(row).addClass('highlight');
            }
            else
                $(row).addClass('gray');
            },
            "language": {
  			  "paginate": {
  			       "previous": "<div class = 'prevBtn'></div>",
  			       "next": "<div class = 'nextBtn'></div>"
  			   }
  	     }


    });

    $('#tblRejectedReceipts').dataTable({
        "sDom": '<"top"f>rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=rejectedReceipt-list",
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": true },
            { "aTargets": [ 4 ], "bSortable": false }
        ],
        "lengthMenu": [[ 12, 50, -1], [ 15, 50, "All"]],

        /*
	     * Fills datatable with missing rows 
	     */
        "fnDrawCallback" : function(oSettings) {
        	
	        var total_count = oSettings.fnRecordsTotal();
	            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
	            var show_num = oSettings._iDisplayLength;
	            var tr_count = $(this).children('tbody').children('tr').length;
	            var missing = show_num - tr_count;
	            if (show_num < total_count && missing > 0){
	              for(var i = 0; i < missing; i++){
	                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
	              }
	            }
	            else  if (show_num > total_count) {
	              for(var i = 0; i < (show_num - tr_count); i++) {
	                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
	              }
	            }
	            
	            else if (total_count == 0) {
		            for(var i = 0; i < (14 - tr_count); i++) {
		                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            }
		        }
	          
	     },
        "language": {
			  "paginate": {
			       "previous": "<div class = 'prevBtn'></div>",
			       "next": "<div class = 'nextBtn'></div>"
			   }
	     }
    });

        $("#tblRejectedReceipts").on('click', '.btn-view', function(e){
            e.preventDefault();
            var id = $(this).data('id');
             $.ajax({
                url: BASE_URL + "/admin/transaction/ajax?type=bill-url&id="+id,
                success: function(msg) {
                    document.getElementById("receipt_view").innerHTML="" +
                        "<table border='0' width=490px height='550px' align='center'>" +
                        "<tr height='5%'><td colspan='7'  style='background-color:#E3DCD3;'>**Reason for Rejection is: "+ msg.reason+"</td></tr><tr height='85%'><td colspan='7' align='center'>" +
                            "<img src='"+BASE_URL +""+msg.receiptLocation+"' alt='Image Not Found' width=350px height=350px>" +
                        "</td></tr><tr>" +
                        "<td  width='22%'></td>" +
                        "<td width='16%'><input type='button' value='Cancel' class='btn form-control btn-info btn-xs'  data-id="+id+" ></td>" +
                        "<td  width='5%'></td>"+
                        "<td width='15%'><input type='button' value='Approve' class='form-control btn-primary btn-xs'  data-id="+id+" ></td>" +
                        "<td  width='5%'></td>"+
                        "<td width='15%'><input type='button' value='Delete' class='form-control btn-danger btn-xs' data-id="+id+">" +
                        "</td><td width='22%'></td></tr></table>";
                }
            });

            $(this).colorbox({inline:true, width:"500px",height:"600px"});
        });

    $('#receipt_view').on('click', '.btn-primary', function(e){
        e.preventDefault();
        $.fn.colorbox.close();
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30%;'>Please confirm to Approve</div>",
            confirm: function(button) {
                $.ajax({
                    url: BASE_URL + "/admin/transaction/ajax?type=RejectedReceipt-retrieve&id="+id,
                    success: function(msg) {

                        global.updateDataTable('tblUploadedReceipts');
                        global.updateDataTable('tblRejectedReceipts');
                    }
                });
            },
            cancel: function(button) {
            }
        });
    });

    $('#receipt_view').on('click', '.btn-info', function(e){
        e.preventDefault();
        $.fn.colorbox.close();

    });

    $('#receipt_view').on('click', '.btn-danger', function(e){
        e.preventDefault();
        $.fn.colorbox.close();
        var id = $(this).data('id');

        $.confirm({
            text: "Please confirm to Delete:",
            confirm: function(button) {
                $.ajax({
                    url: BASE_URL + "/admin/transaction/ajax?type=RejectedReceipt-delete&id="+id,
                    success: function(msg) {
                        global.updateDataTable('tblUploadedReceipts');
                        global.updateDataTable('tblRejectedReceipts');
                    }
                });
            },
            cancel: function(button) {
            }
        });
    });

    $('#SearchMyBills').keyup(function(){
        $('#tblUploadedReceipts').dataTable().fnFilter($(this).val());
    });

    $("#tblUploadedReceipts").on('click', '.btn-view', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "/admin/transaction/ajax?type=bill-url&id="+id,
            success: function(msg) {
                document.getElementById("receipt_view").innerHTML="";
            }
        });
        $(this).colorbox({inline:true, width:"100%",height:"100%"});
    });

	$('#myInputTextField').keyup(function()	{

		var activeTable = $(".active").find('table').attr('id');
		var activeDataTable = $('#' + activeTable).dataTable();

		activeDataTable.fnFilter($(this).val());
	});

    var table = $('#tblUploadedReceipts').DataTable();
});
