
/**
 * Returns the name of the currently set context.
 *
 * @author name <jimmy.buyco@estansaas.com>
 * @date 07-Nov-2014
 * @param
 * @return
 * @changes
 * @edited by arjay.dacanay@estansaas.com
 */

/**
 * This method show the data tables for payment list module.
 *
 * @param.
 *
 * @return void
 */

$(document).ready(function()
{
    $('#SearchMyBills').keyup(function(){
        $('#tblPayment').dataTable().fnFilter($(this).val());
    });

    var BASE_URL = $('#hdnBaseUrl').val();

    //This method show the data tables for Table Payments
//    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
//        "currency-pre": function (a) {
//            a = (a === "-") ? 0 : a.replace(/[^\d\-\.]/g, "");
//            return parseFloat(a);
//        },
//        "currency-asc": function (a, b) {
//            return a - b;
//        },
//        "currency-desc": function (a, b) {
//            return b - a;
//        }
//    });
    $('#tblPayment').dataTable({
        "sDom": '<"top"f>rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/transaction/ajax?type=payment-list",
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
//            { "aTargets": [ 2 ], "visible": false,"bSortable": false },
//            { "aTargets": [ 3 ], "visible": false,"bSortable": false },
            { "aTargets": [ 2 ], "bSortable": false },
            { "aTargets": [ 3 ], "visible": true,"bSortable": false }
        ],
        "lengthMenu": [[ 14, 50, -1], [ 15, 50, "All"]],
        "iDisplayLength" : 10,
        "order": [0, 'desc'],
        /**
         * Fills datatable with missing rows
         *
         * Set default Table size when Table is empty
         */
        "fnDrawCallback" : function(oSettings)
        {
            var total_count = oSettings.fnRecordsTotal();
            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
            var show_num = oSettings._iDisplayLength;
            var tr_count = $(this).children('tbody').children('tr').length;
            var missing = show_num - tr_count;

            //Set default Table size when Table is empty
            if (show_num < total_count && missing > 0) {
                for(var i = 0; i < missing; i++){
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else  if (show_num > total_count) {
                for(var i = 0; i < (show_num - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else if (total_count == 0) {
                for(var i = 0; i < (14 - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            }
        },
        "language": {
            //Hide Previous and Next in DataTable
            "paginate": {
                "previous": "<div class = 'prevBtn'></div>",
                "next": "<div class = 'nextBtn'></div>"
            }
        },
        //Count All Data
        "lengthMenu": [[ 14, 50, -1], [ 15, 50, "All"]]
    });

    //Show Table Row Heading
    $("#tblPayment").on('click', '.btn-view', function(e)
    {
        $().iseziloading("show");
        e.preventDefault();
        var id = $(this).data('id');
        $('#mod').modal('show');

        $.ajax({
            url: BASE_URL + "/admin/transaction/ajax?type=pay-view&id="+id,
            //$("body").isLoading({ text: "Loading" });
            success: function(msg)
            {
                document.getElementById("td_billCategory").innerHTML=msg.billCategory;
                document.getElementById("td_Biller").innerHTML=msg.Biller;
                document.getElementById("td_accountNumber").innerHTML=msg.accountNumber;
                document.getElementById("td_billAmount").innerHTML="<span style='font-size: 22px'>"+msg.currency+" </span>"+msg.billAmount;
                document.getElementById("td_Billstatus").innerHTML=msg.billStatus;
                document.getElementById("td_DueDate").innerHTML=msg.billDueDate;
                document.getElementById("td_PaymentDate").innerHTML=msg.billPaymentDate;
                var imagURL = msg.imageUrl;
                var iv_src = "../../public/uploads/bills/"+imagURL;
                var iv1 = $("#adminImgPlace").iviewer({
                    src: "" + iv_src,
                    onFinishLoad: function(ev, iv_src){
                        $("#adminImgPlace").iviewer('center'),
                        $().iseziloading("hide");
                    },
                    onErrorLoad: function(ev, iv_src){
                        $("#adminImgPlace").iviewer('center'),
                        $().iseziloading("hide");
                    }
                });
                $("#adminImgPlace img").attr("src", iv_src);
                $(".iviewer_download").on('click', function(e){
                    var l = $('#adminImgPlace img').attr('src');
                    var source = l.substr(3);
                    downloadReceipt2(source);
                });
                $(".iviewer_print").on('click', function(e){
                    var l = $('#adminImgPlace img').attr('src');
                    var source = l.substr(3);
                    adminPrintReceipt2(source);
                });
                var source = $('#adminImgPlace img');
                source
                    .on('error', function() {
                        $(".transZindex").css("display","block");
                        $(this)
                            .removeAttr('src')
                            .removeAttr('style')
                            .attr('src', BASE_URL+"/img/no_attachment_found.png")
                            .addClass('fixLeftTop')
                    })
                    .on('load',function(){
                        $(this).removeClass('fixLeftTop').css('top','0px');
                    })
                ;
            }, error: function() {
                alert('error');
            }
        });
        $('.show_close').click(function(e){
            $('#mod').hide();
            $('#tabPayment').show();
        });
        $('#btnModalClose').click(function(e){
            $('#mod').hide();
            $('#tabPayment').show();
        });
        $('#paymentListView').modal('show');

    });
});

//Close Modal
function CloseModal()
{
    $.fn.colorbox.close();
}