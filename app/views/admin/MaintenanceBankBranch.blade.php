@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('js-maintenance-branch', 'js/maintenance/branch.js') }}
{{ Theme::asset()->usePath()->add('css-maintenance-branch', 'css/maintenance/branch.css') }}
{{ Theme::asset()->usePath()->add('css-maintenance-billcategory', 'css/user/filtering.css') }}
{{ Theme::asset()->usePath()->add('js-ajaxForm', 'js/jquery.form.js') }}
@stop

@section('modal')
<style>
    .dataTables_wrapper .dataTables_paginate {
        float: right;
        text-align: right;
        padding-top: 1.25em;
    }
    #search-box{
        top: 102px;
    }
    .dropdownDiv {
        margin-top: -2%;
        padding-left: 0;
        padding-bottom: 7px;
    }
    .btnaddmember-u{
        top: 22%;
    }
</style>
<div id="errorDiv">

    @if ($Status =='Save')
    <div class="row alert alert-success">
        <label class="control-label" for="inputSuccess1">{{$Tab}} has been Sucessfully saved</label>
    </div>
    @endif
    @if ($Status =='Error')
    <div class="row alert alert-danger">
        <label class="control-label" for="inputSuccess1"></label>
    </div>
    @endif
</div>
<div class="modal fade" id="myModalAddBankBranch" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Bank Branch</h4>
            </div>
            <div id="errorDivmodalbankbranch" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('url'=>'/admin/maintenance/bank-branch', 'files'=>true,'id'=>'BankBranchEntryForm')) }}
            Branch Name : {{ Form::text('branch_name', Input::old('branch_name'), array('id' => 'branch_name', 'style' => '','placeholder'=>'Branch Name', 'class'=>'form-control reg-corners alpha bankaccountclass branch','maxlength'=>'100' )); }}
            <input type="hidden" value="0" id="notxistingbranchname"/>
            <span class="errorbankbranchname"></span>
            Branch Address : {{ Form::text('branch_address', Input::old('branch_address'), array('id' => 'branch_address', 'style' => '','placeholder'=>'Branch Address', 'class'=>'form-control reg-corners bankaccountclass','maxlength'=>'100' )); }}
            <span class="errorbranchaddress"></span>
            Contact No. : {{ Form::text('branch_contactno', Input::old('branch_contactno'), array('id' => 'branch_contactno', 'style' => '','placeholder'=>'Contact Number', 'class'=>'form-control reg-corners bankaccountclass','maxlength'=>'30' )); }}
            <span class="errorcontactnum"></span>
            Bank :{{ Form::select('branchbankname', $banklist, $Status =='Save' ? '':Input::get('branchbankname'),array('class' => 'form-control reg-corners drop','id'=>'branchbankname')) }}
            <span class="errorbank"></span>
            <input type="hidden" id="bankbranch_name_reference" value=""/>
            <br>
            <div class="modal-footer">
                <div class="row marLef">
                    {{ Form::submit('SAVE',array('class'=>'btn btn-fb btn-large','id'=>'savebankBranch'))}}
                    <input id="btncanceladdbankBranch" type="button" class="btn btn-fb-cancel btncancel" data-dismiss="modal" value="CANCEL"/>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalEditBankBranch" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Bank Branch</h4>
            </div>
            <div id="errorDivmodalbankbranch" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('url'=>'/admin/maintenance/bank-branch', 'files'=>true,'id'=>'BankBranchEntryForms')) }}
            <input type='hidden' class='form-control input-sm branch_id' placeholder="id" id="branchs_id" name="branch_id" value="0">
            Branch Name : {{ Form::text('branch_name', Input::old('branch_name'), array('id' => 'branchs_name', 'style' => '','placeholder'=>'Branch Name', 'class'=>'form-control reg-corners alpha bankaccountclass branch','maxlength'=>'100' )); }}
            <input type="hidden" value="0" id="notxistingbranchnameedit"/>
            <span class="errorbankbranchname"></span>
            Branch Address: {{ Form::text('branch_address', Input::old('branch_address'), array('id' => 'branchs_address', 'style' => '','placeholder'=>'Branch Address', 'class'=>'form-control reg-corners bankaccountclass','maxlength'=>'100' )); }}
            <span class="errorbranchaddress"></span>
            Contact No: {{ Form::text('branch_contactno', Input::old('branch_contactno'), array('id' => 'branchs_contact', 'style' => '','placeholder'=>'Contact Number', 'class'=>'form-control reg-corners bankaccountclass','maxlength'=>'30' )); }}
            <span class="errorcontactnum"></span>
            Bank :{{ Form::select('branchbankname', $branchbankname, Input::get('branchbankname'),array('class' => 'form-control reg-corners drop','id'=>'banks_name')) }}
            <span class="errorbank"></span>
            <input type="hidden" id="bankbranch_name_reference" value=""/>
            <br/>
            <div class="modal-footer">
                {{ Form::submit('SAVE',array('class'=>'btn btn-fb btn-large','id'=>'saveEditBankBranch'))}}
                <input id="btncanceladdbankBranch" type="button" class="btn btn-fb-cancel btncancel" data-dismiss="modal" value="CANCEL"/>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('nav-tabs')
<li class="active">
    <a href="#tabbankbran"  data-toggle="tab" class="tabb">Bank Branches</a>
</li>
@stop

@section('tabs')
<h3 style="position: relative; top: -15px; color: rgb(1, 82, 66); padding-left: 0;">BANK BRANCH</h3><br/>
<div class="btn-group dropdownDiv">
    <button id="filterActive" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        All
    </button>
    <ul class="dropdown-menu">
        <li><a data-id="2" class="filter_c" href="#" data-value="All">All</a></li>
        <li><a data-id="1" class="filter_c" href="#" data-value="Active">Active</a></li>
        <li><a data-id="0" class="filter_c" href="#" data-value="Deactivate">Inactive</a></li>
    </ul>

</div>
<div class="btnaddmember-u"><img id="btnAddBankBranch" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" style="float: left !important; padding-right: 10px; cursor: pointer;"/><span>ADD BANK BRANCH</span></div>
<div class="tab-pane active" id="tabbankbran" data-id="4">
    <div class="btn-add-maintain">

    </div>
    <table id="tblbankbran" class="table-admin">
        <thead>
        <tr>
            <th class="tblHeaderGlobal">Branch Name</th>
            <th class="tblHeaderGlobal">Address</th>
            <th class="tblHeaderGlobal">Contact No.</th>
            <th class="tblHeaderGlobal">Bank Name</th>
            <th class="tblHeaderGlobal">Bank Logo</th>
            <th class="tblHeaderGlobal">Action</th>
        </tr>
        </thead>
    </table>
</div>
@stop




