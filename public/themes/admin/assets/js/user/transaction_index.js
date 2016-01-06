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
 * This method show the data tables for bills list module.
 *
 * @param.
 *
 * @return void
 */



$(document).ready(function(){

    var BASE_URL = $('#hdnBaseUrl').val();

    $('#tblBills').dataTable({
        "sDom": '<"top"f>rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/transaction/ajax?type=Bill-list",
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": false },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": true },
            { "aTargets": [ 4 ], "bSortable": false },
            { "aTargets": [ 5 ], "bSortable": false },
            { "aTargets": [ 6 ],  "visible": false, "bSortable": false },
            { "aTargets": [ 7 ], "bSortable": false }

        ],
        "lengthMenu": [[ 11, 50, -1], [ 15, 50, "All"]],
        "order": [0, 'desc'],

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
            if(data[6]=='Over')
            {
                $(row).addClass('red');
            }
            if(data[6]=='This Week')
                $(row).addClass('orange');
        },
        "language": {
			  "paginate": {
			       "previous": "<div class = 'prevBtn'></div>",
			       "next": "<div class = 'nextBtn'></div>"
			   }
	     }
    });
    $('#SearchMyBills').keyup(function(){
        $('#tblBills').dataTable().fnFilter($(this).val());
    });


    $("#tblBills").on('click', '.btn-view', function(e){
        $().iseziloading("show");

        e.preventDefault();
        var id = $(this).data('id');

        $('#mod').modal('show');

        $.ajax({
            url: BASE_URL + "/admin/transaction/ajax?type=bill-view&id="+id,
            success: function(msg) {
                $(".transZindex").css("display","none");
                document.getElementById("td_billCategory").innerHTML=msg.billCategory;
                document.getElementById("td_Biller").innerHTML=msg.Biller;
                //document.getElementById("td_User").innerHTML=msg.User;
                document.getElementById("td_accountNumber").innerHTML=msg.accountNumber;
                document.getElementById("td_billAmount").innerHTML="<span style='font-size: 22px'>PHP </span>"+msg.billAmount;
                document.getElementById("td_DueDate").innerHTML=msg.billDueDate;
                document.getElementById("td_PaymentDate").innerHTML=msg.billPaymentDate;
                document.getElementById("td_Billstatus").innerHTML=msg.billStatus;
                var imagURL = msg.imageUrl;
                var iv_src = "../public/uploads/bills/"+imagURL;

                var iv1 = $("#adminImgPlace").iviewer({
                    src: "" + iv_src,
                    zoom: "fit",
                    onFinishLoad: function(ev, iv_src){
                        $().iseziloading("hide");
                    },
                    onErrorLoad: function(ev, iv_src){
                        $().iseziloading("hide");
                    }
                });

                $("#adminImgPlace img").attr("src", iv_src);

                $(".iviewer_download").on('click', function(e){

                    var source = $('#adminImgPlace img').attr('src');
                    downloadReceipt(source);
                });
                $(".iviewer_print").on('click', function(e){
                    var source = $('#adminImgPlace img').attr('src');
                    printReceipt(source);
                });

                var source = $('#adminImgPlace img');
                source
                    .on('error', function() {
                        $(".transZindex").css("display","block");
                        $(this)
                            .removeAttr('src')
                            .attr('src', BASE_URL+"/img/no_attachment_found.png")
                            .removeAttr('style')
                            .css('left','0 !important')
                            .addClass('fixLeftTop')
                    })
                    .on('load',function(){
                        $(this).removeClass('fixLeftTop').css('top','0px');
                    })
                ;

            }
        });

    });



    $("#optionDue").on('click',  function(e){

        $('#tblBills').dataTable().fnDestroy();
        $('#tblBills').dataTable({

            "sDom": '<"top"f>rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/transaction/ajax?type=Bill-list",
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": false },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": true },
                { "aTargets": [ 4 ], "bSortable": false },
                { "aTargets": [ 5 ], "bSortable": false },
                { "aTargets": [ 6 ],  "visible": false, "bSortable": false },
                { "aTargets": [ 7 ], "bSortable": false }

            ],
            "language": {
  			  "paginate": {
  			       "previous": "<div class = 'prevBtn'></div>",
  			       "next": "<div class = 'nextBtn'></div>"
  			   }
  	     },
            "order": [0, 'desc'],
            "lengthMenu": [[ 10, 50, -1], [ 15, 50, "All"]],
            "fnRowCallback": function ( row, data, index ) {
                if(data[6]=='Over')
                {
                    $(row).addClass('red');
                }
                if(data[6]=='This Week')
                    $(row).addClass('orange');
            },
            "fnServerParams": function(aoData) {
                aoData.push({
                    "name": "module",
                    "value": "Over"
                })
            }
        });
    });

    $("#optionAll").on('click',  function(e){
        $('#tblBills').dataTable().fnDestroy();
        $('#tblBills').dataTable({
            "sDom": '<"top"f>rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/transaction/ajax?type=Bill-list",
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": false },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": true },
                { "aTargets": [ 4 ], "bSortable": false },
                { "aTargets": [ 5 ], "bSortable": false },
                { "aTargets": [ 6 ],  "visible": false, "bSortable": false },
                { "aTargets": [ 7 ], "bSortable": false }
            ],
            "language": {
  			  "paginate": {
  			       "previous": "<div class = 'prevBtn'></div>",
  			       "next": "<div class = 'nextBtn'></div>"
  			   }
  	     },
            "lengthMenu": [[ 10, 50, -1], [ 15, 50, "All"]],
            "order": [0, 'desc'],
            "fnRowCallback": function ( row, data, index ) {
                if(data[6]=='Over')
                {
                    $(row).addClass('red');

                }
                if(data[6]=='This Week')
                    $(row).addClass('orange');
            },
            "fnServerParams": function(aoData) {
                aoData.push({
                    "name": "module",
                    "value": "All"
                })
            }
        });
    });


    $("#optionWeek").on('click',  function(e){

        $('#tblBills').dataTable().fnDestroy();
        $('#tblBills').dataTable({
            "sDom": '<"top"f>rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/transaction/ajax?type=Bill-list",
            "aoColumns": [
                { 'width': '20%', 'bSortable': true },
                { 'width': '12%', 'bSortable': false },
                { 'width': '12%', 'bSortable': true },
                { 'width': '15%', 'bSortable': true },
                { 'width': '10%', 'bSortable': false },
                { 'width': '10%', 'bSortable': false },
                { 'width': '9%', 'bSortable': false },
                { 'width': '9%', 'bSortable': false }

            ],
            "bAutoWidth": false,
            "language": {
  			  "paginate": {
  			       "previous": "<div class = 'prevBtn'></div>",
  			       "next": "<div class = 'nextBtn'></div>"
  			   }
  	     },
            "lengthMenu": [[ 10, 50, -1], [ 15, 50, "All"]],
            "order": [0, 'desc'],
            "fnRowCallback": function ( row, data, index ) {

                if(data[6]=='Over')
                {
                    $(row).addClass('red');
                }
                if(data[6]=='This Week')
                    $(row).addClass('orange');

            },
            "fnServerParams": function(aoData) {
                aoData.push({
                    "name": "module",
                    "value": "Week"
                })
            }
        });
    });

    $('#dp2').datepicker({
        //format: 'mm-dd-yyyy'
        format: 'yyyy-mm-dd'
    });

    $('#dp3').datepicker({
        //format: 'mm-dd-yyyy'
        format: 'yyyy-mm-dd'
    });



    $("#btnTransactionProcess").on('click',  function(e){
        var dtFrom = document.getElementById("dp2").value;
        var dtTo = document.getElementById("dp3").value;


        if(dtFrom.length+dtTo.length>15)
        {
            $('#tblBills').dataTable().fnDestroy();
            $('#tblBills').dataTable({
                "sDom": '<"top"f>rt<"bottom"ip><"clear">',
                "bServerSide": true,
                "sAjaxSource": BASE_URL + "/admin/transaction/ajax?type=Bill-list",
                "lengthMenu": [[ 14, 50, -1], [ 15, 50, "All"]],
                "order": [0, 'desc'],
                "fnServerParams": function(aoData) {
                    aoData.push({
                        "name": "dtFrom",
                        "value": dtFrom
                    })
                    aoData.push({
                        "name": "dtTo",
                        "value": dtTo
                    })
                }
            });
        }
    });

 // Zab
	$('#myInputTextField').keyup(function()	{

		var activeTable = $(".active").find('table').attr('id');
		var activeDataTable = $('#' + activeTable).dataTable();

		activeDataTable.fnFilter($(this).val());
	});
});

function CloseModal()
{
    $.fn.colorbox.close();
}

