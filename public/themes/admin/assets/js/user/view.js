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
 * This method show the data for members view module.
 *
 * @param.
 *
 * @return void
 */



$(document).ready(function()
{
    $("#tblUserTransactionsLog").delegate("a","click", function(e){
        e.preventDefault();
    });

    var search = $('#module').val();

    var BASE_URL = $('#hdnBaseUrl').val();
    var ID = $('#userID').val();
    $("select[name='salutation'] option:eq(0)").attr("disabled", "disabled");
    $('#tblUserTransactionsLog').dataTable({
        "destroy": true,
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "language": {
            //Hide Previous and Next in DataTable
            "paginate": {
                "previous": "<div class = 'prevBtn'></div>",
                "next": "<div class = 'nextBtn'></div>"
            }
        },
        "aoColumnDefs": [
            { "aTargets": [ 3 ], "bSortable": false },
            { "aTargets": [ 5 ], "bSortable": false }
        ],
        "lengthMenu": [[ 10, 50, -1], [ 15, 50, "All"]],
        "order": [0, 'desc'],
        /**
         * Fills datatable with missing rows
         *
         * Set default Table size when Table is empty
         */
        "fnDrawCallback" : function(oSettings)
        {

            var total_count = oSettings.fnRecordsTotal();
            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
            var show_num = oSettings._iDisplayLength;
            var tr_count = $(this).children('tbody').children('tr').length;
            var missing = show_num - tr_count;

            //Set default Table size when Table is empty
            if (show_num < total_count && missing > 0) {
                for(var i = 0; i < missing; i++){
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else if (show_num > total_count) {
                for(var i = 0; i < (show_num - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            } else if (total_count == 0) {
                for(var i = 0; i < (14 - tr_count); i++) {
                    $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                }
            }

        },

        "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersTransactionsLog-list&id=" + ID + "&search=" + search
    });

    $('#tabView a').click(function (e)
    {
        e.preventDefault()
        $(this).tab('show')
    });

    /*added by ajei*/
    jQuery('html').bind('dragover drop', function(event){
        event.preventDefault();
        return false;
    });

    $('#module').on("change", function () {
        var search = $('#module').val();

        $('#tblUserTransactionsLog').dataTable({
            "destroy": true,
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "language": {
                //Hide Previous and Next in DataTable
                "paginate": {
                    "previous": "<div class = 'prevBtn'></div>",
                    "next": "<div class = 'nextBtn'></div>"
                }
            },
            "aoColumnDefs": [
                { "aTargets": [ 3 ], "bSortable": false },
                { "aTargets": [ 5 ], "bSortable": false }
            ],
            "lengthMenu": [[ 10, 50, -1], [ 15, 50, "All"]],
            "order": [0, 'desc'],
            /**
             * Fills datatable with missing rows
             *
             * Set default Table size when Table is empty
             */
            "fnDrawCallback" : function(oSettings)
            {

                var total_count = oSettings.fnRecordsTotal();
                var columns_in_row = $(this).children('thead').children('tr').children('th').length;
                var show_num = oSettings._iDisplayLength;
                var tr_count = $(this).children('tbody').children('tr').length;
                var missing = show_num - tr_count;

                //Set default Table size when Table is empty
                if (show_num < total_count && missing > 0) {
                    for(var i = 0; i < missing; i++){
                        $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                    }
                } else if (show_num > total_count) {
                    for(var i = 0; i < (show_num - tr_count); i++) {
                        $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                    }
                } else if (total_count == 0) {
                    for(var i = 0; i < (14 - tr_count); i++) {
                        $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                    }
                }

            },
            "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersTransactionsLog-list&id=" + ID + "&search=" + search
        });

    });
    //This method show the data tables for USer Accounts
    $('#tblUserAccounts').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "language": {
            //Hide Previous and Next in DataTable
			  "paginate": {
			       "previous": "<div class = 'prevBtn'></div>",
			       "next": "<div class = 'nextBtn'></div>"
			   }
	    },
	    "lengthMenu": [[ 12, 50, -1], [ 15, 50, "All"]],

	    /**
	     * Fills datatable with missing rows
         *
         * Set default Table size when Table is empty
	     */
        "order": [0, 'desc'],
	    "fnDrawCallback" : function(oSettings)
        {
	        var total_count = oSettings.fnRecordsTotal();

	            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
	            var show_num = oSettings._iDisplayLength;
	            var tr_count = $(this).children('tbody').children('tr').length;
	            var missing = show_num - tr_count;

                //Set default Table size when Table is empty
	            if (show_num < total_count && missing > 0) {
	              for(var i = 0; i < missing; i++){
	                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
	              }
	            } else  if (show_num > total_count) {
	              for(var i = 0; i < (show_num - tr_count); i++) {
	                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
	              }
	            } else if (total_count == 0) {
		            for(var i = 0; i < (14 - tr_count); i++) {
		                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            }
		        }
	          
	     },
        "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersAccount-list&id=" + ID,
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": false },
            { "aTargets": [ 4 ], "bSortable": false },
            { "aTargets": [ 5 ], "bSortable": false },
            { "aTargets": [ 6 ], "bSortable": false },
            { "aTargets": [ 7 ], "bSortable": false }
        ]
    });

    //This method show the data tables for User Portfolio
    $('#tblUserPortfolio').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersPorfolio-list&id=" + ID,
        "language": {
            //Hide Previous and Next in DataTable
			  "paginate": {
			       "previous": "<div class = 'prevBtn'></div>",
			       "next": "<div class = 'nextBtn'></div>"
			   }
	    },
	    "lengthMenu": [[ 14, 50, -1], [ 15, 50, "All"]],

	    /**
	     * Fills datatable with missing rows
         *
         * Set default Table size when Table is empty
	     */

	    "fnDrawCallback" : function(oSettings)
        {
	        var total_count = oSettings.fnRecordsTotal();
	            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
	            var show_num = oSettings._iDisplayLength;
	            var tr_count = $(this).children('tbody').children('tr').length;
	            var missing = show_num - tr_count;

                //Set default Table size when Table is empty
	            if (show_num < total_count && missing > 0) {
	              for(var i = 0; i < missing; i++){
	                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
	              }
	            } else  if (show_num > total_count) {
	              for(var i = 0; i < (show_num - tr_count); i++) {
	                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
	              }
	            } else if (total_count == 0) {
		            for(var i = 0; i < (14 - tr_count); i++) {
		                $(this).append('<tr class="space"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            }
		        }
	          
	     },
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": true },
            { "aTargets": [ 4 ], "bSortable": false }
        ]
    
    });

    //This method show the data tables for User Devices
    $('#tblUserDevices').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersDevices-list&id=" + ID,
        "language": {
            //Hide Previous and Next in DataTable
			  "paginate": {
			       "previous": "<div class = 'prevBtn'></div>",
			       "next": "<div class = 'nextBtn'></div>"
			   }
	    },
        "lengthMenu": [[ 12, 50, -1], [ 15, 50, "All"]],

	    /**
	     * Fills datatable with missing rows
         *
         * Set default Table size when Table is empty
	     */
        "order": [0, 'desc'],
        "fnDrawCallback" : function(oSettings)
        {
            var total_count = oSettings.fnRecordsTotal();
            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
            var show_num = oSettings._iDisplayLength;
            var tr_count = $(this).children('tbody').children('tr').length;
            var missing = show_num - tr_count;

            //Set default Table size when Table is empty
            if (show_num < total_count && missing > 0) {
                for(var i = 0; i < missing; i++){
                    if (i % 2 == 0) {
                        $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                    } else {
                        $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                    }
                }
            } else if (show_num > total_count) {
                    for(var i = 0; i < (show_num - total_count); i++) {
                        if (i % 2 == 0) {
                            $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                        } else {
                            $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                        }
                    }
            } else if (total_count == 0) {
                    for(var i = 0; i < (14 - tr_count); i++) {
                        if (i % 2 == 0) {
                            $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                        } else {
                            $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                        }
                    }
                }
        },
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": false },
            { "aTargets": [ 2 ], "bSortable": false },
            { "aTargets": [ 3 ], "bSortable": false }
        ]
    });

    //This method show the data tables for User Bills
    $('#tblUserBills').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersBills-list&id=" + ID,
        "language": {
            //Hide Previous and Next in DataTable
			  "paginate": {
			       "previous": "<div class = 'prevBtn'></div>",
			       "next": "<div class = 'nextBtn'></div>"
			   }
	    },
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": false },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": false },
            { "aTargets": [ 4 ], "bSortable": true },
            { "aTargets": [ 5 ], "bSortable": true },
//            { "aTargets": [ 6 ],  "visible": false, "bSortable": true },
            { "aTargets": [ 6 ], "bSortable": false }

        ],
        "lengthMenu": [[ 10, 50, -1], [ 15, 50, "All"]],
//        "order": [0, 'desc'],
        "fnRowCallback": function ( row, data, index ) {

        },

        /**
	     * Fills datatable with missing rows
         *
         * Set default Table size when Table is empty
	     */
        "fnDrawCallback" : function(oSettings)
        {
	        var total_count = oSettings.fnRecordsTotal();
	            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
	            var show_num = oSettings._iDisplayLength;
	            var tr_count = $(this).children('tbody').children('tr').length;
	            var missing = show_num - tr_count;

                //Set default Table size when Table is empty
	            if (show_num < total_count && missing > 0) {
	              for(var i = 0; i < missing; i++){
	            	  if (i % 2 == 0) {
	            		  $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
	            	  } else {
	            		  $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
	            	  } 
	              }
	            } else if (show_num > total_count) {
                      for(var i = 0; i < (show_num - total_count); i++) {
                          if (i % 2 == 0) {
                              $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          } else {
                              $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          }
                      }
	            } else if (total_count == 0) {
		            for(var i = 0; i < (14 - tr_count); i++) {
		            	if (i % 2 == 0) {
		            		  $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            	  } else {
		            		  $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            	  } 
		            }
		        }
	     }
    });

    //This method show the data tables for User TransactionLog


    $('#tblUserAccessLog').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersAccessLog-list&id=" + ID
    });

    //Account Deactivate
    $('#tblUserAccounts').on('click', '.btn-deactivate', function(e)
    {
        var id = $(this).data('id');
        var ID = $(this).data('type');
        //Confirmation Box
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button)
            {
                $.ajax({
                    //Deactivate Acounts
                    url: BASE_URL + "/admin/users/ajax?type=account-deactivate&userId="+ID+"&id="+id,
                    beforeSend : function ()
                    {
						$().iseziloading('show');
                    },//
                    success: function(msg)
                    {
						$().iseziloading('hide');
                        global.updateDataTable('tblUserAccounts');
                        document.getElementById("badgeAccount").innerHTML=msg.newValue;
                    }
                });
            },
            cancel: function(button)
            {

            }
        });
    });

    //Device Deactivate
    $('#tblUserDevices').on('click', '.btn-deactivate', function(e)
    {
        var id = $(this).data('id');
        //Confirmation Box
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button)
            {
                $.ajax({
                    //Deactivate Device
                    url: BASE_URL + "/admin/users/ajax?type=device-deactivate&userId="+ID+"&id="+id,
                    beforeSend : function ()
                    {
                        $().iseziloading('show');
                    },
                    success: function(msg)
                    {
                        $().iseziloading('hide');
                        global.updateDataTable('tblUserDevices');
                        document.getElementById("badgeDevice").innerHTML=msg.newValue;
                        if (data.success) {
                            $.ajax({
                                type: 'post',
                                url: 'sendEmail',
                                data: {
                                    emailData: data.Emaildata
                                },
                                beforeSend:function()
                                {
                                    window.location = location.pathname;
                                },
                                success:function(data)
                                {

                                }
                            });
                        }
                    }
                });
            },
            cancel: function(button)
            {

            }
        });
    });

    //Device Activate
    $('#tblUserDevices').on('click', '.btn-activate', function(e)
    {
        var id = $(this).data('id');
        //Confirmation Box
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function(button)
            {
                $.ajax({
                    //Activate Device
                    url: BASE_URL + "/admin/users/ajax?type=device-activate&userId="+ID+"&id="+id,
                    beforeSend : function ()
                    {
						$().iseziloading('show');
                    },
                    success: function(msg)
                    {
						$().iseziloading('hide');
                        global.updateDataTable('tblUserDevices');
                        document.getElementById("badgeDevice").innerHTML=msg.newValue;
                    }
                });
            },
            cancel: function(button)
            {

            }
        });
    });

    //Deactivate Portfolio
    $('#tblUserPortfolio').on('click', '.btn-deactivate', function(e)
    {
        var id = $(this).data('id');
        //Confirmation Box
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button)
            {
                $.ajax({
                    ////Deactivate Portfolio
                    url: BASE_URL + "/admin/users/ajax?type=userPortfolio-deactivate&userId="+ID+"&id="+id,
                    beforeSend : function ()
                    {
                        $().iseziloading('show');
                    },
                    success: function(msg)
                    {
                        $().iseziloading('hide');
                        global.updateDataTable('tblUserPortfolio');
                        document.getElementById("badgePortfolio").innerHTML=msg.newValue;
                    }
                    });
                },
            cancel: function(button)
            {

            }
        });
    });

    //Manual Trigger Deactivation
    $(".manualTrigger").on('click', function()
    {
        var id = $(this).data('id');
        alert("da");
        //Confirmation Box
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button)
            {

            },
            cancel: function(button)
            {

            }
        });
    });

    //For Company Bank Account
    $("#tblUserPortfolio").on('click', '.btn-view', function(e)
    {
        e.preventDefault();
        var id = $(this).data('id');
        var view = $(this).data('view');

        if (view) {
            global.updateDataTable('tblBankAccount');
        } else {
            $(this).data('view', 1);
            $('#tblBankAccount').dataTable({
                "sDom": 'rt<"bottom"ip><"clear">',
                "bServerSide": true,
                "paging": true,
                "searching": true,
                "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersCompanyAccount-list&id=" + id
            });
        }
        $(this).colorbox({inline:true, width:"700px"});
    });

    //For Acces Log List
    $("#btnProcess").on('click',  function(e)
    {
        var dtFrom = document.getElementById("dp2").value;
        var dtTo = document.getElementById("dp3").value;
        if (dtFrom.length+dtTo.length>15) {
            $('#tblUserAccessLog').dataTable().fnDestroy();
            $('#tblUserAccessLog').dataTable({
                "sDom": 'rt<"bottom"ip><"clear">',
                "bServerSide": true,
                "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersAccessLog-list&id=" + ID,
                "fnServerParams": function(aoData)
                {
                    aoData.push({
                        "name": "dtFrom",
                        "value": dtFrom
                    })
                    aoData.push({
                        "name": "dtTo",
                        "value": dtTo
                    })
                }
            });
        }
    });

    //Date Format
        $('#dp1').datepicker({
            //format: 'mm-dd-yyyy'
            format: 'yyyy-mm-dd'
        });

        $('#dp2').datepicker({
            //format: 'mm-dd-yyyy'
            format: 'yyyy-mm-dd'
        });

        $('#dp3').datepicker({
            //format: 'mm-dd-yyyy'
            format: 'yyyy-mm-dd'
        });

        $('#dp4').datepicker({
            //format: 'mm-dd-yyyy'
            format: 'yyyy-mm-dd'
        });

        $('#dp5').datepicker({
            //format: 'mm-dd-yyyy'
            format: 'yyyy-mm-dd'
        });


    document.getElementById("dp4").value = '';
    document.getElementById("dp5").value = '';
    $('#dp1').on('keypress', function(event){

        var regex = new RegExp("^[]*$");
        validation(event, regex);

    });
    //Hide Datepicker $('#dp1')
    $('#dp1').on('change', function ()
    {
        $('.datepicker').hide();
    });
    //Hide Datepicker $('#dp2')
    $('#dp2').on('change', function ()
    {
        $('.datepicker').hide();
    });
    //Hide Datepicker $('#dp3')
    $('#dp3').on('change', function ()
    {
        $('.datepicker').hide();
    });
    //Hide Datepicker $('#dp4')
    $('#dp4').on('change', function ()
    {
        $('.datepicker').hide();
    });
    //Hide Datepicker $('#dp5')
    $('#dp5').on('change', function ()
    {
        $('.datepicker').hide();
    });

    //Transaction Process of Date From and Date To
    $("#btnTransactionProcess").on('click',  function(e)
    {
        var dtFrom = document.getElementById("dp4").value;
        var dtTo = document.getElementById("dp5").value;
        var module = document.getElementById("module").value;

        if (dtFrom.length+dtTo.length>15) {
            $('#tblUserTransactionsLog').dataTable().fnDestroy();
            $('#tblUserTransactionsLog').dataTable({
                "sDom": 'rt<"bottom"ip><"clear">',
                "bServerSide": true,
                "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersTransactionsLog-list&id=" + ID,
                "order": [0, 'desc'],
                "aoColumnDefs": [
                    { "aTargets": [ 3 ], "bSortable": false },
                    { "aTargets": [ 5 ], "bSortable": false }
                ],
                "fnServerParams": function(aoData)
                {
                    aoData.push({
                        "name": "dtFrom",
                        "value": dtFrom
                    })
                    aoData.push({
                        "name": "dtTo",
                        "value": dtTo
                    })
                    aoData.push({
                        "name": "module",
                        "value": module
                    })
                }
            });
        }
    });

    //Transaction Process of Bills Date From and Date To
    $("#btnTransactionProcess1").on('click',  function(e)
    {
        var dtFrom = document.getElementById("dp2").value;
        var dtTo = document.getElementById("dp3").value;

        if (dtFrom.length+dtTo.length>15) {
            $('#tblUserBills').dataTable().fnDestroy();
            $('#tblUserBills').dataTable({
                "sDom": 'rt<"bottom"ip><"clear">',
                "bServerSide": true,
                "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersBillsDate-list&id=" + ID,
                "fnServerParams": function(aoData)
                {
                    aoData.push({
                        "name": "dtFrom",
                        "value": dtFrom
                    })
                    aoData.push({
                        "name": "dtTo",
                        "value": dtTo
                    })
                }
            });
        }
    });

    //User List of Bills Table
    $("#optionDue").on('click',  function(e)
    {
        var id = $(this).data('id');
        $('#tblUserBills').dataTable().fnDestroy();
        $('#tblUserBills').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersBills-list&id=" + id,
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": false },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": false },
                { "aTargets": [ 4 ], "bSortable": true },
                { "aTargets": [ 5 ], "bSortable": true },
//                { "aTargets": [ 6 ],  "visible": false, "bSortable": true },
                { "aTargets": [ 6 ], "bSortable": false }

            ],
            "lengthMenu": [[ 10, 50, -1], [ 15, 50, "All"]],
            /**
             * Fills datatable with missing rows
             *
             * Set default Table size when Table is empty
             */
            "fnDrawCallback" : function(oSettings)
            {
                var total_count = oSettings.fnRecordsTotal();
                var columns_in_row = $(this).children('thead').children('tr').children('th').length;
                var show_num = oSettings._iDisplayLength;
                var tr_count = $(this).children('tbody').children('tr').length;
                var missing = show_num - tr_count;

                //Set default Table size when Table is empty
                if (show_num < total_count && missing > 0) {
                    for(var i = 0; i < missing; i++){
                          if (i % 2 == 0) {
                              $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          } else {
                              $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          }
                    }
                } else if (show_num > total_count) {
                     for(var i = 0; i < (show_num - tr_count); i++) {
                          if (i % 2 == 0) {
                              $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          } else {
                              $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          }
                     }
                } else if (total_count == 0) {
                     for(var i = 0; i < (14 - tr_count); i++) {
                          if (i % 2 == 0) {
                              $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          } else {
                              $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          }
                     }
                }
             },
            "fnRowCallback": function ( row, data, index )
            {

            },
            "fnServerParams": function(aoData)
            {
                aoData.push({
                    "name": "module",
                    "value": "Over"
                })
            },
            "language": {
              //Hide Previous and Next in DataTable
              "paginate": {
                   "previous": "<div class = 'prevBtn'></div>",
                   "next": "<div class = 'nextBtn'></div>"
               }
           }
        });
 
    });

    //User List of All Bills Table
    $("#optionAll").on('click',  function(e)
    {
        var id = $(this).data('id');
        $('#tblUserBills').dataTable().fnDestroy();
        $('#tblUserBills').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersBills-list&id=" + id,
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": false },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": false },
                { "aTargets": [ 4 ], "bSortable": true },
                { "aTargets": [ 5 ], "bSortable": true },
//                { "aTargets": [ 6 ], "visible": false,  "bSortable": true },
                { "aTargets": [ 6 ],  "bSortable": false }

            ],
            "lengthMenu": [[ 10, 50, -1], [ 15, 50, "All"]],

            /**
    	     * Fills datatable with missing rows
             *
             * Set default Table size when Table is empty
    	     */
            "fnDrawCallback" : function(oSettings)
            {
                var total_count = oSettings.fnRecordsTotal();
                var columns_in_row = $(this).children('thead').children('tr').children('th').length;
                var show_num = oSettings._iDisplayLength;
                var tr_count = $(this).children('tbody').children('tr').length;
                var missing = show_num - tr_count;

                //Set default Table size when Table is empty
                if (show_num < total_count && missing > 0) {
                    for(var i = 0; i < missing; i++) {
                        if (i % 2 == 0) {
                              $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          } else {
                              $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          }
                    }
                } else if (show_num > total_count) {
                    for(var i = 0; i < (show_num - tr_count); i++) {
                        if (i % 2 == 0) {
                              $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          } else {
                              $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          }
                    }
                } else if (total_count == 0) {
                    for(var i = 0; i < (14 - tr_count); i++) {
                        if (i % 2 == 0) {
                              $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          } else {
                              $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>');
                          }
                    }
                }
    	     },
            "fnRowCallback": function ( row, data, index )
            {

            },
            "fnServerParams": function(aoData)
            {
                aoData.push({
                    "name": "module",
                    "value": "All"
                })
            },
            "language": {
                //Hide Previous and Next in DataTable
    			  "paginate": {
    			       "previous": "<div class = 'prevBtn'></div>",
    			       "next": "<div class = 'nextBtn'></div>"
    			   }
             }
        });
    });

    //User Bill List in a Week
    $("#optionWeek").on('click',  function(e)
    {
        var id = $(this).data('id');
        $('#tblUserBills').dataTable().fnDestroy();
        $('#tblUserBills').dataTable({
            "sDom": 'rt<"bottom"ip><"clear">',
            "bServerSide": true,
            "sAjaxSource": BASE_URL + "/admin/users/ajax?type=usersBills-list&id=" + id,
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "bSortable": false },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": false },
                { "aTargets": [ 4 ], "bSortable": true },
                { "aTargets": [ 5 ], "bSortable": true },
//                { "aTargets": [ 6 ],  "visible": false, "bSortable": true },
                { "aTargets": [ 6 ], "bSortable": false }
            ],
            "lengthMenu": [[ 10, 50, -1], [ 15, 50, "All"]],

            /**
             * Fills datatable with missing rows
             *
             * Set default Table size when Table is empty
             */
            "fnDrawCallback" : function(oSettings)
            {
	        	var total_count = oSettings.fnRecordsTotal();
	            var columns_in_row = $(this).children('thead').children('tr').children('th').length;
	            var show_num = oSettings._iDisplayLength;
	            var tr_count = $(this).children('tbody').children('tr').length;
	            var missing = show_num - tr_count;

                //Set default Table size when Table is empty
	            if (show_num < total_count && missing > 0) {
	            	for(var i = 0; i < missing; i++) {
	            		if (i % 2 == 0) {
		            		  $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            	  } else {
		            		  $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            	  } 
	            	}
	            } else if (show_num > total_count) {
	            	for(var i = 0; i < (show_num - tr_count); i++) {
	            		if (i % 2 == 0) {
		            		  $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            	  } else {
		            		  $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            	  } 
	            	}
	            } else if (total_count == 0) {
		            for(var i = 0; i < (14 - tr_count); i++) {
		            	if (i % 2 == 0) {
		            		  $(this).append('<tr id = "emptyEven"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            	  } else {
		            		  $(this).append('<tr id="emptyOdd"><td colspan="' + columns_in_row + '">&nbsp;</td></tr>'); 
		            	  } 
		            }
		        }
	        },
            "fnRowCallback": function ( row, data, index )
            {
            },
            "fnServerParams": function(aoData)
            {
                aoData.push({
                    "name": "module",
                    "value": "Week"
                })
            },
            "language": {
                //Hide Previous and Next in DataTable
                "paginate": {
                    "previous": "<div class = 'prevBtn'></div>",
                    "next": "<div class = 'nextBtn'></div>"
                }
            }
        });
    });

    //Validate for Letters Only
    $(".txtboxLetterOnly").keypress(function(event) {
        if (event.charCode!=0) {
            var regex = new RegExp("^[ A-Za-z,.]*$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });
    //Validate for Numbers Only
    $(".numOnly").keydown(function (event) {

        if (event.charCode!=0) {
            var regex = new RegExp("^[0-9a-z]*$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
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
    //Validate Paste
    $('input').bind('paste',function(e) {
        e.preventDefault();
        return false;
    });
    //Validate Copy
    $('input').bind('copy',function(e) {
        e.preventDefault();
        return false;
    });

    //Validate Keypress By Fernan Caranay
    $('#user_salutation').keypress(function()
    {
        $("#user_salutation").css("border", "1px solid #cbcbcb");
        document.getElementById('validateSalutation').style.visibility="hidden";
    });
    $('#user_fname').keypress(function()
    {
        $("#user_fname").css("border", "1px solid #cbcbcb");
        document.getElementById('validateFname').style.visibility="hidden";
    });
    $('#user_lname').keypress(function()
    {
        $("#user_lname").css("border", "1px solid #cbcbcb");
        document.getElementById('validateLname').style.visibility="hidden";
    });
    $('#user_mname').keypress(function()
    {
        $("#user_mname").css("border", "1px solid #cbcbcb");
        document.getElementById('validateMname').style.visibility="hidden";
    });
    $('#user_streetnumber').keypress(function()
    {
        $("#user_streetnumber").css("border", "1px solid #cbcbcb");
        document.getElementById('validateStreetNo').style.visibility="hidden";
    });
    $('#user_streetname').keypress(function()
    {
        $("#user_streetname").css("border", "1px solid #cbcbcb");
        document.getElementById('validateStreetName').style.visibility="hidden";
    });
    $('#user_city').keypress(function()
    {
        $("#user_city").css("border", "1px solid #cbcbcb");
    });
    $('#user_country').keypress(function()
    {
        $("#user_country").css("border", "1px solid #cbcbcb");
    });
    $('#user_email').keypress(function()
    {
        $("#user_email").css("border", "1px solid #cbcbcb");
    });
    $('#user_homephone').keypress(function()
    {
        $("#user_homephone").css("border", "1px solid #cbcbcb");
        document.getElementById('validateHomePhone').style.visibility="hidden";
    });
    $('#user_workphone').keypress(function()
    {
        $("#user_workphone").css("border", "1px solid #cbcbcb");
        document.getElementById('validateWorkPhone').style.visibility="hidden";
    });
    $('#user_mobile').keypress(function()
    {
        $("#user_mobile").css("border", "1px solid #cbcbcb");
        document.getElementById('validateMobilePhone').style.visibility="hidden";
    });
    $('#dp1').click(function()
    {
        $("#dp1").css("border", "1px solid #cbcbcb");
    }); //End of Keypress Validation

    //Save Button By Fernan Caranay
    $("#btnSaveMemberUpdate").on('click',  function(e)
    {
        e.preventDefault();
        var user_salutation=document.getElementById('user_salutation').value;
        var user_fname=document.getElementById('user_fname').value;
        var user_lname=document.getElementById('user_lname').value;
        var user_mname=document.getElementById('user_mname').value;
        var user_streetnumber=document.getElementById('user_streetnumber').value;
        var user_streetname=document.getElementById('user_streetname').value;
        var user_city=document.getElementById('user_city').value;
        var user_country=document.getElementById('user_country').value;
        var user_email=document.getElementById('user_email').value;
        var dp1=document.getElementById('dp1').value;
        var user_homephone=document.getElementById('user_homephone').value;
        var user_workphone=document.getElementById('user_workphone').value;
        var user_mobile=document.getElementById('user_mobile').value;

        $('#submitMemberForm').validate({
            focusInvalid: false,
            debug: true,
            rules: {
                user_salutation: {
                    required: true,
                    minlength: 2,
                    maxlength: 3
                },
                user_fname:{
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                user_lname:{
                    required: true,
                    minlength: 1,
                    maxlength: 50
                },
                user_mname:{
                    required: true,
                    minlength: 1,
                    maxlength: 50
                },
                user_streetnumber:{
                    required: true,
                    minlength: 5,
                    maxlength: 100
                },
                user_streetname:{
                    required: true,
                    minlength: 5,
                    maxlength: 100
                },
                user_city:{
                    required: true
                },
                user_country:{
                    required: true
                },
                user_email:{
                    required: true
                },
                user_birthdate:{
                    required: true
                },
                user_homephone:{
                    required: true,
                    minlength: 7,
                    maxlength: 30
                },
                user_workphone:{
                    required: true,
                    minlength: 7,
                    maxlength: 30
                },
                user_mobile:{
                    required: true,
                    minlength: 7,
                    maxlength: 30
                }

            },

            messages:{
                user_salutation:{
                    minlength:'Minimum of 2 characters.',
                    maxlength:'Maximum of 3 characters.'
                },
                user_fname:{
                    minlength:'Minimum of 2 characters.',
                    maxlength:'Maximum of 50 characters.'
                },
                user_lname:{
                    minlength:'Minimum of 1 characters.',
                    maxlength:'Maximum of 50 characters.'
                },
                user_mname:{
                    minlength:'Minimum of 1 characters.',
                    maxlength:'Maximum of 50 characters.'
                },
                user_streetnumber:{
                    minlength:'Minimum of 5 characters.',
                    maxlength:'Maximum of 100 characters.'
                },
                user_streetname:{
                    minlength:'Minimum of 5 characters.',
                    maxlength:'Maximum of 100 characters.'
                },
                user_homephone:{
                    minlength:'Minimum of 7 characters.',
                    maxlength:'Maximum of 30 characters.'
                },
                user_workphone:{
                    minlength:'Minimum of 7 characters.',
                    maxlength:'Maximum of 30 characters.'
                },
                user_mobile:{
                    minlength:'Minimum of 7 characters.',
                    maxlength:'Maximum of 30 characters.'
                },
                user_city: 'This field is required.',
                user_country: 'This field is required.',
                user_email: 'This field is required.',
                user_birthdate: 'This field is required.'

            }
        });
        if($('#submitMemberForm').valid()) {
            $.confirm({
                text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",
                confirm: function(button)
                {
                    $("form")[0].submit();
                    return true;
                },
                cancel: function(button)
                {
                    return false;
                }
            });
        }

    }); //End of Save Button


    //Close Button
    $("#btn_close").on('click',  function(e)
    {
        e.preventDefault();
        $.fn.colorbox.close();
    });

    //tabs__link for date format
    $(".tabs__link").on('click',  function(e)
    {
        document.getElementById("dp4").value="";
        document.getElementById("dp5").value="";
        document.getElementById("dp3").value="";
        document.getElementById("dp2").value="";
    });

    //Table User Bills
    $("#tblUserBills").on('click', '.btn-view', function(e)
    {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: BASE_URL + "/admin/transaction/ajax?type=bill-view&id="+id,
            //$("body").isLoading({ text: "Loading" });
            success: function(msg)
            {
                document.getElementById("td_billCategory").innerHTML=msg.billCategory;
                document.getElementById("td_Biller").innerHTML=msg.Biller;
//                document.getElementById("td_TransactionNumber").innerHTML=msg.TransactionNumber;
                document.getElementById("td_accountNumber").innerHTML=msg.accountNumber;
                document.getElementById("td_billAmount").innerHTML=msg.billAmount;
//                document.getElementsByClassName("toolAmount").innerHTML=msg.billAmount;
                $('.toolAmount').attr('title',msg.billAmount);
                document.getElementById("td_DueDate").innerHTML=msg.billDueDate;
                document.getElementById("td_PaymentDate").innerHTML=msg.billPaymentDate;
                document.getElementById("td_Billstatus").innerHTML=msg.billStatus;
                var img = BASE_URL+"/uploads/bills/"+msg.imageUrl;
                document.getElementById("imgPlace").innerHTML="<img id='imgPlace2' src="+img+" alt='No attachment found'>";
                //$("body").isLoading( "hide" );
                $( "#imgPlace2" ).on('error', function()
                {
                   	$(this).attr('src', BASE_URL + "/uploads/bills/nologo.png");
                   	$(this).attr('class', 'noAttachment');
                   	$(".noAttachment").css("cssText", "height: 302px;" +
//                   								   "margin-bottom: -370px;" +
//                   								   "margin-left: 15px !important;" +
                   								   "padding: 0 !important;" +
                   								   "width: 302px;");
                });
            }
        });
        $('#billsViewModal').modal('show');
    });

    $('.nav-tabs').button()

    //Table Bank Account that been deactivated
    $('#tblUserAccounts').on('click', '.btn-deactivate', function(e)
    {
        var id = $(this).data('id');
        //Confirmation Box
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button)
            {
                $.ajax({
                    url: BASE_URL + "/admin/users/ajax?type=account-deactivate&userId="+ID+"&id="+id,
                    success: function(msg)
                    {
                        global.updateDataTable('tblUserAccounts');
                        document.getElementById("badgeAccount").innerHTML=msg.newValue;
                    }
                });
            },
            cancel: function(button)
            {

            }
        });
    });

    //Account Activated
    $('#tblUserAccounts').on('click', '.btn-activate', function(e)
    {
        var id = $(this).data('id');
        var ID = $(this).data('type');
        //Confirmation Box
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button)
            {
                $.ajax({
                    //Activate Acounts
                    url: BASE_URL + "/admin/users/ajax?type=account-activate&userId="+ID+"&id="+id,
                    beforeSend : function ()
                    {
                        $().iseziloading('show');
                    },//
                    success: function(msg)
                    {
                        $().iseziloading('hide');
                        global.updateDataTable('tblUserAccounts');
                        document.getElementById("badgeAccount").innerHTML=msg.newValue;
                    }
                });
            },
            cancel: function(button)
            {

            }
        });
    });

    //Button that will Activate User
    $('.btn-activateUser').on('click', function(e)
    {
        var id = $(this).data('id');
        //Confirmation Box
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function(button)
            {
                $.ajax({
                    url: BASE_URL + "/admin/users/ajax?type=user-Activate&id="+id,
                    beforeSend: function(){
                      $().iseziloading('show');
                    },
                    success: function(msg)
                    {
                        window.location = BASE_URL+"/admin/users/view/"+id;
                        global.updateDataTable('tblActiveUsers');
                        document.getElementById("userCnt").innerHTML=msg.newValue;
                        $().iseziloading('hide');
                    }
                });
            },
            cancel: function(button)
            {

            }
        });
    });

    //Button that will Deactivate User
    $('.btn-deactivateUser').on('click', function(e)
    {
    	e.preventDefault();
        var id = $(this).data('id');
        //Confirmation Box
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Deactivation</div>",
            confirm: function(button)
            {
                $.ajax({
                    url: BASE_URL + "/admin/users/ajax?type=user-deactivate&id="+id,
                    beforeSend : function ()
                    {
						$().iseziloading('show');
                    },
                    success: function(msg)
                    {
						$().iseziloading('hide');
                        window.location = BASE_URL+"/admin/users/view/"+id;
                        global.updateDataTable('tblActiveUsers');
                        document.getElementById("userCnt").innerHTML=msg.newValue;
                    }
                });
            },
            cancel: function(button)
            {

            }
        });
    });
      
    // Zab
    $('#status a').on('click', function(event)
    {
    		event.stopPropagation();
    		event.preventDefault();
    });
    
    $('#bill_view_btn_close').on('click', function()
    {
    	CloseModal();
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('#user_salutationDrop').on('change', function (){
        $('#user_salutation').val($(this).val());
    });

});

function CloseModal()
{
    $.fn.colorbox.close();
}