<?php
/**
 * Created by PhpStorm.
 * User: christian.labini
 * Date: 8/26/15
 * Time: 9:51 AM
 */
?>

@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('css-user-member', 'css/user/member.css') }}
{{ Theme::asset()->usePath()->add('css-isloading', 'css/isloading.css') }}
{{ Theme::asset()->usePath()->add('js-user-ofw', 'js/user/ofw.js') }}
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

    .table-admin thead th, .table-admin thead {
        background-color: #0a94bb !important;
        color: #ffffff !important;
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
</style>
<form id="FormAddUser" method="post" enctype="multipart/form-data" style="margin: 0px 50px 0px 50px;">
    <div class="modal fade" id="addNewMemberModal" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content modal-content-custom" id="addbillmodal">
                <div class="modal-header modal-header-add">

                    <span class="msg label-color" id="p-select">ADD USER</span>

                    <div class="form-group">
                    </div>
                </div>
                <div class="modal-body" id="divForm">
                    <div class="form-group">
                    </div>

                    <div class="column-user">
                        <div class="column-left">
Title
                        </div>
                        <div class="column-center">
                            {{ Form::select('salutation', array( 'default' => 'Select', 'Mr' => 'Mr.', 'Mrs' => 'Mrs.', 'Ms' => 'Ms.'),'default', array('class' =>'form-control reg-corners salutation', 'style' => 'color: #555 !important ')) }}
                        </div>
                        <div class="column-right title">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
First Name
</div>
                            <div class="column-center">
                                {{ Form::text('fname', Input::old('fname'), array('class'=>'auto-cap form-control required-input2 reg-corners txtboxLetterOnly','maxlength'=>'50','autocomplete'=>'off' )); }}
                        </div>
                        <div class="column-right fname">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
Middle Name
</div>
                        <div class="column-center">
                                {{ Form::text('mname', Input::old('mname'), array('class'=>'auto-cap form-control
                                reg-corners txtboxLetterOnly','maxlength'=>'50','autocomplete'=>'off' )); }}
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
Last Name
</div>
                        <div class="column-center">
                            {{ Form::text('lname', Input::old('lname'), array('class'=>'auto-cap form-control
                            reg-corners required-input2 txtboxLetterOnly','maxlength'=>'50','autocomplete'=>'off' )); }}
                        </div>
                        <div class="column-right lname">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
Username
                        </div>
                        <div class="column-center">
                            {{ Form::text('user_username', Input::old('user_username'), array('id'=>'user_username','placeholder'=>'',
                                'class'=>' zpass form-control reg-corners required-inputz','maxlength'=>'20','autocomplete'=>'off')); }}
                        </div>
                        <div class="column-right username">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
User Role
</div>
                        <div class="column-center">
                            {{ Form::select('user_role', array( '0' => ' ', '1' => 'Admin', '3' => 'BPO'),'', array('class' =>'form-control reg-corners chosen-select user_role', 'style' => 'color: #555 !important ')) }}
                        </div>
                        <div class="column-right role">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
Email
                        </div>
                        <div class="column-center">
                            {{ Form::text('user_email', Input::old('user_email'), array('id'=>'user_email','class'=>'form-control
                            reg-corners required-input2','autocomplete'=>'off')); }}
                        </div>
                        <div class="column-right email">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
Password
                        </div>
                        <div class="column-center">
                            {{ Form::password('newInput', array('id'=>'newPassword','class'=>' zpass form-control reg-corners required-inputz','autocomplete'=>'off' )); }}
                        </div>
                        <div class="column-right newpassword">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
Confirm Password
</div>
                        <div class="column-center">
                            {{ Form::password('password_confirmation', array('id'=>'confirmNewPassword','class'=>' zpass form-control reg-corners required-inputz','autocomplete'=>'off' )); }}
                        </div>
                        <div class="column-right passwordconfirm">
                            *
                        </div>
                    </div>
                    <div class="column-user" id="errorNotif">
                        <center>
                            <span class="error"  style="margin-left: -4px;"></span>
                        </center>
                    </div>

                </div>
                <div id="footeraddbill" class="txtaligncenter" style="padding-left: 100px;">
                    <input
                           class="btn btn-fb-cancel" name="btnSub" data-dismiss="modal"
                           type="button" value="CANCEL">
                    <input id="btnSubmitUser"
                           class="btn btn-fb" name="btnSub"
                           type="button" value="CREATE">
                </div>
            </form>
        </div>
        </div>
        </div>

<!-- SUCCESS MODAL -->
<div class="modal fade" id="MemberAddedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="margin: 200px auto !important;">
        <div class="modal-content modal-no-delete">
            <div class="">
                <div class="modal-title select-title" id="title-bottom">Member Added
</div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="batchListModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:700px; margin-top: 105px; height: auto">
        <div class="modal-content no-aura" id="modal-contentpay">
            <div class="modal-header" id="modal-headerpay" style="border: medium none !important;
    height: auto;
    overflow: auto;
    right: 75px;
    width: 750px;">
                <span class="msg label-color" id="p-select">Registered OFW for Batch ID <span class="batch-id"></span></span>
                <input class="btn-close-addmanual" type="image"
                       src="<?php echo Theme::asset()->url('img/cancel-modal.png'); ?>" data-dismiss="modal" data-reload="no" aria-hidden="true">
                <div style="padding-top: 20px;">
                    <div>
                        <div id="container4">
                            <div id="container3">
                                <div id="container2">
                                    <div id="container1">
                                        <div id="col1">Name
                                            <div class="list" id="name">
                                                </div>
                                        </div>
                                        <div id="col2">Username
                                            <div class="list" style="text-align: left" id="username">
                                            </div>
                                        </div>
                                        <div id="col3">Email
                                            <div class="list" id="email">
                                            </div>
                                        </div>
                                        <div id="col4">Amount
                                            <div class="list" id="amount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-body" id="batchList">
            </div>

                <div style="font-size: 15px; color: #555">
                    <br/>Total list: <span class="total-list"></span>
                </div>
                <div style="font-size: 15px; color: #555">
    Total amount: <span class="total-amount"></span>
                </div>
        </div>
    </div>
</div>
    </div>

@stop

@section('tabs')
<h3 style="position: relative; top: -20px; color: #333333; left: -264px;">OFW</h3>
<br/>
<div class="tab-pane active" id="tabMembers" data-id="1">
    <input type="hidden" id="ofw" value='1'>
    <table id="tblOFW" class="table-admin" style="margin-top: 1%">
        <thead>
        <tr>
            <!--            <th class="tblHeaderGlobal"><input type="checkbox"/> </th>-->
            <th class="tblHeaderGlobal" style="padding-left: 30px !important;">ID</th>
            <!--            <th class="tblHeaderGlobal"></th>-->
            <th class="tblHeaderGlobal">Creator Name</th>
            <th class="tblHeaderGlobal">Creator Email</th>
            <th class="tblHeaderGlobal">Creation Date</th>
            <th class="tblHeaderGlobal">Action</th>
        </tr>
        </thead>
    </table>
</div>
<div class="tab-pane" id="tabReview" data-id="2">
    <table id="tblForReview" class="table-admin">
        <thead>
        <tr>
            <th class="tblHeaderGlobal">ID</th>
            <th class="tblHeaderGlobal"></th>
            <th class="tblHeaderGlobal">First Name</th>
            <th class="tblHeaderGlobal">Last Name</th>
            <th class="tblHeaderGlobal">Email</th>
            <th class="tblHeaderGlobal">User Name</th>
            <th class="tblHeaderGlobal">Status</th>
            <th class="tblHeaderGlobal">Action</th>
        </tr>
        </thead>
    </table>
</div>
<div class="tab-pane" id="tabRejected" data-id="3">
    <table id="tblReject" class="table-admin">
        <thead>
        <tr>
            <th class="tblHeaderGlobal">ID</th>
            <th class="tblHeaderGlobal"></th>
            <th class="tblHeaderGlobal">First Name</th>
            <th class="tblHeaderGlobal">Last Name</th>
            <th class="tblHeaderGlobal">Email</th>
            <th class="tblHeaderGlobal">User Name</th>
            <th class="tblHeaderGlobal">Status</th>
            <th class="tblHeaderGlobal" >Action</th>
        </tr>
        </thead>
    </table>
</div>
</div>
@stop

@section('modal')
<div class="modal-view" id="mod" data-backdrop="static">
    <div class="row bill_view" id='bill_view'>
        <div class="modal-header" id="preload">
            <h3 align='center'>Member's Details</h3>
        </div>
        <div class="modal-body">
            <table align='center' id="billsview">
                <tr>
                    <td colspan='3' id="td_Name" align="center"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Email:</td>
                    <td class="" id="td_Email"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Mobile:</td>
                    <td class="" id="td_Mobile"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Home:</td>
                    <td class="" id="td_Home"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Office:</td>
                    <td class="" id="td_Office"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Address 1:</td>
                    <td class="" id="td_Add1"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Address 2:</td>
                    <td class="" id="td_Add2"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>City:</td>
                    <td class="" id="td_City"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Region:</td>
                    <td class="" id="td_Region"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Postal Code:</td>
                    <td class="" id="td_Postal"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Country:</td>
                    <td class="" id="td_Country"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Date of Birth:</td>
                    <td class="" id="td_DoB"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Status:</td>
                    <td class="" id="td_Status"></td>
                </tr>

            </table>
            <table>
                <tr id="buttonRow">
                    <td id="btn1"></td>
                    <td id="btn2"></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>

<div class="modal fade" id="processModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 9999999;">
    <div class="modal-dialog" style="width:600px; margin-top: 20px">
        <div class="modal-content no-aura confirmation" style="height: 150px;">
            <div class="modal-header" id="modal-headerpay" style="height: 55px;">
                <span class="msg label-color" id="text-w"></span>

            </div>

            <div class="modal-title select-title" id="title-bottom" style="padding: 2% 16%;">
                <button class="confirm btn btn-fb" id="confirm-process" type="button" data-dismiss="modal">Yes</button>
                <button class="btn btn-fb-cancel" type="button" data-dismiss="modal" >Cancel</button></div>
        </div>
    </div>

</div>
@stop
