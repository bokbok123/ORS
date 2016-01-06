$(document).ready(function ()
{
    var BASE_URL = $('#hdnBaseUrl').val();
    forex();
    currency();

    $('#SearchMyBills').keyup(function(){
        $('#tblForex').dataTable().fnFilter($(this).val());
    });

    $("#btnAddForex").on('click',function(){
        $('#myModalAddForex').modal('show');
    });
    $("#btnAddCountry").on('click',function(){
        $('#myModalAddCountry').modal('show');
        document.getElementById('preview_image').removeAttribute('src');

    });

    $('#countryName').on('keydown', function(e) {
        if (e.which === 32 &&  e.target.selectionStart === 0) {
            return false;
        }
    });
    $('#forexRateEdit').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });
    $('#savebiller').on('click',function(event){
        event.preventDefault();
        $('#ForexEntryForm').validate({
            focusInvalid: false,
            debug: true,
            rules: {
                baseCurrency:{
                    required:true
                },
                targetCurrency:{
                    required:true
                },
                forexRate:{
                    required:true,
                    max:999999
                }
            }
        });
        if($('#ForexEntryForm').valid()) {
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%'>Are you sure you want to save?</div>",
                confirm: function(button)
                {
                    global.updateDataTable('tblForex');
                    $('#myModalAddForex').modal('hide');
                    $.ajax({
                        url: BASE_URL+ '/admin/maintenance/forex/add',
                        type: 'post',
                        data: $('#ForexEntryForm').serialize(),
                        dataType: 'json',
                        beforeSend : function ()
                        {
//                            $().iseziloading('show');
                        },
                        success: function (){
//                            $().iseziloading('hide');
                        }
                    });
                    return true;
                },
                cancel: function(button)
                {
                    return false;
                }
            });
        }

    });

    /*added by ajei*/
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

            $(this).css('height', '148px').show();
        })
        .hide();

    $("#country_logo").change(readURL);

//
//    $('#savecountry').on('click', function(e){
//        e.preventDefault();
//            $( "#AddCountryForm" ).validate({
//                onkeyup: function(element){this.element(element);},
//                onfocusout: function(element){this.element(element);},
//                rules: {
//                    country_name: {
//                        required: true
//                    },
//                    country_code: {
//                        required: true
//                    },
//                    country_logo: {
//                        required: true,
//                        extension: "png|jpe?g|gif"
//                    }
//                },
//                messages:
//                {
//                    image: {
//                        extension: "File type is not supported"
//                    }
//                }
//            });
//            if($('#AddCountryForm').valid()) {
//                $.confirm({
//                    text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%'>Are you sure you want to save?</div>",
//                    confirm: function(button)
//                    {
//                        global.updateDataTable('tblForex');
//                        $('#myModalAddForex').modal('hide');
//                        $.ajax({
//                            url: BASE_URL+ '/admin/maintenance/forex/countrysave',
//                            type: 'post',
//                            data: $('#AddCountryForm').serialize(),
//                            dataType: 'json',
//                            beforeSend : function ()
//                            {
//        //                            $().iseziloading('show');
//                            },
//                            success: function (data){
//                                if(data.success==false){
//                                    $('#unique-error').html(data.errors);
//                                }else{
//                                    $('#myModalAddCountry').modal('hide');
//                                    global.updateDataTable('tblCurrency');
//                                }
//                            },
//                            error: function(){
//                            }
//
//                        });
//                        return true;
//                    },
//                    cancel: function(button)
//                    {
//                        return false;
//                    }
//                });
//            }
//    });
//
//    $('#myModalAddCountry').on('hidden.bs.modal', function(e)
//    {
//        e.preventDefault();
//        $('#AddCountryForm').reset();
//        var validator = $('#AddCountryForm').validate();
//        validator.resetForm();
//    });


    $( "#AddCountryForm" ).validate({
        onkeyup: function(element){this.element(element);},
        onfocusout: function(element){this.element(element);},
        rules: {
            country_name: {
                required: true
            },
            country_code: {
                required: true
            },
            country_logo: {
                required: true,
                extension: "png|jpe?g|gif"
            }
        },
        messages:
        {
            image: {
                extension: "File type is not supported"
            }
        }
    });
    var options = {
        beforeSubmit: function()
        {
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",
                confirm: function (button) {


                    return true;
                },
                cancel: function (button) {
                    return false;
                }
            });
        },

        success: function(data)
        {
            if(data.success==false){
                $('#unique-error').html(data.errors);
            }else{
                $('#myModalAddCountry').modal('hide');
                global.updateDataTable('tblCurrency');
            }
//            global.updateDataTable('tblCurrency');
        },
        complete: function()
        {},
        error: function(err)
        {}
    };

    $('#myModalAddCountry').on('hidden.bs.modal', function(e)
    {
        e.preventDefault();
//        $('#AddCountryForm').reset();
        var validator = $('#AddCountryForm').validate();
        validator.resetForm();
    });
    $("#AddCountryForm").ajaxForm(options);
    /*end*/
    $.validator.addMethod('minStrict', function (value, el, param) {
        return value > param;
    }, 'Enter amount greater than 0.00');
    $('#updateForex').on('click',function(event){
        event.preventDefault();
        $('#ForexEditForm').validate({
            focusInvalid: false,
            debug: true,
            rules: {
//                baseCurrencyEdit:{
//                    required:true
//                },
//                targetCurrencyEdit:{
//                    required:true
//                },
                forexRateEdit:{
                    required:true,
                    max:999999,
                    minStrict:0.00
                }
            },
            messages: {
                forexRateEdit:{
                    min:"Enter amount greater than 0"
                }
            }
        });
        if($('#ForexEditForm').valid()) {
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%'>Are you sure you want to save?</div>",
                confirm: function(button)
                {
                    global.updateDataTable('tblForex');
                    $('#myModalEditForex').modal('hide');
                    $.ajax({
                        url: BASE_URL+ '/admin/maintenance/forex/edit',
                        type: 'post',
                        data: $('#ForexEditForm').serialize(),
                        dataType: 'json',
                        beforeSend : function ()
                        {
//                            $().iseziloading('show');
                        },
                        success: function (){
                            global.updateDataTable('tblForex');
//                            $().iseziloading('hide');
                        }
                    });
                    return true;
                },
                cancel: function(button)
                {
                    return false;
                }
            });
        }

//        var options = {
//            beforeSerialize: function() {
//
//                $.confirm({
//                    text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%'>Are you sure you want to save?</div>",
//                    confirm: function (button) {
//                        global.updateDataTable('tblForex');
//                        $('#myModalEditForex').modal('hide');
//                    },
//                    cancel: function (button) {
//                        return false;
//                    }
//                });
//            }
//
//        };
//        $('#ForexEditForm').ajaxForm(options);
    });

    $('#myModalEditForex').on('click','.btn-fb-cancel', function(){

        var jqueryValidator = jQuery("#ForexEditForm").validate();
        jqueryValidator.resetForm();
    })

    $("#tblForex").on('click', '.btn-edit', function ()
    {
        $('#forexRateEdit-error').html('');
        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "/admin/maintenance/ajax?type=edit-forex&id=" + id,
            method: 'post',
            beforeSend: function ()
            {

            },//
            success: function (msg)
            {
                document.getElementById("baseCurrencyEdit").value=msg.forexA;
                document.getElementById("targetCurrencyEdit").value=msg.forexB;
                document.getElementById("forexRateEdit").value=msg.forex_rate;
                document.getElementById("forexId").value=msg.forex_id;
                $("#myModalEditForex").modal("show");

            }
        });
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
    function forex()
    {
        $('#tblForex').dataTable().fnDestroy();
        $('#tblForex').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=forex-list",
            "lengthMenu": [
                [ 10, 50, -1],
                [ 15, 50, "All"]
            ],
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": false },
                { "aTargets": [ 4 ], "bSortable": false },
                { "aTargets": [ 5 ], "bSortable": false }
            ],
            "order": [0, 'desc'],
//,"sType": "formatted-num"
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
            "language": {
                "paginate": {
                    "previous": "<div class = 'prevBtn'></div>",
                    "next": "<div class = 'nextBtn'></div>"
                }
            }
        });
    }
    function currency()
    {
        $('#tblCurrency').dataTable().fnDestroy();
        $('#tblCurrency').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/biller/ajax?type=currency-list",
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
            "language": {
                "paginate": {
                    "previous": "<div class = 'prevBtn'></div>",
                    "next": "<div class = 'nextBtn'></div>"
                }
            }
        });
    }

    $("#tblCurrency").on('click', '.btn-edit', function ()
    {

        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "/admin/maintenance/ajax?type=edit-currency&id=" + id,
            method: 'post',
            beforeSend: function ()
            {
            },
            success: function (data)
            {
                var iv_src = BASE_URL+"/uploads/logo/"+data.currency_logo;
                document.getElementById("countryNameEdit").value=data.country_name;
                document.getElementById("countryCodeEdit").value=data.country_code;
                document.getElementById("countryCodeEditH").value=data.country_code;
                document.getElementById("countryId").value=data.country_id;
//                document.getElementById("imgContainer").innerHTML="<img id='preview_imageEdit' src="+iv_src+" alt='No attachment found'>";
                $('#preview_imageEdit').removeAttr('style').attr('src',iv_src);
                $("#myModalEditCountry").modal("show");
            }
        });
    });

    function readURLL() {
        $('#preview_imageEdit').attr('src', '').hide();
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            $(reader).load(function(e) {
                $('#preview_imageEdit')
                    .attr('src', e.target.result)
            });
            reader.readAsDataURL(this.files[0]);
        }
    }

    $('#preview_imageEdit')
        .load(function(e) {

            $(this).css('height', '148px').show();
        })
        .hide();

    $("#country_logoEdit").change(readURLL);


    $('#saveEditcountry').on('click', function(e){
        e.preventDefault();
        $( "#EditCountryForm" ).validate({
            onkeyup: function(element){this.element(element);},
            onfocusout: function(element){this.element(element);},
            rules: {
                countryNameEdit: {
                    required: true
                },
                countryCodeEdit: {
                    required: true
                },
                country_logoEdit: {
                    required: true,
                    extension: "png|jpe?g|gif"
                }
            },
            messages:
            {
                image: {
                    extension: "File type is not supported"
                }
            }
        });
        if($('#EditCountryForm').valid()) {
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 25%'>Are you sure you want to save?</div>",
                confirm: function(button)
                {
                    global.updateDataTable('tblCurrency');
                    $('#myModalEditCountry').modal('hide');
                    $.ajax({
                        url: BASE_URL+ '/admin/maintenance/forex/editcountrysave',
                        type: 'post',
                        data: $('#EditCountryForm').serialize(),
                        dataType: 'json',
                        beforeSend : function ()
                        {
                        },
                        success: function (data){
                            if(data.success==false){
                                $('#unique-error').html(data.errors);
                            }else{
                                $('#myModalEditCountry').modal('hide');
                                global.updateDataTable('tblCurrency');
                            }
                        },
                        error: function(){
                        }

                    });
                    return true;
                },
                cancel: function(button)
                {
                    return false;
                }
            });
        }
    });


});