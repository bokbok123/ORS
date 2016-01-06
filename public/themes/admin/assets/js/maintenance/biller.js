$(document).ready(function ()
{

    $('#SearchMyBills').keyup(function(){
        $('#tblbiller').dataTable().fnFilter($(this).val());
    });

    $("#edit_billlogoini").hide();
    $("#edit_billlogoini").click(function()
    {
        $('#imagesbilleredit').val(1);
        $("#edit_billlogoini").hide();
    });
    $("#billers_logo_value").click(function()
    {
        $('#imagesbilleredit').val(1);
    });
    $(".fileinput-new").click(function()
    {
        $("#edit_billlogoini").hide();
    });
    $('.biller').on('keydown', function(e) {
        if (e.which === 32 &&  e.target.selectionStart === 0) {
            return false;
        }
    });
    //For viewing of contents of datatable
    var BASE_URL = $('#hdnBaseUrl').val();
    biller();
    function biller()
    {
        $('#tblbiller').dataTable().fnDestroy();
        $('#tblbiller').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=biller-list",
            "lengthMenu": [
                [ 8, 50, -1],
                [ 15, 50, "All"]
            ],
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": false }
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
        $('#tblbiller').dataTable().fnDestroy();
        $('#tblbiller').dataTable({
            "aaSorting": [[ 5, "desc" ]],
            "bAutoWidth": false,
            "sDom": '<"top"f>rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=biller-list&status="+id,
            "lengthMenu": [
                [8, 50, -1],
                [ 15, 50, "All"]
            ],
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": false }
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

    //This is for edit button
    $("#tblbiller").on('click', '.btn-editBiller', function ()
    {
        $("#notxistingbillername").val(1);
        $("#notxistingbillernames").val(1);
        $(".errorbillername").html("<p class='error'></p>");
        $(".errorbillercategoy").html("<p class='error'></p>");
        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "/admin/maintenance/ajax?type=edit-maintenancebiller&id=" + id,
            method: 'post',
            beforeSend: function ()
            {

            },//
            success: function (msg)
            {
                $("#myModalLabel").html("Edit Biller");
                var img = BASE_URL + "/uploads/logo/" + msg.biller_logo;
                document.getElementById("billers_id").value = msg.biller_id;
                document.getElementById("billerNames").value = msg.biller_name;
//                document.getElementById("billerAccounts").value = msg.biller_account;
                document.getElementById("categorys_id").value = msg.biller_category;
                if(msg.biller_logo != "") {
                    $("#edit_billlogoini").show();
                   document.getElementById("imgContainers").innerHTML = "<img style='height: 150px;' id='preview_images' src='" + img + "'>";

                }
                $("#myModalEditBiller").modal("show");

            }
        });
    });

    //This is deactivating button
    $("#tblbiller").on('click', '.btn-deactivateBiller', function ()
    {
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Deactivation</div>",
            confirm: function (button)
            {
                $.ajax({
                    type: 'post',
                    url: BASE_URL + "/admin/biller/ajax?type=btn-deactivate-biller",
                    beforeSend: function ()
                    {

                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function (req, status)
                    {

                    },
                    success: function (ret)
                    {
                        $().iseziloading('hide');
                        global.updateDataTable('tblbiller');
                    }
                });

            },
            cancel: function (button)
            {

            }

        });
    });
    //This is activating button
    $("#tblbiller").on('click', '.btn-activateBiller', function ()
    {
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function (button)
            {
                $.ajax({
                    type: 'post',
                    url: BASE_URL + "/admin/biller/ajax?type=btn-activate-biller",
                    beforeSend: function ()
                    {
                        $().iseziloading('show');
                    },
                    data:
                    {
                        id: id
                    },
                    error: function (req, status)
                    {

                    },
                    success: function (ret)
                    {
                        $().iseziloading('hide');
                        global.updateDataTable('tblbiller');
                    }
                });

            },
            cancel: function (button)
            {

            }

        });
    });

    //To reset the fields after clicking cancel
    $("#btncanceladdbiller").click(function ()
    {
        document.getElementById('BillerEntryForm').reset();
        var validator = $('#BillerEntryForm').validate();
        validator.resetForm();
        $(".errorimage").html("");
    });

    $("#btncanceleditbiller").click(function ()
    {
        document.getElementById('BillerEntryForms').reset();
        $("#edit_billlogoini").hide();
        $('#imgContainers').empty();
        $(".errorimage").html("");
    });


    //Ajax form for Add Biller - Adrian add
    var options = {


        beforeSubmit:  function(){

            $().iseziloading('show');
        },
        success:       function(data){
            if(data.errors){
                $(".errorimage").html("<p class='error'>"+ data.errors +"</p>");
            }else{

                global.updateDataTable('tblbiller');
                $("#myModalAddBiller").modal("hide");
                $().iseziloading('hide');
            }
        }
    };
    $('#BillerEntryForm').ajaxForm(options);


    //To show the modal add
    $("#btnAddbiller").click(function ()
    {
        $("#myModalAddBiller").modal("show");


        $("#myModalLabel").html("Add Biller");

        $(".errorbillername").html("<p class='error'></p>");
        $(".errorbillercategoy").html("<p class='error'></p>");
        document.getElementById('BillerEntryForm').reset();
        document.getElementById('preview_image').removeAttribute('src');
    });

    // This part is for image or logo requirements for uploading

    //Check name if exist
    $(".biller").keyup(function (event)
    {
        var e = $("#"+this.id).val();
        var id = "0";
        if ($("#myModalEditBiller").hasClass('in')) {
            id = $("#billers_id").val();
        }
        $.ajax({
            //Check username if available
            url: BASE_URL + "/billernameValidator?type=validatebillername&biller_name="+e+"&biller_id="+id+"&searchtype=biller_name",
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            success: function (data)
            {
                //Check username if unique and available
                if (data.result=="unique") {

                       $("#notxistingbillername").val("1");
                       $("#notxistingbillernames").val("1");
                       $(".errorbillername").html("<p class='avai' style='color: green';>Available</p>");
                    $('#savebiller').attr('disabled',false);

                } else if (e!="") {
                    $("#notxistingbillername").val("");
                    $("#notxistingbillernames").val("");
                    $(".errorbillername").html("<p class='error'>Name already exist</p>");
                    $('#savebiller').attr('disabled',true);
                } else {
                    $("#notxistingbillername").val("");
                    $("#notxistingbillernames").val("");
                    $(".errorbillername").html("");
                }

            }
        });
    });

    //Ajax form for Edit Biller
    var optionsEdit = {
        beforeSerialize: function() {
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%'>Are you sure you want to save?</div>",
                confirm: function (button) {
                    global.updateDataTable('tblbiller');
                    $('#myModalEditBiller').modal('hide');
                },
                cancel: function (button) {
                    return false;
                }
            });
        }
    };
    $('#BillerEntryForms').ajaxForm(optionsEdit);

    //Edit and Validate
    $('#saveeditbiller').on('click', function(e)
    {
        e.preventDefault();
        var billereditcheck = $("#notxistingbillernames").val();
        var e4 = document.getElementById("billerNames").value;
        var e6 = document.getElementById("categorys_id").value;

        if (e4==''){
            $(".errorbillername").html("<p class='error'>This field is required</p>");
            billereditcheck = 0;
        }
        if (e6 >'0') {
            $(".errorbillercategoy").html("<p class='error'></p>");
        } else {
            $(".errorbillercategoy").html("<p class='error'>This field is required</p>");
            billereditcheck = 0;
        }
        if (billereditcheck==1) {
            $("#BillerEntryForms").submit();
        }
    });
    //Save and validate

    $("#biller_logo").change(function() {

        var val = $(this).val();

        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'jpeg': case 'jpg': case 'png':
            $(".errorimage").html("");
            break;
            default:
                $(this).val('');
                // error message here
                $(".errorimage").html("<p class='error'>Invalid file extension</p>");
                break;
        }
    });
    $("#edit_biller_logo").change(function() {

        var val = $(this).val();

        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'jpeg': case 'jpg': case 'png':
            $(".errorimage").html("");
            $('#imgContainers').append('<img id="preview_images" src="" style="height: 150px;">');
            $('#preview_images').remove();
            break;
            default:
                $(this).val('');
                $('#preview_images').remove();
                // error message here
                $(".errorimage").html("<p class='error'>Invalid file extension</p>");
                break;
        }
    });
    document.getElementById("biller_logo").onchange = function () {
        $(this).valid();
    };
    $('#savebiller').on('click', function(event)
    {
        $('#BillerEntryForm').focus();
        event.preventDefault();
        $('#BillerEntryForm').validate({
            onload: function(element){this.element(element);},
            onkeyup: function(element){this.element(element);},
            onfocusout: function(element){this.element(element);},
            focusInvalid: false,
            debug: true,
            rules: {
                biller_logo: {
                    accept: "jpg|jpeg|png"
                },
                category: {
                    required:true
                },
                billerName: {
                    required:true
                }
            }
        });
        if($('#BillerEntryForm').valid()) {
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",
                confirm: function (button) {

                        $("#BillerEntryForm").submit();
                },
                cancel: function (button) {
                    return false;
                }
            });
        }

    });

    //Validation for number only allow
    $("#billerAccounts").keydown(function (e)
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
    //Validation for number only allow
    $("#billerAccount").keydown(function (e)
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
    $('body').bind('copy paste',function(e) {
        e.preventDefault();
        return false;
    });

    //Sort for dropdown menu
    $("#category_id").html($('#category_id option').sort(function(x, y) {
        return $(x).text().toUpperCase() < $(y).text().toUpperCase() ? -1 : 1;
    }));
    $("#categorys_id").html($('#categorys_id option').sort(function(x, y) {
        return $(x).text().toUpperCase() < $(y).text().toUpperCase() ? -1 : 1;
    }));



    function readURL() {
        $('#preview_image').attr('src', '').hide();
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            $(reader).load(function(e) {
                $('#preview_image')
                    .attr('src', e.target.result)
            });
            reader.readAsDataURL(this.files[0]);
        }
    }

    $('#preview_image')
        .load(function(e) {

            $(this).css('height', '147px').show();
        })
        .hide();

    $("#biller_logo").change(readURL);


    function edit_readURL() {
        $('#preview_images').attr('src', '').hide();
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            $(reader).load(function(e) {
                $('#preview_images')
                    .attr('src', e.target.result)
            });
            reader.readAsDataURL(this.files[0]);
        }
    }


    $('#preview_images')
        .load(function(e) {

            $(this).css('height', '200px').css('width','200px').show();
        })
        .hide();

    $("#edit_biller_logo").change(edit_readURL);
    $('#edit_biller_logo').change(function(e){
        $('#preview_images').css('display','inherit');
    });

    $("select[name='category'] option:eq(0)").attr("disabled", "disabled");
    $("select[name='categoryedit'] option:eq(0)").attr("disabled", "disabled");
});