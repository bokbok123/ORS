@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('js-user-payment', 'js/user/payment.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.colorbox-min2', 'js/jquery.colorbox-min.js') }}
@stop
<style>
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
@section('nav-tabs')
<li class="active">
    <a href="#tabBiller" data-toggle="tab" class="tabb">Payments</a>
</li>
@stop

@section('tabs')
<h3 style="position: relative; top: -20px; color: black; left: -264px;"> TRANSACTION PAYMENTS HISTORY </h3>
<br/>
    <div class="tab-pane active" id="tabPayment">
        <table id="tblPayment" class="table-admin" style="margin-top: 1%">
            <thead>
            <tr>
                <th class="tblHeaderGlobal" style="width: 250px;">ID</th>
                <th class="tblHeaderGlobal" style="width: 500px; !important">Member</th>
<!--                <th class="tblHeaderGlobal">Biller</th>-->
<!--                <th class="tblHeaderGlobal">Transaction Number</th>-->
                <th class="tblHeaderGlobal" style="width: 300px;">Amount</th>
                <th class="tblHeaderGlobal">Action</th>
            </tr>
            </thead>
        </table>
    </div>
@stop

@section('modal')<div class="modal fade" id="mod" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sizeBig" >
        <div class="modal-content no-aura confirmation modal-content-Big">
            <div class="modal-header" id="modal-headerpay" style="height: 55px;">
                <span class="msg label-color" id="p-select">Transaction</span>
                <input class="btn-close-addmanual" type="image" style="right: -14px"
                       src="<?php echo Theme::asset()->url('img/cancel-modal.png'); ?>" data-dismiss="modal" data-reload="no" aria-hidden="true">
            </div>
            <div class="row bill_view" id='bill_view'>
                <div class="col-xs-12 col-sm-7 col-md-7" style="padding-left: 0; padding-right: 0; overflow: hidden; border: 1px solid #dedede">
                    <div class="transZindex" style="position: absolute;  height: 100%; width: 100%; z-index: 9999; display: none"></div>
                    <div id="adminImgPlace" class="viewer"></div>
                    <div id="actionButtonBar"></div>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5">
                    <div class="payment-details" style="margin-top: 1px;">
                        <div id="td_Biller"></div>
                        <div class="accountNumber">ACCOUNT NO. <span id="td_accountNumber"></span></div>
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
                        <div id="td_billAmount" style="margin-top: 18px;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop


