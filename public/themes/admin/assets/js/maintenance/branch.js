$(document).ready(function()
{
    /*added by ajei*/
    $("select[name='branchbankname'] option:eq(0)").attr("disabled", "disabled");
    $("select[name='categoryedit'] option:eq(0)").attr("disabled", "disabled");

    $('.branch').on('keydown', function(e) {
        if (e.which === 32 &&  e.target.selectionStart === 0) {
            return false;
        }
    });


    $('#SearchMyBills').keyup(function(){
        $('#tblbankbran').dataTable().fnFilter($(this).val());
    });
    //This is for viewing  of data from the database
    var BASE_URL = $('#hdnBaseUrl').val();

    bankbranch();
    function bankbranch()
    {
        $('#tblbankbran').dataTable().fnDestroy();
        $('#tblbankbran').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL+"/admin/biller/ajax?type=bankbran-list",
            "lengthMenu": [
                [ 8, 50, -1],
                [ 15, 50, "All"]
            ],
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": true },
                { "aTargets": [ 4 ], "bSortable": true },
                { "aTargets": [ 5 ], "bSortable": false}
            ],
            "order": [0, 'desc'],

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
    }

    $('.filter_c').on('click', function(e){
        $('#filterActive').html($(this).text());
        var id = $(this).data('id');
        $('#tblbankbran').dataTable().fnDestroy();
        $('#tblbankbran').dataTable({
            "aaSorting": [[ 5, "desc" ]],
            "bAutoWidth": false,
            "sDom": '<"top"f>rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=bankbran-list&status="+id,
            "lengthMenu": [
                [ 8, 50, -1],
                [ 15, 50, "All"]
            ],
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": true },
                { "aTargets": [ 4 ], "bSortable": true },
                { "aTargets": [ 5 ], "bSortable": false}
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
    });

    //This is for edit button to edit the data
    $("#tblbankbran").on('click', '.btn-editBank', function ()
    {
        $("#notxistingbranchname").val(1);
        $("#notxistingbranchnameedit").val(1);

        $(".errorbankbranchname").html("<p class='error'></p>");
        $(".errorbranchaddress").html("<p class='error'></p>");
        $(".errorcontactnum").html("<p class='error'></p>");
        $(".errorbank").html("<p class='error'></p>");
        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "/admin/branch/ajax?type=edit-maintenancebranch&id="+id,
            method:'post',
            beforeSend : function ()
            {
            },
            success: function(msg)
            {
                // var img = BASE_URL+"/uploads/logo/"+msg.biller_logo;
                document.getElementById("branchs_id").value=msg.branch_id;
                document.getElementById("branchs_name").value=msg.branch_name;
                document.getElementById("branchs_address").value=msg.branch_address;
                document.getElementById("branchs_contact").value=msg.branch_phonenumber;
                document.getElementById("banks_name").value=msg.branch_bankid;
                document.getElementById("bankbranch_name_reference").value = msg.branch_name;

                $("#myModalEditBankBranch").modal("show");
            }

        });
    });
    //This is for the deactivate button
    $("#tblbankbran").on('click','.btn-deactivateBranches',function()
    {
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button)
            {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-deactivate-branches",
                    beforeSend : function ()
                    {
                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function(req,status)
                    {

                    },
                    success: function(ret){
                        $().iseziloading('hide');
                        global.updateDataTable('tblbankbran');
                    }
                });

            },
            cancel: function(button)
            {

            }

        });
    });
    //This is for the activate button
    $("#tblbankbran").on('click','.btn-activateBranches',function()
    {
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function(button)
            {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-activate-branches",
                    beforeSend : function ()
                    {
                        $().iseziloading('show');
                    },
                    data:
                    {
                        id: id
                    },
                    error: function(req,status)
                    {

                    },
                    success: function(ret)
                    {
                        $().iseziloading('hide');
                        global.updateDataTable('tblbankbran');
                    }
                });

            },
            cancel: function(button)
            {

            }

        });
    });

    //Validates if name is exist
    $(".branch").keyup(function (event)
    {
        var e = $("#"+this.id).val();
        var id = "0";
        if ($("#myModalEditBankBranch").hasClass('in')) {
            id = $("#branchs_id").val();
        }
        $.ajax({
            //Check username if available
            url: BASE_URL + "/branchnameValidator?type=validatebranchname&branch_name="+e+"&branch_id="+id+"&searchtype=branch_name",
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            success: function (data)
            {
                //Check username if unique and available
                if (data.result=="unique") {
                    $("#notxistingbranchname").val("1");
                    $("#notxistingbranchnameedit").val("1");
                    $(".errorbankbranchname").html("<p style='color: green;' class='error'>✓</p>").addClass("glyphicon success").removeClass("danger").css("color","green");
                } else if (e!="") {
                    $("#notxistingbranchname").val("");
                    $("#notxistingbranchnameedit").val("");
                    if($('input#branch_name').val() == $("input#bankbranch_name_reference").val()){
                        $(".errorbankbranchname").removeClass("glyphicon-ok danger success");
                    }
                    else{
                        $(".errorbankbranchname").html("<p class='error'>✘</p>").addClass("glyphicon danger").removeClass("glyphicon-ok success").css("color","red");
                    }
                } else { 
                    $("#notxistingbranchname").val("");
                    $("#notxistingbranchnameedit").val("");
                    $(".errorbankbranchname").html("<p class='error'>✘</p>").addClass("glyphicon danger").removeClass("glyphicon-ok success").css("color","red");
                }
            }
        });
    });

    //removes autocomplete for Branch Name - Adrian
    $("#branch_name").attr('autocomplete', 'off');
    $("#branchs_name").attr('autocomplete', 'off');

    //Save and Validate
    $('#savebankBranch').on('click', function(e)
    {
        e.preventDefault();
        var notxistingbranchname = $("#notxistingbranchname").val();

        var branch_name = document.getElementById("branch_name").value;
        var branch_address = document.getElementById("branch_address").value;
        var branch_contactno = document.getElementById("branch_contactno").value;
        var branchbankname = document.getElementById("branchbankname").value;
        if (branch_name==''){
            $(".errorbankbranchname").html("<p class='error'></p>");
            $(".errorbankbranchname").html("<p class='error'>✘</p>").addClass("glyphicon danger").removeClass("glyphicon-ok success").css("color","red");
            notxistingbranchname = 0;
        }
        if (branch_address==''){
            $(".errorbranchaddress").html("<p class='error'></p>");
            $(".errorbranchaddress").html("<p class='error'>✘</p>").addClass("glyphicon danger").removeClass("glyphicon-ok success").css("color","red");
            notxistingbranchname = 0;
        } else {
            $(".errorbranchaddress").html("<p class='error'></p>");
        }
        if (branch_contactno==''){
            $(".errorcontactnum").html("<p class='error'></p>");
            $(".errorcontactnum").html("<p class='error'>✘</p>").addClass("glyphicon danger").removeClass("glyphicon-ok success").css("color","red");
            notxistingbranchname = 0;
        } else {
            $(".errorcontactnum").html("<p class='error'></p>");
        }
        if (branchbankname > '0'){
            $(".errorbank").html("<p class='error'></p>");

        } else {
            $(".errorbank").html("<p class='error'></p>");
            $(".errorbank").html("<p class='error'>✘</p>").addClass("glyphicon danger").removeClass("glyphicon-ok success").css("color","red");
            notxistingbranchname = 0;
        }

        if (notxistingbranchname==1) {
            $("#BankBranchEntryForm").submit();
        }
    });

    //Ajax form for Add Bank Branch - Adrian
    var options = {
        beforeSerialize: function() {
            if($('.errorbankbranchname').hasClass('success')){

                $.confirm({
                    text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%;'>Are you sure you want to save?</div>",
                    confirm: function (button) {
                        global.updateDataTable('tblbankbran');
                        $('#myModalAddBankBranch').modal('hide');
                    },
                    cancel: function (button) {
                        return false;
                    }
                });
            }
            else {
                $(".errorbankbranchname").html("<p class='error'>✘</p>").addClass("glyphicon danger").removeClass("glyphicon-ok success").css("color","red");
                return false
            }
        }

    };
    $('#BankBranchEntryForm').ajaxForm(options);

    //Ajax form for Edit Bank Branch - Adrian
    var options = {
        beforeSerialize: function() {
            if($('.errorbankbranchname').hasClass('success') || $('input#branch_name').val() == $('input#bankbranch_name_reference').val()){

                $.confirm({
                    text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%;'>Are you sure you want to save?</div>",
                    confirm: function (button) {
                        global.updateDataTable('tblbankbran');
                        $('#myModalEditBankBranch').modal('hide');
                    },
                    cancel: function (button) {
                        return false;
                    }
                });
            }
            else {
                $(".errorbankbranchname").html("<p class='error'>✘</p>").addClass("glyphicon danger").removeClass("glyphicon-ok success").css("color","red");
                return false
            }
        }

    };

        $('#BankBranchEntryForms').ajaxForm(options);

    //To show the modal add
    $("#btnAddBankBranch").click(function ()
    {
        $(".errorbankbranchname").html("<p class='error'></p>");
        $(".errorbranchaddress").html("<p class='error'></p>");
        $(".errorcontactnum").html("<p class='error'></p>");
        $(".errorbank").html("<p class='error'></p>");
        document.getElementById('BankBranchEntryForm').reset();
        $("#myModalAddBankBranch").modal("show");
    });

    //Validation for adding a contact number that number only requires
    $("#branch_contactno").keydown(function (e)
    {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    //Validation for edot contact number
    $("#branchs_contact").keydown(function (e)
    {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    //Validates copy paste
    $('body').bind('copy paste',function(e) {
        e.preventDefault();
        return false;
    });
    //Sort for dropdown menu
    $("#branchbankname").html($('#branchbankname option').sort(function(x, y) {
        return $(x).text().toUpperCase() < $(y).text().toUpperCase() ? -1 : 1;
    }));
    $("#banks_name").html($('#banks_name option').sort(function(x, y) {
        return $(x).text().toUpperCase() < $(y).text().toUpperCase() ? -1 : 1;
    }));
});