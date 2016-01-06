/**
 * Created by christian.labini on 9/16/15.
 */

$(document).ready(function () {
    /*added by ajei*/
    $("select[name='baseCurrency'] option:eq(0)").attr("disabled", "disabled");
    $("select[name='baseCurrencyTo'] option:eq(0)").attr("disabled", "disabled");
    $("select[name='baseCurrencyEdit'] option:eq(0)").attr("disabled", "disabled");
    $("select[name='baseCurrencyEditTo'] option:eq(0)").attr("disabled", "disabled");

    var BASE_URL = $('#hdnBaseUrl').val();
    transperaRateReload();

    $('#SearchMyBills').keyup(function () {
        $('#tblTransperaRate').dataTable().fnFilter($(this).val());
    });

    $("#btnAddMatrix").on('click', function () {
        $('#myModalAddMatrix').modal('show');
        var validator = $('#MatrixEntryForm').validate();
        validator.resetForm();

    });
    $("#btncanceladdMatrix").on('click', function (e) {
        e.preventDefault();
        $(".unique-matrix").html("");
        var jqueryValidator = jQuery("#MatrixEntryForm").validate();
        jqueryValidator.resetForm();

    });
    $("#btncanceladdForex").on('click', function (e) {
        e.preventDefault();
        $('.unique-matrix').hide();
        var jqueryValidator = jQuery("#MatrixEditForm").validate();
        jqueryValidator.resetForm();

    });

    $(".txtboxNumberOnly").keypress(function (event) {

        if (event.charCode != 0) {
            var regex = new RegExp("^[0-9]*$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });

    validateRate();
    function validateRate() {
        $('#MatrixEntryForm').validate({
            focusInvalid: false,
            debug: true,
            rules: {
                baseCurrency: {
                    required: true
                },
                baseCurrencyTo: {
                    required: true
                },
                Base: {
                    required: true,
                    min: 1
                },
                Ceilling: {
                    required: true,
                    min: 1
                },
                MatrixRate: {
                    required: true,
                    min: 1
                }
            }
        });
    }

    $('#saveMatrix').on('click', function (event) {

        var validate = $("#MatrixEntryForm").validate();
        var formVal = validate.form();
        if(formVal){

            $.ajax({
                url: "getMatrixValAdd?type=getMatrixValAdd",
                type: 'post',
                data: {
                    from    :   $("#baseCurrency").val(),
                    to      :   $("#baseCurrencyTo").val(),
                    base    :   $("#Base").val(),
                    ceil    :   $("#Ceilling").val()
                },
                success: function (data) {
                    if (data == 'true') {
                        $('.unique-matrix').html("");

                        if ($('#MatrixEntryForm').valid()) {
                            $.confirm({
                                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%;'>Please confirm to save</div>",
                                confirm: function (button) {
                                    $.ajax({
                                        url: BASE_URL + '/admin/maintenance/matrix/add',
                                        type: 'post',
                                        data: $('#MatrixEntryForm').serialize(),
                                        dataType: 'json',
                                        beforeSend: function () {

                                        },
                                        success: function (msg) {
                                            if (msg.result == "error") {
                                                $('.unique-matrix').html(msg.error);
                                            }else{
                                            transperaRateReload();
                                            $("#myModalAddMatrix").modal("hide");
                                            }
                                        }
                                    });
                                    return true;
                                },
                                cancel: function (button) {
                                    return false;
                                }
                            });
                        }

                    } else if (data == "false") {
                        $('.unique-matrix').html("Input base and ceiling must be unique");
                    }
                    else {
                        $('.unique-matrix').html("Input base and ceiling must be unique");
                    }

                }

            });
        }

    });

    $("#tblTransperaRate").on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "/admin/maintenance/ajax?type=edit-matrix&id=" + id,
            method: 'post',
            beforeSend: function () {

            },//
            success: function (msg) {
                var validator = $('#MatrixEditForm').validate();
                validator.resetForm();
                document.getElementById("baseCurrencyEdit").value = msg.matrix_currency;
                document.getElementById("baseCurrencyEditTo").value = msg.matrix_currency_to;
                document.getElementById("BaseEdit").value = msg.matrix_base;
                document.getElementById("CeillingEdit").value = msg.matrix_ceilling;
                document.getElementById("MatrixRateEdit").value = msg.matrix_rate;
                document.getElementById("matrixId").value = msg.matrix_id;

                $("#myModalEditMatrix").modal("show");
            }
        });
    });


    validateEditRate();
    function validateEditRate() {
        $('#MatrixEditForm').validate({
            framework: 'bootstrap',
            excluded: [':disabled'],
            focusInvalid: false,
            debug: true,
            rules: {
                baseCurrencyEdit: {
                    required: true
                },
                baseCurrencyTo: {
                    required: true
                },
                BaseEdit: {
                    required: true,
                    min: 1
                },
                CeillingEdit: {
                    required: true,
                    min: 1
                },
                MatrixRateEdit: {
                    required: true,
                    min: 1
                }
            }
        });
    }

    $('#updateMatrix').on('click', function (event) {
        var validateEdit = $("#MatrixEditForm").validate();
        var formValEdit = validateEdit.form();
        if(formValEdit){
            $.ajax({
                url: "getMatrixVal?type=getMatrixVal",
                type: 'post',
                data: {
                    from    : $("#baseCurrencyEdit").val(),
                    to      : $("#baseCurrencyEditTo").val(),
                    base    : $("#BaseEdit").val(),
                    ceil    : $("#CeillingEdit").val(),
                    id      : $("#matrixId").val()
                },
                success: function (data) {
                    if (data == 'true') {
                        $('.unique-matrix').html("");

                        if ($('#MatrixEditForm').valid()) {
                            $.confirm({
                                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%;'>Please confirm to save</div>",
                                confirm: function (button) {
                                    $.ajax({
                                        url: BASE_URL + '/admin/maintenance/matrix/edit',
                                        type: 'post',
                                        data: $('#MatrixEditForm').serialize(),
                                        dataType: 'json',
                                        beforeSend: function () {
                                            $().iseziloading('show');
                                        },
                                        success: function (data) {

                                            $().iseziloading('hide');
                                            $("#myModalEditMatrix").modal("hide");
                                        }
                                    });
                                    return true;
                                },
                                cancel: function (button) {
                                    return false;
                                }
                            });
                        }
                    } else if (data == "false") {
                        $('.unique-matrix').html("Input base and ceiling must be unique");
                    } else {
                        $('.unique-matrix').html("Input base and ceiling must be unique");
                    }
                }
            });
        }


    });

//    This method show the data tables for Table Payments
    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        "currency-pre": function (a) {
            a = (a === "-") ? 0 : a.replace(/[^\d\-\.]/g, "");
            return parseFloat(a);
        },
        "currency-asc": function (a, b) {
            return a - b;
        },
        "currency-desc": function (a, b) {
            return b - a;
        }
    });
    function transperaRateReload() {
        $('#tblTransperaRate').dataTable().fnDestroy();
        $('#tblTransperaRate').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=transperaRate-list",
            "lengthMenu": [
                [ 10, 50, -1],
                [ 15, 50, "All"]
            ],
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": true },
                { "aTargets": [ 4 ], "bSortable": true },
                { "aTargets": [ 5 ], "bSortable": false, "sType": "formatted-num" },
                { "aTargets": [ 6 ], "bSortable": false }
            ],
            "order": [0, 'desc'],

            "fnDrawCallback": function (oSettings) {

                var total_count = oSettings.fnRecordsTotal();
                var columns_in_row = $(this).children('thead').children('tr').children('th').length;
                var show_num = oSettings._iDisplayLength;
                var tr_count = $(this).children('tbody').children('tr').length;
                var missing = show_num - tr_count;
                if (show_num < total_count && missing > 0) {
                    for (var i = 0; i < missing; i++) {
                        $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                    }
                }
                else if (show_num > total_count) {
                    for (var i = 0; i < (show_num - tr_count); i++) {
                        $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                    }
                }

                else if (total_count == 0) {
                    for (var i = 0; i < (14 - tr_count); i++) {
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
    }
});