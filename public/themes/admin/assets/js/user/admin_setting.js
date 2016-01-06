/**
 * Created by paulvergel.cenir on 12/23/14.
 */

$(document).ready(function ()
{
    $('.alphaOnly').on('keypress', function(event){

        var regex = new RegExp("^[ A-Za-z']*$");
        validation(event, regex);

    });
    $('.alpha').on('keypress', function(event){

        var regex = new RegExp("^[ A-Za-z-&.']*$");
        validation(event, regex);

    });
    $('.numberOnly').on('keypress', function(event){

        var regex = new RegExp("^[ 0-9.]*$");
        validation(event, regex);

    });
    $('.numForPoint').on('keypress', function(event){

        var regex = new RegExp("^[ 0-9]*$");
        validation(event, regex);

    });

    var BASE_URL = $('#hdnBaseUrl').val();

    //This method show the dataTables for Admin Settings Table
    $('#SearchMyBills').keyup(function(){
        $('#tblAdminSettings').dataTable().fnFilter($(this).val());
    });

    $('#tblAdminSettings').dataTable({
        "aaSorting": [
            [ 0, "asc" ]
        ],
        "bAutoWidth": false,
        "aoColumns": [
            { 'width': '', 'bSortable': true },
            { 'width': '', 'bSortable': true },
            { 'width': '', 'bSortable': true },
            { 'width': '', 'bSortable': false },
            { 'width': '', 'bSortable': false }
        ],
//    "bPaginate": false,
        "sDom": '<"top"f>rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/setting/ajax?type=admin-setting",
        "iDisplayLength" : 11,
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

    //Show Table Row Heading
    $('#tblAdminSettings').on('click', '.btn-edit', function (e)
    {
        e.preventDefault();
        var id = $(this).data('id');

                $.ajax({
                    dataType: "json",
                    //Link for edit-admin-settings
                    url: BASE_URL + "/admin/setting/ajax?type=edit-admin-settings&id=" + id,
                    success: ( function (msg)
                    {
                        $('#field_code').val(msg.fieldcode);
                        $('#field_name').val(msg.fieldname);
                        $('#field_value').val(msg.fieldvalue);
                        $('#hdnId').val(id);
                        $('#edit_admin_settings').modal('show');
                        $('#hideSpan').css('display','none');
                    })
                });


    });

    /*added by ay ajei 09-15-2015*/
    $('#accountSettingModal').on('click', function (){
        $('#myAccountSettingModal').modal('show');
    });


    $('#btnEditSettings').on('click', function (e){
        var fldVl = $('#field_value').val();
        if(fldVl==''){
            $('#hideSpan').css('display','block');
        } else {
            e.preventDefault();
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold;'>Are you sure you want to proceed?</div>",
                confirm: function (button) {
                    document.getElementById("editAdminSubmit").submit();
                },
                cancel: function (button) {
                    return false;
                }
            });
        }
    })

//    if($("#adminUserID").val() == 1)
//    {
//        $("#aChangePass").hide();
//    }

    $('#aChangePass').on('click', function(){
        $('.navAccountSet li.ulTab2').addClass('active');
        $('.navAccountSet li.ulTab1').removeClass('active');
        $('#accountSettingModal button.close').css('display','none');
        $('#changePassword').removeClass('displayNone');
        $('#profPicDiv').addClass('displayNone');
//        if($("#adminUserID").val() == 1)
//        {
//            alert("bawal ka magchange ng password ikaw ay super admin")
//        }
//        else{
//            $('.navAccountSet li.ulTab2').addClass('active');
//            $('.navAccountSet li.ulTab1').removeClass('active');
//            $('#accountSettingModal button.close').css('display','none');
//            $('#changePassword').removeClass('displayNone');
//            $('#profPicDiv').addClass('displayNone');
//        }
    });

    $('#aProfDiv').on('click', function(){
        $('.navAccountSet li.ulTab1').addClass('active');
        $('.navAccountSet li.ulTab2').removeClass('active');
        $('#accountSettingModal button.close').css('display','block');
        $('#profPicDiv').removeClass('displayNone');
        $('#changePassword').addClass('displayNone');
    });

    $('#confirmPassword').on('click', function (event){

        event.preventDefault();
        $('#changePasswordAdmin').validate({
            onkeyup: function(element){this.element(element);},
            onfocusout: function(element){this.element(element);},
            focusInvalid: false,
            debug: true,
            rules: {
                passwordChange: {
                    required:true,
                    minlength: 8
                },
                changeConfirmPassword: {
                    required:true,
                    minlength: 8,
                    equalTo: "#passwordChange"
                }
            },
            messages: {
                changeConfirmPassword: {
                    equalTo: "Password did not match"
                }
            }
        });
        if($('#changePasswordAdmin').valid()) {
            var cpass = $('#changeConfirmPassword').val();
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%'>Are you sure you want to save?</div>",
                confirm: function(button)
                {
                $.ajax({
                    dataType: "json",
                    //Link for edit-admin-settings
                    url: BASE_URL + "/admin/setting/ajax?type=change-password&id=" + cpass,
                    success:  function (msg)
                    {
                        $('#myAccountSettingModal').modal('hide');
                        $("#myModalSuccess").modal("show");
                        setTimeout(function()
                        {
                            $("#myModalSuccess").modal("hide");
                        }, 2000);

                    }
                });
                }
            });
        }
    });

    $('.cancelPassword, .closeHeaderModal').on('click', function (){
        $('#passwordChange').val('');
        $('#changeConfirmPassword').val('');
        var validator = $('#changePasswordAdmin').validate();
        validator.resetForm();
        $('.navAccountSet li.ulTab1').addClass('active');
        $('.navAccountSet li.ulTab2').removeClass('active');
        $('#accountSettingModal button.close').css('display','block');
        $('#profPicDiv').removeClass('displayNone');
        $('#changePassword').addClass('displayNone');
    })
});
function validation(event, regex) {

    if (event.charCode != 0) {

        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {

            event.preventDefault();
            return false;
        }
    }
}