@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('js-maintenance-biller', 'js/maintenance/biller.js') }}
{{ Theme::asset()->usePath()->add('css-maintenance-biller', 'css/maintenance/biller.css') }}
{{ Theme::asset()->usePath()->add('css-maintenance-billcategory', 'css/user/filtering.css') }}
{{ Theme::asset()->usePath()->add('js-ajaxForm', 'js/jquery.form.js') }}
@stop

@section('nav-tabs')
<li class="active">
    <a href="#tabBiller" data-toggle="tab" class="tabb">Biller</a>
</li>
@stop

@section('tabs')
<style>
    #myModalAddBiller .form-control {
        /*width: 150% !important;*/
    }
    #search-box{
        top: 103px;
    }
    .dropdownDiv {
        margin-top: -2%;
        padding-bottom: 7px;
    }
    .btnaddmember-u {
        bottom: -12px;
        float: right;
        left: 5px;
        position: relative;
    }
    ul.dropdown-menu{
        left: 5px;
        min-width: 170px;
        top: 76%;
    }
    .table-admin thead th, .table-admin thead {
        background-color: #0a94bb !important;
        color: #ffffff !important;
    }
</style>
<h3 style="position: relative; top: -15px; color: black; padding-left: 4px;">BILLER</h3><br/>

<div class="btn-group dropdownDiv">
    <button id="filterActive" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        All
    </button>
    <ul class="dropdown-menu" style="width: 92%">
        <li><a data-id="2" class="filter_c" href="#" data-value="All">All</a></li>
        <li><a data-id="1" class="filter_c" href="#" data-value="Active">Active</a></li>
        <li><a data-id="0" class="filter_c" href="#" data-value="Deactivate">Inactive</a></li>
    </ul>

</div>
<div class="btnaddmember-u">
   <img style="color: white;
    cursor: pointer;
    float: left !important;
    height: 27px;
    opacity: 0.02;
    padding-right: 10px;
    position: relative;
    width: 100%;
    z-index: 99999;" id="btnAddbiller" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" style="float: left !important; padding-right: 10px; cursor: pointer; color: white"/> <button style=" border: medium none;
    height: 34px;
    position: relative;
    background-color: #0a94bb !important;
    color: #ffffff !important;
    top: -27px;
    width: 94%;">ADD BILLER</button>
</div>
<div class="tab-pane active" id="tabBiller">
    <div class="btn-add-maintain">

    </div>
    <table id="tblbiller" class="table-admin">
        <thead>
        <tr>
            <th class="tblHeaderGlobal">ID</th>
            <th class="tblHeaderGlobal">Biller Name</th>
            <th class="tblHeaderGlobal">Biller Category</th>
<!--            <th class="tblHeaderGlobal">Biller Logo</th>-->
            <th class="tblHeaderGlobal">Action</th>
        </tr>
        </thead>
    </table>
</div>
@stop

@section('modal')
<div class="modal fade" id="myModalAddBiller" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header" style="border: none;">
                <h4 class="modal-title" id="myModalLabel">Add Biller</h4>
            </div>
            <div id="x"></div>
            <div style="bottom: 11px; position: relative;">
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'BillerEntryForm','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/biller/save')) }}
            <br>
            <input type='hidden' class='form-control input-sm' placeholder="id" id="biller_id" name="biller_id" value="0">
            <div class="row">
                <div class="col-md-12">
                    <div class="fileinput fileinput-new" data-provides="fileinput" s>
                        <div class="fileinput-preview thumbnail filepreview" data-trigger="fileinput" id="imgContainer">
                            <img src="#" id="preview_image">
                        </div>
                        <div>

                            <div class="warning"></div>

									<span class="btn btn-default1 btn-file">
										<input type="file" name="biller_logo" id="biller_logo" size="60" accept=".png, .jpg, .jpeg">
                                        <img class="btnChange"
                                             src="<?php echo Theme::asset()->url('img/changeprofpic.png'); ?>"/>
                                            <span class="textProfChange">Select biller logo</span>
                                        <input type="hidden" value="0" name="biller_logo_value" id="biller_logo_value" >
									</span>
                            <span class="errorimage"></span>



                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="add-biller-group col-md-12">{{ Form::select('category', $billerCategory, $Status =='Save' ? '':Input::get('category'),array('class' => 'form-control reg-corners drop ','id'=>'category_id')) }}</div>
            </div>
                <span class="errorbillercategoy"></span>

            <div class="row">
                <div class="add-biller-group col-md-12">
                    {{ Form::text('billerName', $Status =='Save' ? '':Input::get('billerName'),['class' => 'form-control input-sm alpha biller','placeholder' => 'Biller Name','id'=>'billerName','maxlength'=>'50']) }}
                    <span class="errorbillername"></span>
                </div>
                <div class="clear"></div>
            </div>

            <input type="hidden" value="0" id="notxistingbillername"/>
            <br>
            <div class="modal-footer">
                <div class="row marLef">
                    {{ Form::submit('SAVE',array( 'class' => 'btn confirm','id'=>'savebiller')) }}
                    <input id="btncanceladdbiller" name="btncanceladdbiller" type="button" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<!----------------------------------------------------------------------------------------------------------->
<div id="errorDiv">

    @if ($Status =='Save')
    <div class="row alert alert-success">
        <label class="control-label" for="inputSuccess1">{{$Tab}} has been Sucessfully saved</label>
    </div>
    @endif
    @if ($Status =='Error')
    <div class="row alert alert-danger">
        <label class="control-label" for="inputSuccess1">1</label>
    </div>
    @endif
</div>
<!--edit-->
<div class="modal fade" id="myModalEditBiller" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Biller</h4>
            </div>
            <div id="errorDivmodalbiller" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'BillerEntryForms','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/biller/save')) }}
<!--            <br>-->
            <br>
            <input type='hidden' class='form-control input-sm' placeholder="id" id="billers_id" name="biller_id" value="0">
            <div class="row">
                <div class="col-md-12" >
                    <div class="fileinput fileinput-new" data-pro  ides="fileinput">
                        <input type="hidden" id="imagesbilleredit" value="0" name="imagesbilleredit">
                        <div class="fileinput-preview thumbnail filepreview" data-trigger="fileinput" id="imgContainers">
                            <img src="#" id="preview_images">
                        </div>
                        <div>

                            <div class="warning"></div>

									<span class="btn btn-default1 btn-file">
										<input type="file" name="biller_logo" id="edit_biller_logo" size="60" accept=".png, .jpg, .jpeg">
                                         <img class="btnChange"
                                              src="<?php echo Theme::asset()->url('img/changeprofpic.png'); ?>"/>
                                            <span class="textProfChange">Select biller logo</span>
                                        <input type="hidden" value="0" name="biller_logo_value" id="biller_logo_value" >
                                        <input type="hidden" value="0" name="biller_logo_value" id="edit_biller_logo_value" >
									</span>
                            <span class="errorimage"></span>




                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">{{ Form::select('categoryedit', $billerCategory, $Status =='Save' ? '':Input::get('category'),array('class' => 'form-control reg-corners drop','id'=>'categorys_id')) }}</div>

            </div>
            <span class="errorbillercategoy"></span>

            <div class="row">
                <div class="col-md-8">{{ Form::text('billerName', $Status =='Save' ? '':Input::get('billerName'),['class' => 'form-control input-sm alpha biller','placeholder' => 'Biller Name','id'=>'billerNames','maxlength'=>'50']) }}</div>
            </div>
            <span class="errorbillername"></span>
            <input type="hidden" value="0" id="notxistingbillernames"/>



            <div class="modal-footer" style="border:none;">
                <div class="row">
                    {{ Form::submit('Save',array( 'class' => 'btn btn-fb btn-large','id'=>'saveeditbiller')) }}
                    <input id="btncanceleditbiller" name="" type="button" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
@stop


<style>
    #btncanceleditbiller{
        background: #af2835 none repeat scroll 0 0 !important;
        border-color: #73020d !important;
        border-radius: 2px !important;
        border-style: none none solid !important;
        border-width: 0 0 4px !important;
        color: white;
        font-weight: lighter;
        height: 32px;
        position: relative;
        right: -29px;
        width: 153px;
    }
    #saveeditbiller{
        position: relative;
        right: 75px;
        background: #0a94bb none repeat scroll 0 0 !important;
        border-color: #006e96 !important;
        border-radius: 2px !important;
        border-style: none none solid !important;
        border-width: 0 0 4px !important;
        color: #fff !important;
        font-family: "Roboto-Regular",sans-serif !important;
        font-size: 12px !important;
        font-weight: bold !important;
        width: 153px;
    }
</style>