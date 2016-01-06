$(document).ready(function ()
{
    $('#SearchMyBills').keyup(function(){
        $('#tblBank').dataTable().fnFilter($(this).val());
    });

    $('#btncanceleditbank, #btncanceladdbank').on('click', function (){
        $('#myModalEditBank span.NoBankName, #myModalAddBank span.NoBankName  ').css('display','none');
    });
    //For getting and removing logo/image
    $("#banklogoini").hide();
    $("#banklogoini").click(function()
    {
        $('#imagesbankedit').val(1);
        $("#banklogoini").hide();
    });
    $("#banklogoinidef").click(function()
    {
        $('#imagesbankedit').val(1);
    });
    $(".fileinput-new").click(function()
    {
        $("#banklogoini").hide();
    });
    $('.bank').on('keydown', function(e) {
        if (e.which === 32 &&  e.target.selectionStart === 0) {
            return false;
        }
    });
    //This is for viewing the content of datatable
    var BASE_URL = $('#hdnBaseUrl').val();
    $('#tblBank').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=bank-list",
        "lengthMenu": [
            [ 10, 50, -1],
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

    $('.filter_c').on('click', function(e){
        $('#filterActive').html($(this).text());
        var id = $(this).data('id');
        $('#tblBank').dataTable().fnDestroy();
        $('#tblBank').dataTable({
            "aaSorting": [[ 5, "desc" ]],
            "bAutoWidth": false,
            "sDom": '<"top"f>rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=bank-list&status="+id,
            "lengthMenu": [
                [ 10, 50, -1],
                [ 15, 50, "All"]
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

    //This is for the deactivating button
    $("#tblBank").on('click', '.btn-deactivateBank', function ()
    {
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function (button)
            {
                $.ajax({
                    type: 'post',
                    url: BASE_URL + "/admin/biller/ajax?type=btn-deactivate-bank",
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
                        global.updateDataTable('tblBank');
                    }
                });

            },
            cancel: function (button)
            {

            }

        });
    });
    //This is for the edit button to edit the content
    $("#tblBank").on('click', '.btn-editBank', function ()
    {
        $("#notxistingbank").val(1);
        $("#notxistingbankedit").val(1);
        $(".errorbankname").html("<p class='error'></p>");
        $(".errorbranchname").html("<p class='error'></p>");
        $(".erroraddress").html("<p class='error'></p>");
        $(".erroracontact").html("<p class='error'></p>");

        var id = $(this).data('id');

        $.ajax({
            url: BASE_URL + "/admin/bank/ajax?type=edit-maintenancebank&id=" + id,
            method: 'post',
            beforeSend: function ()
            {

            },
            success: function (msg)
            {

                var img = BASE_URL + "/uploads/logo/bank/" + msg.bank_logo;
                document.getElementById("banks_id").value = msg.bank_id;
                document.getElementById("bank_names").value = msg.bank_name;
                document.getElementById("bank_name_reference").value = msg.bank_name;
                if(msg.bank_logo != "") {
                    $("#banklogoini").show();
                    document.getElementById("imgContainers").innerHTML = "<img style='height: 200px;' id='preview_images' src='" + img + "'>";
                }
                $("#myModalEditBank").modal("show");

            }

        });
        $(".errorbankname").html("<p class='error'></p>").removeClass("glyphicon-ok success glyphicon-remove danger");
    });

    //This is for activate button
    $("#tblBank").on('click', '.btn-activateBank', function ()
    {
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function (button)
            {
                $.ajax({
                    type: 'post',
                    url: BASE_URL + "/admin/biller/ajax?type=btn-activate-bank",
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
                        global.updateDataTable('tblBank');
                    }
                });

            },
            cancel: function (button)
            {

            }

        });
    });

    //To show the modal for adding
    $("#btnAddBank").click(function ()
    {
        $("#myModalAddBank").modal("show");
        $("#banklogoini").click();
        $("#myModalLabel").html("Add Bank");
        document.getElementById('preview_image').removeAttribute('src');
        $(".errorbankname").html("<p class='error'></p>");
        document.getElementById('myForm').reset();
        $(".errorbankname").html("<p class='error'></p>").removeClass("glyphicon-ok success glyphicon-remove danger");
    });

    //This part for meet the requirements for uploading and edting image
    $('#image').change(function ()
    {
        validateUpload(this.files[0]);
    });
    $('#images').change(function ()
    {
        validateUpload(this.files[0]);
    });
    function validateUpload(file)
    {

        /*@uploadFile This is for file parameter.*/
        /*@image This is for new Instantiate of image class.*/
        /*@reader This is for new Instantiate of FileReader class.*/
        /*@uploadFileName This is for image file name.*/
        /*@fileType This is for uploaded image file type*/

        var uploadFile = file;
        var image = new Image();
        var reader = new FileReader();
        if(uploadFile) {
            var uploadFileName = uploadFile.name;
            var fileType = uploadFileName.split('.')[uploadFileName.split('.').length - 1].toLowerCase();


            if (fileType == 'png' || fileType == 'jpeg' || fileType == 'jpg') {
                reader.readAsDataURL(uploadFile);
                reader.onload = function (_file)
                {
                    image.src = _file.target.result;
                    image.onload = function ()
                    {
                        var w = this.width;
                        var h = this.height;

                        if (w > 240 && h > 70) {
                            var imgContainer = document.getElementById("imgContainer");
                            $(".warning").text("File Size must be 240 x 70 pixels");
                        } else {
                            $(".warning").text("");
                        }
                    };
                };
            } else {
                $(".warning").text("File type not supported.");
            }
        }
    }

    //Validate name required as unique
    $(".bank").keyup(function (event)
    {
        var e = $("#"+this.id).val();
        var id = "0";
        if ($("#myModalEditBank").hasClass('in')) {
            id = $("#banks_id").val();
        }
        $.ajax({
            //Check username if available
            url: BASE_URL + "/bankValidator?type=validatebank&bank_name="+e+"&bank_id="+id+"&searchtype=bank_name",
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            success: function (data)
            {
                //Check username if unique and available
                if (data.result=="unique") {
                    $("#notxistingbank").val("1");
                    $("#notxistingbankedit").val("1");
                    $("span.NoBankName").hide();
                    $("span.BankNameAE").hide();
                    $(".errorbankname").html("<p class='error'></p>").addClass("glyphicon success").removeClass("glyphicon-remove danger").css("color","green");
                } else if (e!="") {
                    $("#notxistingbank").val("");
                    $("#notxistingbankedit").val("");
                    if($('input#bank_names').val() == $("input#bank_name_reference").val()){
                        $("span.BankNameAE").show();
                        $("span.NoBankName").hide();
                        $(".errorbankname").html("<p class='error'></p>").addClass(" danger").removeClass("glyphicon-ok success").css("color","red");
                    }
                    else if($('input#bank_names').val() || $('input#bank_name').val() == ""){
                        $("span.BankNameAE").show();
                        $(".errorbankname").html("<p class='error'></p>").addClass("glyphicon  danger").removeClass("glyphicon-ok success").css("color","red");
                    }
                    else{
                        if($('input#bank_names').val() || $('input#bank_name').val() == ""){
                            $("span.NoBankName").show();
                        }
                        else{
                            $("span.BankNameAE").hide();
                        }
                        $("span.BankNameAE").hide();
                        $("span.NoBankName").show().text("Please enter Bank Name");
                        $(".errorbankname").html("<p class='error'></p>").addClass("glyphicon  danger").removeClass("glyphicon-ok success").css("color","red");
                    }
                } else {
                    $("#notxistingbank").val("");
                    $("#notxistingbankedit").val("");
                    $("span.BankNameAE").hide();
                    $("span.NoBankName").show().text("Please enter Bank Name");
                    $(".errorbankname").html("<p class='error'></p>").addClass("glyphicon  danger").removeClass("glyphicon-ok success").css("color","red");

                }
            }
        });
    });

    $("span.BankNameAE").hide();
    $("span.NoBankName").hide();

    //removes autocomplete for Bank Name - Adrian
    $("#bank_names").attr('autocomplete', 'off');
    $("#bank_name").attr('autocomplete', 'off');

    //Ajax Form for Add Bank - Adrian
    var options = {
        beforeSerialize: function() {

            if($('.errorbankname').hasClass('success')){
                $.confirm({
                    text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%;'>Are you sure you want to save?</div>",
                    confirm: function (button) {
                        global.updateDataTable('tblBank');
                        $('#myModalAddBank').modal('hide');
                        $(".errorbankname").html("<p class='error'></p>").removeClass("glyphicon-ok success glyphicon-remove danger");
                    },
                    cancel: function (button) {
                        return false;
                    }
                });
            }
            else {
                $(".errorbankname").html("<p class='error'></p>").addClass("glyphicon  danger").removeClass("glyphicon-ok success").css("color","red");
                if($('input#bank_name').val()==""){
                    $("span.NoBankName").show().text("Please enter Bank Name");
                }
                else{
                    $("span.NoBankName").show().text("Bank Name already exist");
                }
                $("span.BankNameAE").hide();
                return false
            }
        }
    };
    $('#myForm').ajaxForm(options);

    //Ajax form for Edit Bank - Adrian
    var options = {
        beforeSerialize: function() {

            if($('.errorbankname').hasClass('success') || $('input#bank_names').val() == $('input#bank_name_reference').val()){

                $.confirm({
                    text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%;'>Are you sure you want to save?</div>",
                    confirm: function (button) {
                        global.updateDataTable('tblBank');
                        $('#myModalEditBank').modal('hide');
                        $(".errorbankname").html("<p class='error'></p>").removeClass("glyphicon-ok success glyphicon-remove danger");
                    },
                    cancel: function (button) {
                        return false;
                    }
                });
            }
            else {
                $(".errorbankname").html("<p class='error'></p>").addClass("glyphicon  danger").removeClass("glyphicon-ok success").css("color","red");
                if($('input#bank_names').val()==""){
                    $("span.NoBankName").show().text("Please enter Bank Name");
                }
                else{
                    $("span.NoBankName").show().text("Bank Name already exist");
                }
                $("span.BankNameAE").hide();
                return false
            }
        }

    };
    $('#BankEntryForms').ajaxForm(options);

    //Validate number in contact
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

    //Validate for copy paste
    $('#bank_name').bind('paste', function (e) {
        e.preventDefault();
    });
    $('#branch_name').bind('paste', function (e) {
        e.preventDefault();
    });
    $('#branch_contactno').bind('paste', function (e) {
        e.preventDefault();
    });
    $('#bank_names').bind('paste', function (e) {
        e.preventDefault();
    });


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

    function readURLs() {
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

    $('#preview_image')
        .load(function(e) {

            $(this).css('height', '200px').show();
        })
        .hide();

    $("#image").change(readURL);

    $('#preview_images')
        .load(function(e) {

            $(this).css('height', '200px').show();
        })
        .hide();

//    $("#images").change(readURLs);
    $("#images").change(edit_readURL);
    $('#images').change(function(e){
        $('#preview_images').css('display','inherit');
    });
});