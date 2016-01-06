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
 * This method.
 *
 * @param.
 *
 * @return void
 */

$(document).ready(function () {



    var BASE_URL = $('#hdnBaseUrl').val();
    var box3;

    $('#dpDueDate').datepicker({
        format: 'yyyy-mm-dd'
    });

    var iv2 = $("#viewer2").iviewer(
        {
            src: "" + document.getElementById('iviewer11').src
        });

    $("#categoryDrop").change(function (event) {
        event.preventDefault();
        var e = document.getElementById("categoryDrop");
        var CategoryId = e.options[e.selectedIndex].value;
        $.ajax({
            url: BASE_URL + "/admin/biller/ajax?type=billerDropdown&CategoryId=" + CategoryId,
            success: function (data) {
                document.getElementById("Biller").innerHTML = data;
                var billerDrop = document.getElementById("billerDrop");
                var billerDropValue = billerDrop.options[billerDrop.selectedIndex].text;
                document.getElementById("blah").src = "http://localhost/ezibills_web/public/uploads/logo/" + billerDropValue + ".png";
            }
        });
    });

    $("#btnReject").on('click', function (e) {
        document.getElementById("error").innerHTML = "";
        document.getElementById("reason").value = "";
        $(".reject_inline").colorbox({inline: true, width: "600px", height: "250px", title: "Confirm Rejection"});
    });

    $("#btnSave").on('click', function (e) {
        e.preventDefault();
        $.confirm({
            text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",
            confirm: function (button) {
                document.body.style.cursor = 'wait';
                $('#BillEntryForm').submit();
                $().iseziloading('show');

                return true;
            },
            cancel: function (button) {
                return false;
            }
        });
    });

    $("#txtBillAmount").on('blur', function (e) {
        var amt = document.getElementById("txtBillAmount").value;
        var p = amt.split(".");
        var formatted = "0";
        var formatted2 = "";
        if (p[0] >= 0) {
            if (p[0] > 0) {
                formatted = p[0];
            } else {
                formatted = "0";
            }
        } else {
            formatted = "0";
        }
        if (p[1] >= 0) {
            if (p[1] > 9) {
                formatted2 = p[1];
            } else {
                formatted2 = p[1] + "00";
            }
            formatted2 = formatted2.substring(0, 2);
        } else {
            formatted2 = "00";
        }
        document.getElementById("txtBillAmount").value = formatted + "." + formatted2;
    });
});

function reject_Yes() {
    $('#preloader').show();
    var BASE_URL = $('#hdnBaseUrl').val();
    var reason = document.getElementById("reason").value;
    var id = document.getElementById("rct_id").value;
    if (reason.length > 0) {
        $.ajax({
            url: BASE_URL + "/admin/biller/ajax?type=UploadedReceipt-reject&reason=" + reason + "&id=" + id,
            beforeSend: function () {
                $().iseziloading('show');
            },
            success: function (data) {
                $().iseziloading('hide');
                $('#preloader').hide();
                if (data.newValue == "SUCCESS") {
                    document.getElementById("reason").value = "";
                    window.location = BASE_URL + "/admin/biller/list?success=1";
                } else {
                    $.fn.colorbox.close();
                    $().toastmessage('showNoticeToast', "Error image not found");
                }
            },
            fail: function (data) {
                $.fn.colorbox.close();
            }
        });
    } else {
        document.getElementById("error").innerHTML = "<div style='padding-right:30px;color:#ED1C38;'>This field is required.</div>";
    }
}

function reject() {
    $.fn.colorbox.close();
}

function showNoticeToast() {
    $().toastmessage('showNoticeToast', "Notice  Dialog which is fading away ...");
}
