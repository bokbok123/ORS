<?php
/**
 * Created by PhpStorm.
 * User: christian.labini
 * Date: 10/23/15
 * Time: 10:21 AM
 */
?>


@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('css-user-member', 'css/user/member.css') }}
{{ Theme::asset()->usePath()->add('css-isloading', 'css/isloading.css') }}
{{ Theme::asset()->usePath()->add('js-user-ofw', 'js/user/feedbacks.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.isloading', 'js/jquery.isloading.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.isloading.min', 'js/jquery.isloading.min.js') }}
@stop

@section('nav-tabs')

<style>
    .select-title {
        padding-top: 15px;
        padding-bottom: 50px;
        color: #293135;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        padding-left: 10px;
    }
    #container4 {
        clear: left;
        float: left;
        width: 100%;
        overflow: hidden;
        padding-bottom: 20px;
        font-size: 10.5px !important;
    }
    #container3 {
        clear: left;
        float: left;
        width: 100%;
        position: relative;
        right: 25%;
    }
    #container2 {
        clear: left;
        float: left;
        width: 100%;
        position: relative;
        right: 25%;
    }
    #container1 {
        float: left;
        width: 100%;
        position: relative;
        right: 25%;
    }
    #col1 {
        float: left;
        width: 21%;
        position: relative;
        left: 77%;
        overflow: hidden;
        color: #555;
        font-weight: bold;
    }
    #col2 {
        float: left;
        width: 21%;
        position: relative;
        left: 81%;
        overflow: hidden;
        color: #555;
        font-weight: bold;
    }
    #col3 {
        float: left;
        width: 21%;
        position: relative;
        left: 85%;
        overflow: hidden;
        color: #555;
        font-weight: bold;
    }
    #col4 {
        float: left;
        width: 21%;
        position: relative;
        left: 89%;
        overflow: hidden;
        color: #555;
        font-weight: bold;
    }

    #col2 .list,
    #col3 .list,
    #col4 .list {
        font-weight: normal;
        overflow: hidden;
        padding-top: 13px;
        text-align: center;
        text-overflow: ellipsis;
    }
    #col1 .list{
        text-align: left;
        font-weight: normal;
        padding-top: 13px;
        padding-left: 40px;
    }
    .total-list, .total-amount {
        color: green;
    }
    .dataTables_wrapper .dataTables_paginate {
        float: right;
        text-align: right;
        padding-top: 1.25em;
    }
    #search-box{
        bottom: -25px;
    }
    .tab-content{
        top: 35px;;
    }
    .offerOverflow {
        white-space: nowrap;
        width: 12em;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .feedBOverflow{
        overflow: auto;
        max-height: 185px;
        white-space: normal;
        /*border: 1px solid rgb(177, 177, 177);*/
        padding-left: 10px;
        padding-right: 10px;
        max-width: 300px;
        width: 230px;
        /*height: auto;*/
    }
    .table-admin thead th, .table-admin thead {
           background-color: #0a94bb !important;
           color: #ffffff !important;
       }
    #f_email{ padding-left: 10px; }
</style>

@section('tabs')
<h3 style="position: relative; top: -20px; color: black; left: -264px;">Feedbacks</h3>
<br/>
<input type="hidden" id="hdnBaseUrl" value="{{ URL::to('/') }}" />
<div class="tab-pane active" id="tabFeedback" data-id="1">
    <table id="tblFeedbacks" class="table-admin" style="margin-top: 1%">
        <thead>
        <tr>
            <th class="tblHeaderGlobal" style="padding-left: 30px !important; width: 13%;">ID</th>
            <th class="tblHeaderGlobal" style="width: 33%;">Creator Email</th>
            <th class="tblHeaderGlobal">Message</th>
            <th class="tblHeaderGlobal" style="padding-left: 40px; width: 100px;">Action</th>
        </tr>
        </thead>
    </table>
</div>


<div class="modal fade" id="viewFeedBack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 9999999;">
    <div class="modal-dialog" style="width:470px; margin-top: -5px">
        <div class="confirmation modal-content no-aura" style="height: auto;">
            <div class="modal-header" id="modal-headerpay" style="height: 55px;">
                <span class="msg label-color" id="p-select">Feedback ID <span id="f_id"></span></span>
                <input class="btn-close-addmanual" type="image" style="right: 0px;"
                       src="<?php echo Theme::asset()->url('img/cancel-modal.png'); ?>" data-dismiss="modal" data-reload="no" aria-hidden="true">
            </div>
            <div class="row bill_view" id='bill_view'>
                <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0">
                    <div class="">
                        <div id=""></div>
                        <table align="center" class="receipt-table-details" style="white-space: nowrap; border: 0; font-size: 14px;">
                            <tr>
                                <td>Creator Email</td>
                                <td> - </td>
                                <td><span id="f_email"></span></td>
                            </tr>
                            <tr>
                                <td>Message</td>
                                <td> - </td>
                                <td><div class="feedBOverflow" id="t_message"></div></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop
