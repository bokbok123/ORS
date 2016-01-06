
$(document).ready(function(){

    var BASE_URL = $("#hdnBaseUrl").val();

    $("#formRemarksAdmin").validate({
        rules:{
            addreason:{
                required:true
            },
            addreasoncode:{
                required:true
            }
        }
    });
    $('#myModalAddRemarks').on('hidden.bs.modal', function () {
        $("#formRemarksAdmin")[0].reset();
    });


    $("#addRemarks").on("click", function(e){
        e.preventDefault();
        var validate = $("#formRemarksAdmin").validate();
        var formVal = validate.form();
        if(formVal){
            $.ajax({
                data: {
                    reason: $("#addreason").val(),
                    code :  $("#addreasoncode").val()
                },
                type: "post",
                url: BASE_URL + "/admin/addRemarks",
                beforeSend: function(){
                    $().iseziloading('show');
                },
                success: function(data){
                    if(data.success){
                        refreshDatatable();
                        $('#myModalAddRemarks').modal('hide');
                        $().iseziloading('hide');
                    }
                }
            });
        }

    });

    $("#tblremarks").delegate(".btn-edit-remarks","click", function(){
        var id = $(this).data("id");
        $("#editRemarks").attr("data-id", id);
        $.ajax({
            data: {id: $(this).data("id"), reason: $("#editreason").val()},
            type: "post",
            url: BASE_URL + "/admin/getSingleRemarks",
            success: function(data){
                $("#editreason").val(data);
                $("#editRemarksModal").modal("show");
            }
        });
    });

    $("#tblremarks").delegate(".btn-delete-remarks","click", function(){
        var id = $(this).data("id")
        $.confirm({
            text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to delete.</div>",
            confirm: function (button) {
                $().iseziloading('show');
                $.ajax({
                    data: {id: id},
                    type: "post",
                    url: BASE_URL + "/admin/deleteRemarks",
                    success: function(data){
                        refreshDatatable()
                        $().iseziloading('hide');
                    }
                });
            },
            cancel: function (button) {
                return false;
            }
        });

    });

    $("#editRemarks").on("click", function(){
        $.ajax({
            data: {id: $(this).data("id"), reason: $("#editreason").val()},
            type: "post",
            url: BASE_URL + "/admin/editRemarks",
            beforeSend: function(){
                $().iseziloading('show');
            },
            success: function(){
                refreshDatatable();
                $('#editRemarksModal').modal('hide');
                $().iseziloading('hide');
            }
        });
    });


    refreshDatatable();
});



function refreshDatatable(){
    var BASE_URL = $("#hdnBaseUrl").val();
    $('#tblremarks').dataTable().fnDestroy();
    var oTableRemarks = $('#tblremarks').dataTable({
        "scrollCollapse": true,
        "sDom": '<"top">rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "pagingType": "simple_numbers",
        "iDisplayLength": 10,
        "sAjaxSource": BASE_URL+ "/admin/viewRemarks",
//        "aoColumnDefs": [ {
//            "bSortable": true,
//            "aTargets": [ 2 ]
//        }]
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": false },
            { "aTargets": [ 3 ], "bSortable": false }
        ],
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

        }
    });
//edit by nelson
//    $('#tblremarks').dataTable({
//        "sDom": '<"top">rt<"bottom"ip><"clear">',
//        "bServerSide": true,
//        "sAjaxSource": BASE_URL+ "/admin/viewRemarks",
//        "aoColumnDefs": [
//            { "aTargets": [ 0 ], "bSortable": true},
//            { "aTargets": [ 1 ], "bSortable": false},
//            { "aTargets": [ 2 ], "bSortable": false}
//        ],
//        "lengthMenu": [
//            [ 10, 50, -1],
//            [ 15, 50, "All"]
//        ],
//        "order": [0, 'desc'],
//
//        /*
//         * Fills datatable with missing rows
//         */
//
//        "language": {
//            "paginate": {
//                "previous": "<div class = 'prevBtn'></div>",
//                "next": "<div class = 'nextBtn'></div>"
//            }
//        }
//    });
    // ------------ CUSTOM SEARCH ----------------//
//    $('.remarks').keyup(function(){
//        oTableRemarks.fnFilter($(this).val());
//    });

    $('#SearchMyBills').keyup(function(){
        $('#tblremarks').dataTable().fnFilter($(this).val());
    });

}

