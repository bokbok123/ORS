/**
 * Returns the name of the currently set context.
 *
 * @author name <paulvergel.cenir@estansaas.com>
 * @date 07-Nov-2014
 * @param
 * @return
 * @changes
 * @edited by
 */


/**
 * This method validate and confirm uploaded bills/rejected bills in view button .
 *
 * @param.
 *
 * @return void
 */

$(document).ready(function(){
    /*added by ajei*/
    function CommaFormatted(amount) {
        var delimiter = ","; // replace comma if desired
        var a = amount.split('.',2)
        var d = a[1];
        var i = parseInt(a[0]);
        if(isNaN(i)) { return ''; }
        var minus = '';
        if(i < 0) { minus = '-'; }
        i = Math.abs(i);
        var n = new String(i);
        var a = [];
        while(n.length > 3) {
            var nn = n.substr(n.length-3);
            a.unshift(nn);
            n = n.substr(0,n.length-3);
        }
        if(n.length > 0) { a.unshift(n); }
        n = a.join(delimiter);
        if(d.length < 1) { amount = n; }
        else { amount = n + '.' + d; }
        amount = minus + amount;
        return amount;
    }
    //Validate for Letters Only
    $(".txtboxLetterOnly").keypress(function(event) {
        if (event.charCode!=0) {
            var regex = new RegExp("^[ A-Za-z,.]*$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });

    $(".numOnly").keypress(function(event) {
        if (event.charCode!=0) {
            var regex = new RegExp("^[0-9]*$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });
/*added by ajei*/
    $("#txtBillAmount").on('blur',  function(e) {
        var val = $(this).val();
        if(isNaN(val)){
            val = val.replace(/[^0-9\.]/g,'');
            if(val.split('.').length>2)
                val =val.replace(/\.+$/,"");
        }

        val = parseFloat(val).toFixed(2);
        $('#txtBillAmount').val(CommaFormatted(val));
    });

    //Validate for Numbers Only
    $(".txtboxNumberOnly").keydown(function (event) {

        if (event.charCode!=0) {
            var regex = new RegExp("^[0-9.]*$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });
    //Validate Paste
    $('input').bind('paste',function(e) {
        e.preventDefault();
        return false;
    });
    //Validate Copy
    $('input').bind('copy',function(e) {
        e.preventDefault();
        return false;
    });


    var BASE_URL = $('#hdnBaseUrl').val();

    $('#dpDueDate').datepicker({
        format: 'dd-M-yyyy'
    });

    $('#dpDueDate').datepicker().on('changeDate', function ()
    {
        $(this).datepicker('hide');
    });

    $('#payDate').datepicker({
        format: 'dd-M-yyyy'
    });

    $('#payDate').datepicker().on('changeDate', function ()
    {
        $(this).datepicker('hide');
    });

    $("#viewer2").iviewer ({
        src: ""+document.getElementById('iviewer11').src
    });

    // Change Biller Dropdown by Category

    $("#categoryDrop").change(function (event) {
        event.preventDefault();
        var e = document.getElementById("categoryDrop");
        var CategoryId = e.options[e.selectedIndex].value;
        $.ajax({
            url: BASE_URL + "/admin/biller/ajax?type=billerDropdown&CategoryId=" + CategoryId,
            success: function (data) {
                document.getElementById("biller").innerHTML = data;
                var billerDrop = document.getElementById("billerDrop");
            }
        });
    });


    $("#btnReject").on('click',  function(e)
    {
        document.getElementById("error").innerHTML="";
        document.getElementById("reason").value="";
        $('#bpoRejectModal').modal('show');
        $('#bpoRejectModal .modal-body').css('display','block');
        $('#bpoRejectModal .modal-title').text('Confirm Rejection');
        $('#bpoRejectModal #submitConfirm').attr('id','btnLoading');
        $('#bpoRejectModal #btnLoading').attr('onclick','reject_Yes()');
        $('#bpoRejectModal #submitCancel').attr('id','btnLoading1');
        $('#bpoRejectModal #btnLoading1').attr('onclick','reject()');
    });

    //BPO bill saving by upload photo
    //Validate greater than zero
    jQuery.validator.addMethod("greaterThanZero", function(value, element) {
        return this.optional(element) || (parseFloat(value) > 0);
    }, "Please enter at least 1 bill amount.");

    $('#btnSave').on('click', function() {
        $("#BillEntryForm").validate({
            rules:{
                category:{
                    required:true,
                    min:1
                },
                biller:{
                    required:true,
                    min:1
                },
                bill_accountnumber:{
                    required:true,
                    number: false
                },
                bill_transactionnumber:{
                    required:true,
                    number: true
                },
                bill_amount:{
                    required:true,
                    greaterThanZero : true,
                    number: true

                },
                DueDate:{
                    required:true
                },
                PayDate:{
                    required:true
                }
            },
            messages:{
                bill_amount:{
                    required:'Please enter at least 1 bill amount.'

                },
                category:{
                    min:'Please select a category.'
                },
                biller:{
                    min:'Please select a biller.'
                }

            },
            submitHandler: function(form) {
                $('#bpoRejectModal').modal('show');
                $('#bpoRejectModal .modal-body').css('display','none');
                $('#bpoRejectModal .modal-title').text("<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>");
                $('#bpoRejectModal #btnLoading').attr('id','submitConfirm');
                $('#bpoRejectModal #submitConfirm').removeAttr('onclick');
                $('#bpoRejectModal #btnLoading1').attr('id','submitCancel');
                $('#bpoRejectModal #submitCancel').removeAttr('onclick');
            }

        });
    });

    $('#bpoRejectModal').on('click','#submitConfirm', function(){
        var BASE_URL = $('#hdnBaseUrl').val();

        var cstId = document.getElementById("customerId").value;
        var rctId = document.getElementById("rct_id").value;
        var category = $('#categoryDrop').val();
        var biller = $('#biller').val();
        var bill_accountnumber = document.getElementById("bill_accountnumber").value;
        var bill_transactionnumber = document.getElementById("bill_transactionnumber").value;
        var txtBillAmount = document.getElementById("txtBillAmount").value;
        var dpDueDate = document.getElementById("dpDueDate").value;
        var payDate = document.getElementById("payDate").value;
        var userEntity = $("#userEntity").val();

        var formData = new FormData();
        formData.append('customerId', cstId);
        formData.append('category', category);
        formData.append('rct_id', rctId);
        formData.append('biller', biller);
        formData.append('bill_accountnumber', bill_accountnumber);
        formData.append('bill_transactionnumber', bill_transactionnumber);
        formData.append('bill_amount', txtBillAmount);
        formData.append('DueDate', dpDueDate);

        $.ajax({
            url: BASE_URL + "/admin/biller/billSaving",
            method:'post',
            processData:false,
            contentType:false,
            cache:false,
            dataType:'json',
            data:formData,
            beforeSend: function()
            {

                $().iseziloading('show');
            },

            complete: function()
            {
                $().iseziloading('hide');
            }
        });
        alert('Successfully Add Bill');
        location.href= BASE_URL + '/admin/biller/list';
        return true;

    });

});

function formatNumber (num)
{
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function reject_Yes()
{
    $('#preloader').show();
    var BASE_URL = $('#hdnBaseUrl').val();
    var reason = document.getElementById("reason").value;
    var id =document.getElementById("rct_id").value;
    if(reason.length>0)
    {
        $.ajax({

            url: BASE_URL + "/admin/biller/ajax?type=uploadedReceipt-reject&reason="+reason+"&id="+id,
            method:'post',
            processData:false,
            contentType:false,
            cache:false,
            dataType:'json',
            success: function(data) {
                $().iseziloading('hide');
                $('#preloader').hide();
                if(data.newValue=="SUCCESS")
                {
                    $.ajax({
                        type: 'post',
                        url: BASE_URL + "/sendEmail",
                        data: {
                            emailData: data.Emaildata
                        },

                        success: function (data) {

                            document.getElementById("reason").value="";
                            window.location = BASE_URL+"/admin/biller/list?success=1";
                        }
                    });

                }
                else
                {
                    $.fn.colorbox.close();
                    $().toastmessage('showNoticeToast', "Error image not found");
                }
            },
            error: function() {
                $.fn.colorbox.close();
            }
        });
    }
    else
    {
        document.getElementById("error").innerHTML="<div style='padding-left:30px;color:#ED1C38;'>This field is required.</div>";
    }
}

function reject()
{
    $.fn.colorbox.close();
}

function showNoticeToast()
{
    $().toastmessage('showNoticeToast', "Notice  Dialog which is fading away ...");
}