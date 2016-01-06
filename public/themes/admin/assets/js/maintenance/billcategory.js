$(document).ready(function ()
{
    //This is for viewing of datatable
    $('#SearchMyBills').keyup(function(){
        $('#tblbillerCate').dataTable().fnFilter($(this).val());
    });

    var BASE_URL = $('#hdnBaseUrl').val();
    billcat();
    function billcat()
    {
        $('#tblbillerCate').dataTable().fnDestroy();
        $('#tblbillerCate').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=billerCate-list",


            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": false }
            ],
            "lengthMenu": [
                [ 11, 50, -1],
                [ 15, 50, "All"]
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
    //This is for deactivating the button
    $('.filter_c').on('click', function(e){
        $('#filterActive').html($(this).text());
        var id = $(this).data('id');
        $('#tblbillerCate').dataTable().fnDestroy();
        $('#tblbillerCate').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=billerCate-list&status="+id,


            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": false }
            ],
            "lengthMenu": [
                [ 11, 50, -1],
                [ 15, 50, "All"]
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
    });
    $("#tblbillerCate").on('click', '.btn-deactivateBill', function ()
    {
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function (button)
            {
                $.ajax({
                    type: 'post',
                    url: BASE_URL + "/admin/biller/ajax?type=btn-deactivate",
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
                        global.updateDataTable('tblbillerCate');
                    }
                });

            },
            cancel: function (button)
            {

            }

        });
    });
    //This is for activating the button
    $("#tblbillerCate").on('click', '.btn-activateBill', function ()
    {
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function (button)
            {
                $.ajax({
                    type: 'post',
                    url: BASE_URL + "/admin/biller/ajax?type=btn-activate",
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
                    success: function ()
                    {
                        $().iseziloading('hide');
                        global.updateDataTable('tblbillerCate');

                    }
                });

            },
            cancel: function (button)
            {

            }

        });
    });

    //This is edting the content of datatable
    $("#tblbillerCate").on('click', '.btn-editCategory', function ()
    {
        $("#myModalLabel").text("EDIT BILLER CATEGORY");

        $("#notxistingcate").val(1);
        $("#notxistingeditcate").val(1);
        $(".errorcategory").html("<p class='error'></p>");
        $(".errordescription").html("<p class='error'></p>");

        var id = $(this).data('id');
        $("#myModalLabel").html("Edit Biller Category");
        $.ajax({
            url: BASE_URL + "/admin/biller/ajax?type=edit-billerCategory&id=" + id,
            method: 'post',
            beforeSend: function ()
            {

            },//
            success: function (msg)
            {
                document.getElementById("categoryedit").value = msg.categoryName;
                document.getElementById("descriptionedit").value = msg.categoryDesc;
                document.getElementById("categoryedit_id").value = msg.categoryId;

                $("#myModalEditBillerCate").modal("show");

            }
        });

    });

    //To open the add modal

    $('#description, #descriptionedit').keyup(function () {
        if($(this).val() != "") {
            $(".errordescription").css({'display': 'none'});
        }
    });

//    $('#description, #descriptionedit').on('blur', function () {
//        if($(this).val() != "") {
//            $(".errordescription").css({'display': 'none'});
//        } else {
//            $(".errordescription").css({'display': 'block'});
//            $(".errordescription").html("<p class='error'>This field is required</p>");
//        }
//    });

    $('#categoryedit').keyup(function () {
        if($(this).val() == "") {
            $(".errorcategory").css({'display': 'none'});
        }

//        else {
////            $(".errorcategory").css({'display': 'block'});
//            $(".errorcategory").html("<p class='avai' style='color: green';>Available</p>");
//
//        }
    });


    $("#btnAddbillerCate").click(function ()
    {
        $("#myModalAddBillerCate").modal("show");
        $("#myModalLabel").text("ADD BILLER CATEGORY");
        $(".errorcategory").html("<p class='error'></p>");
        $(".errordescription").html("<p class='error'></p>");
        document.getElementById('form').reset();

    });
    $("#btncanceladdbillerCate").click(function ()
    {
        document.getElementById('form').reset();
    });

    //Check if name is exist
    $('.billercategory').on('keydown', function(e) {
        if (e.which === 32 &&  e.target.selectionStart === 0) {
            return false;
        }
    });
    $(".billercategory").keyup(function (event)
    {
        var e = $("#"+this.id).val();
        var id = "0";
        if ($("#myModalEditBillerCate").hasClass('in')) {
            id = $("#categoryedit_id").val();
        }
        $.ajax({
            //Check username if available
            url: BASE_URL + "/desValidator?type=validatedes&category_Id="+id+"&category_name="+e+"&searchtype=category_name",
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            success: function (data)
            {
                //Check username if unique and available
                if (data.result=="unique") {
                    $("#notxistingcate").val("1");
                    $("#notxistingeditcate").val("1");
                    $(".errorcategory").html("<p class='avai' style='color: green';>Available</p>");
                } else if (e!="") {

                    $("#notxistingcate").val("");
                    $("#notxistingeditcate").val("");
                    $(".errorcategory").html("<p class='error'>Name already exist</p>");
                } else {
                    $("#notxistingcate").val("");
                    $("#notxistingeditcate").val("");
                    $(".errorcategory").html("<p class='error'></p>");
                }
            }
        });
    });
    //Save and Validate
    $('#savebillerCate').on('click', function(e)
    {
        e.preventDefault();
        var notxistingcat = $("#notxistingcate").val();

        var catname = $('#category').val();
        var description = $('#description').val();
        if (!$.trim(catname).length){
            $(".errorcategory").html("<p class='error'>This field is required</p>");
             notxistingcat=0;
        }
        if (!$.trim(description).length){
            $(".errordescription").html("<p class='error'>This field is required</p>");
            notxistingcat=0;
        } else {
            $(".errordescription").html("<p class='error'></p>");
        }
        if (notxistingcat==1) {
            $("#form").submit();
        }
    });
    //Edit/Update and validate


//Ajax form for Edit Biller Category - Adrian
    var options = {
        beforeSerialize: function() {
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%;'>Are you sure you want to save?</div>",
                confirm: function (button) {
                    global.updateDataTable('tblbillerCate');
                    $('#myModalEditBillerCate').modal('hide');
                },
                cancel: function (button) {
                    return false;
                }
            });
        }
    };
    $('#formedit').ajaxForm(options);

    //Ajax form for Add Biller Category - Adrian
    var options = {
        beforeSerialize: function() {
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%;'>Are you sure you want to save?</div>",
                confirm: function (button) {
                    global.updateDataTable('tblbillerCate');
                    $('#myModalAddBillerCate').modal('hide');
                },
                cancel: function (button) {
                    return false;
                }
            });
        }
    };
    $('#form').ajaxForm(options);



    $('#savebillerEditCate').on('click', function(e)
    {
        e.preventDefault();
        var notxistingeditcate = $("#notxistingeditcate").val();

        var categoryedit =  $('#categoryedit').val();
        var descriptionedit = $('#descriptionedit').val();

        if (!$.trim(categoryedit).length) {
            $(".errorcategory").css('display','block');
            $(".errorcategory").html("<p class='error'>This field is required</p>");
            notxistingeditcate = 0;
        }
        if (!$.trim(descriptionedit).length) {
            $(".errordescription").css('display','block');
            $(".errordescription").html("<p class='error'>This field is required</p>");
            notxistingeditcate = 0;
        } else {
            $(".errordescription").html("<p class='error'></p>");
        }
        if (notxistingeditcate==1) {
            $("#formedit").submit();
        }
    });
    //Disable Copy Paste
    window.onload = function() {
        var myInput = document.getElementById('category');
        myInput.onpaste = function(e) {
            e.preventDefault();
        }
    }
    window.onload = function() {
        var myInput = document.getElementById('categoryedit');
        myInput.onpaste = function(e) {
            e.preventDefault();
        }
    }

});