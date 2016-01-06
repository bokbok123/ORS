$(document).ready(function () {


    /*added by ajei*/
    $("select[name='biller'] option:eq(0)").attr("disabled", "disabled");
    $("select[name='editbiller'] option:eq(0)").attr("disabled", "disabled");

    $('#SearchMyBills').keyup(function(){
        $('#tblOffers').dataTable().fnFilter($(this).val());
    });

    $('#link').unbind();
    $('#editlink').unbind();


    $('#cancelOffer').on('click', function(){
        $('#myModaladdoffer label.error ').css('display','none');
        $('#myModaladdoffer input').removeClass('error');
    });

    var BASE_URL = $('#hdnBaseUrl').val();

    $('.filter_c').on('click', function(e){
        $('#filterActive').html($(this).text());
        var id = $(this).data('id');
        $('#tblOffers').dataTable().fnDestroy();
        $('#tblOffers').dataTable({
            "aaSorting": [[ 5, "desc" ]],
            "bAutoWidth": false,
            "sDom": '<"top"f>rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/transaction/ajax?type=offer-list&status="+id,
            "lengthMenu": [
                [ 5, 50, -1],
                [ 15, 50, "All"]
            ],
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": true },
                { "aTargets": [ 4 ], "bSortable": true },
                { "aTargets": [ 5 ], "bSortable": true },
                { "aTargets": [ 6 ], "bSortable": true },
                { "aTargets": [ 7 ], "bSortable": false}
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

    // DISPLAY TABLE OFFERS
    $('#tblOffers').dataTable({
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": false },
            { "aTargets": [ 3 ], "bSortable": false },
            { "aTargets": [ 4 ], "bSortable": false },
            { "aTargets": [ 5 ], "bSortable": false },
            { "aTargets": [ 6 ], "bSortable": false },
            { "aTargets": [ 7 ], "bSortable": false}
        ],
        "lengthMenu": [
            [ 5, 50, -1],
            [ 15, 50, "All"]
        ],
        "sDom": '<"top">rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/transaction/ajax?type=offer-list",
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

    // DEACTIVATE OFFERS
    $('#tblOffers').on('click', '.btn-deactivate', function (e) {
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button) {
                $.ajax({
                    url: BASE_URL + "/admin/transaction/ajax?type=offer-deactivate&id="+id,
                    beforeSend : function (){
                    },
                    success: function(msg) {
                        global.updateDataTable('tblOffers');
                    }
                });
            },
            cancel: function(button) {
            }
        });
    });


    $(".btn-addoffers").on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var view = $(this).data('view');

        $(this).colorbox({inline:true, width:"700px"});
    });
    // ACTIVATE OFFERS
    $('#tblOffers').on('click', '.btn-activate', function (e) {

        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "/admin/transaction/ajax?type=offer-activate&id="+id,
            beforeSend : function (){
            },
            success: function(msg) {
                if(msg == "false")
                {$('#myModalinformation').modal('show');}
                else
                {$.confirm({
                    text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
                    confirm: function(button) {
                        $.ajax({
                            url: BASE_URL + "/admin/transaction/ajax?type=offer-activate&id="+id,
                            beforeSend : function (){
                            },
                            success: function(msg) {
                                global.updateDataTable('tblOffers');
                            }
                        });
                    },
                    cancel: function(button) {
                    }
                });}
            }
        });

    });

    // EDIT OFFERS
    $('#tblOffers').on('click', '.btn-edit', function (e) {
        var id = $(this).data('id');
                $.ajax({
                    url: BASE_URL + "/admin/transaction/ajax?type=edit-offers&id="+id,
                    beforeSend : function (){
                    },
                    success: function(msg) {
                        document.getElementById("editdescription").value=msg.desc;
                        document.getElementById("editoffer_instruction").value=msg.offer_instruction;
                        document.getElementById("editpoints").value=msg.points;
                        document.getElementById("editbiller").value  = msg.biller;
                        document.getElementById("offerId").value  =id;
                        document.getElementById("editlink").value  =msg.link;
                        document.getElementById("editdateexpired").value  =msg.dateexpired;
                        $("#myModalEditoffer").modal("show");

                    }
        });
    });


    //SAVE OFFER

    $("#saveEditOffer").click(function(e){
        $(function() {
            $('#submit-editoffers').validate({
                onkeyup: function(element){this.element(element);},
                onfocusout: function(element){this.element(element);},
                framework: 'bootstrap',
                excluded: [':disabled'],
                focusInvalid: false,
                debug: true,
                rules: {
                    biller:{
                        required: true
                    },
                    editdescription:{
                        required:true,
                        minlength: 5

                    },
                    dateexpired:{
                        required:true
                    },
                    points:{
                        required:true,
                        min:1
                    },
                    link:{
                        required:true,
                        url: true
                    },
                    offer_instruction:{
                        required:true,
                        minlength: 5

                    }
                },

                messages:{
                    biller:'This field is required.',
//                    description:'This field is required.',
                    dateexpired:'This field is required.',
                    points:{
                        min:"Minimun point should be 1.00"
                    },
                    link:'This field is required.'
//                    offer_instruction:'This field is required.'
                }
            });
            if($('#submit-editoffers').valid()) {
                e.preventDefault();
                $.confirm({
                    text: "<div style='font-size: 13px; font-weight: bold;'>Are you sure you want to proceed?</div>",
                    confirm: function (button) {
                        submitEditOffers();
                    },
                    cancel: function (button) {
                        return false;
                    }
                });
            }
        });

        var billerrId = $('#bill_billerId').val();
        var biller = $("#bill_billerId option[value='"+billerrId+"']").text();
        $("[name='biller_name']").val(biller);

    });


    //SAVE OFFER

    $("#saveOffer").click(function(e){
        $(function() {
            $('#submit-offers').validate({
                onkeyup: function(element){this.element(element);},
                onfocusout: function(element){this.element(element);},
                framework: 'bootstrap',
                excluded: [':disabled'],
                focusInvalid: false,
                debug: true,
                rules: {
                    biller:{
                        required: true
                    },
                    description:{
                        required:true,
                        minlength: 5
                    },
                    dateexpired:{
                        required:true
                    },
                    points:{
                        required:true,
                        min:1
                    },
                    link:{
                        required:true,
                        url: true
                    },
                    offer_instruction:{
                        required:true,
                        minlength: 5

                    }
                },

                messages:{
                    biller:'This field is required.',
//                    description:'This field is required.',
                    dateexpired:'This field is required.',
                    points:{
                        min:"Minimun point should be 1.00"
                    },
                    link: {
                        url: "This is not a valid URL"
                    }
//                    offer_instruction:'This field is required.'
                }
            });
            if($('#submit-offers').valid()) {
                e.preventDefault();
                $.confirm({
                    text: "<div style='font-size: 13px; font-weight: bold;'>Are you sure you want to proceed?</div>",
                    confirm: function (button) {
                        submitOffers();
                    },
                    cancel: function (button) {
                        return false;
                    }
                });
            }
        });

        var billerrId = $('#bill_billerId').val();
        var biller = $("#bill_billerId option[value='"+billerrId+"']").text();
        $("[name='biller_name']").val(biller);

    });

    $(".txtboxNumberOnly").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $("#open").on("click",function(){
       $("#myModaladdoffer").modal("show");
        document.getElementById('submit-offers').reset();
    });
    $('#editdateexpired').datepicker({
        format: "yyyy-mm-dd",
        startDate: '+0d',
        min:0
    }).on('changeDate', function(ev) {
        $('#editdateexpired').valid();
    });

    $('#editdateexpired').datepicker().on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });
    $('#cancelOffer').on('click', function (e){
        e.preventDefault();
//        document.getElementById('biller').style.color='#555';
        document.getElementById('submit-offers').reset();

        var jqueryValidator = jQuery("#submit-offers").validate();
        jqueryValidator.resetForm();
    })
    $('#cancelEditOffer').on('click', function (e){
        e.preventDefault();
        var jqueryValidator = jQuery("#submit-editoffers").validate();
        jqueryValidator.resetForm();
    })

        function submitOffers(){
        var id = document.getElementById("offerId").value;
        var desc = document.getElementById("description").value;
        var offer_instruction = document.getElementById("offer_instruction").value;
        var points= document.getElementById("points").value;
        var e = document.getElementById("biller");
        var link = document.getElementById("link").value;
        var dateexpired = document.getElementById("dateexpired").value;
        var biller = e.options[e.selectedIndex].value;

        $.ajax({
            url: BASE_URL + "/admin/transaction/ajax?type=saveOffer&id="+id+"&desc="+desc+"&offer_instruction="+offer_instruction+"&points="+points+"&biller="+biller+"&link="+link+"&dateexpired="+dateexpired,

            beforeSend : function (){
            },
            success: function(msg) {
                global.updateDataTable('tblOffers');
                $('#biller').val("");
                $('#description').val("");
                $('#offer_instruction').val("");
                $('#points').val("");
                $('#link').val("");
                $('#dateexpired').val("");
                $("#myModaladdoffer").modal("hide");
            }
        });
    }
    function submitEditOffers(){
        var id = document.getElementById("offerId").value;
        var desc = document.getElementById("editdescription").value;
        var offer_instruction = document.getElementById("editoffer_instruction").value;
        var points= document.getElementById("editpoints").value;
        var e = document.getElementById("editbiller");
        var link = document.getElementById("editlink").value;
        var dateexpired = document.getElementById("editdateexpired").value;
        var biller = e.options[e.selectedIndex].value;

        $.ajax({
            url: BASE_URL + "/admin/transaction/ajax?type=saveOffer&id="+id+"&desc="+desc+"&offer_instruction="+offer_instruction+"&points="+points+"&biller="+biller+"&link="+link+"&dateexpired="+dateexpired,

            beforeSend : function (){
            },
            success: function(msg) {
                global.updateDataTable('tblOffers');
                $('#biller').val("");
                $('#description').val("");
                $('#offer_instruction').val("");
                $('#points').val("");
                $('#link').val("");
                $('#dateexpired').val("");
                $("#myModalEditoffer").modal("hide");
            }
        });
    }

    $("#dateexpired").on("change",function(){
        $("#dateexpired-error").css("display", "none");
    });

    $("#link").on("keyup",function(){
        $("#link-error").css("display", "none");
    });
    $("#link").on("keypress",function(){
        $("#link-error").css("display", "none");
    });
});