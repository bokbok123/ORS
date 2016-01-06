@extends('user.admin.adminMainContainerLayout')

@section('meta')

{{ Theme::asset()->usePath()->add('js-jquery-elevatezoom', 'js/jquery.elevatezoom.js') }}
{{ Theme::asset()->usePath()->add('js-user-transaction_index', 'js/user/transaction_index.js') }}
@stop
<!---->
<style>
    .dataTables_wrapper .dataTables_paginate {
        float: right;
        text-align: right;
        padding-top: 1.25em;
    }
    #profile-caret {
        margin-top: 0px;
        right: 25px;
    }
    #search-box{
        bottom: -25px;
    }
    .table-admin thead th, .table-admin thead {
        background-color: #0a94bb !important;
        color: #ffffff !important;
    }
</style>
<div class="transactionFilters" style="display: none">
	<table id="tblUserTransactionFilters" align="center">
		<tr>
			<td>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-primary active btn-xs" id="optionAll">
						All
					</label>
					<label class="btn btn-warning btn-xs" id="optionWeek">
						This Week
					</label>
					<label class="btn btn-danger btn-xs" id="optionDue">
						Over Due
					</label>
				</div>
			</td>
			<td id="DateSearch_td_DateFromA">
				<input type="text" class="form-control input-sm" value="" id="dp2" placeholder="Date From" readonly>
			</td>
			<td id="DateSearch_td_DateToA">x
				<input type="text" class="span2 form-control input-sm" id="dp3" placeholder="Date To" readonly>
			</td>
			<td>
				<input type="button" value="Process" class="btn btn-primary btn-sm" id="btnTransactionProcess">
			</td>
		</tr>
	</table>
</div>

@section('nav-tabs')
        <li class="active">
            <a href="#" role="tab" data-toggle="tab" class="tabb"> Bills </a>
        </li>
@stop

@section('tabs')
<h3 style="position: relative; top: -20px; color: black; left: -264px;">TRANSACTION BILLS</h3>
<br/>
<div class="tab-pane active" id="tabBills">
    <table id="tblBills" class="table-admin" style="margin-top: 1%">
        <thead>
            <tr>
                <th class="tblHeaderGlobal">ID</th>
                <th class="tblHeaderGlobal">Due Date</th>
                <th class="tblHeaderGlobal">Member</th>
                <th class="tblHeaderGlobal">Category</th>
                <th class="tblHeaderGlobal">Account Number</th>
                <th class="tblHeaderGlobal">Status</th>
                <th class="tblHeaderGlobal">Week</th>
                <th class="tblHeaderGlobal">Action</th>
            </tr>
        </thead>
    </table>
</div>
@stop

@section('modal')

<div class="modal fade" id="mod" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sizeBig" >
        <div class="modal-content no-aura confirmation modal-content-Big" >
            <div class="modal-header" id="modal-headerpay" style="height: 55px;">
                <span class="msg label-color" id="p-select">Transaction</span>
                <input class="btn-close-addmanual" type="image" style="right: -14px"
                       src="<?php echo Theme::asset()->url('img/cancel-modal.png'); ?>" data-dismiss="modal" data-reload="no" aria-hidden="true">
            </div>
                <div class="row bill_view" id='bill_view'>
                    <div class="col-xs-12 col-sm-7 col-md-7" style="padding-left: 0; padding-right: 0; overflow: hidden; border: 1px solid #dedede">
                        <div class="transZindex" style="position: absolute;  height: 100%; width: 100%; z-index: 9999; display: none;"></div>
                        <div id="adminImgPlace" class="viewer"></div>
                        <div id="actionButtonBar"></div>

                    </div>
                    <div class="col-xs-12 col-sm-5 col-md-5">
                        <div class="payment-details">
                            <div id="td_Biller"></div>
                            <span class="accountNumber" style="padding-top: 85px;">ACCOUNT NO. <span id="td_accountNumber"></span></span>
                            <div id="td_billCategory"></div>
                            <table class="receipt-table-details" style="margin: 0 auto; border: 0">
                                <tr class="due-date">
                                    <td>DUE DATE</td>
                                    <td> - </td>
                                    <td><span id="td_DueDate"></span></td>
                                </tr>
                                <tr class="payment-date">
                                    <td>PAYMENT DATE</td>
                                    <td> - </td>
                                    <td><span id="td_PaymentDate"></span></td>
                                </tr>
                                <tr class="status">
                                    <td>STATUS</td>
                                    <td> - </td>
                                    <td><span id="td_Billstatus"></span></td>
                                </tr>
                            </table>
                            <div id="td_billAmount"></div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
@stop

