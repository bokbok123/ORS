@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('js-maintenance-bank', 'js/maintenance/bank.js') }}
{{ Theme::asset()->usePath()->add('css-maintenance-bank', 'css/maintenance/bank.css') }}
{{ Theme::asset()->usePath()->add('css-maintenance-billcategory', 'css/user/filtering.css') }}
{{ Theme::asset()->usePath()->add('js-ajaxForm', 'js/jquery.form.js') }}
@stop

@section('modal')
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
<div class="modal fade" id="myModalAddBank" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12" style="height: 450px;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Bank</h4>
            </div>
            <div id="errorDivmodalbank" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('url'=>'/admin/maintenance/bank', 'files'=>true,'id'=>'myForm', 'style' => 'margin: 0px auto; width: 88%;')) }}
            <div class="AddBankContainer">
                <input type='hidden' class='form-control input-sm' placeholder="id" id="bank_id" name="bank_id" value="0">
                Bank Name : {{ Form::text('bank_name', Input::old('bank_name'), array('id' => 'bank_name', 'style' =>
                '','placeholder'=>'Bank Name', 'class'=>'form-control reg-corners alpha bankaccountclass bank','maxlength'=>'100' )); }}
            </div>
            <span class="errorbankname"></span>
            <span class="NoBankName">Please enter Bank Name</span>
            <span class="BankNameAE">Bank Name already exist</span>
            <input type="hidden" value="0" id="notxistingbank"/>
            <br>

            <div class="fileinput fileinput-new" data-provides="fileinput">
                <p>Image</p>

                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                     style="width:113px;height: 32px;line-height: 286px;">
                    <img src="#" id="preview_image">
                     </div>
                <div>
                    <div class="warning"></div>
                                    <span class="btn btn-default1 btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <input type="file" name="image" id="image" size="60" accept="image/*">
                                    </span>

                </div>
            </div>
            <br>

            <div class="modal-footer clearfix" style="top: auto;">
                <div class="row">
                    {{ Form::submit('Save',array('class'=>'btn btn-fb btn-large','id'=>'savebank'))}}
                    <input id="btncanceladdbank" type="button" class="btn btn-fb-cancel btncancel" data-dismiss="modal"
                           value="Cancel"/>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalEditBank" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12" id="modaleditbank">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Bank</h4>
            </div>
            <div id="errorDivmodalbank" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('url'=>'/admin/maintenance/bank/edit', 'files'=>true,'id'=>'BankEntryForms', 'style' => 'margin: 0px auto; width: 88%;')) }}
            <input type='hidden' class='form-control input-sm' placeholder="id" id="banks_id" name="bank_id" value="0">
            <div class="custom-label-container" style="padding-top: 5px"><label>Bank Name : </label>{{ Form::text('bank_name', Input::old('bank_name'), array('id' => 'bank_names', 'style' =>
                '','placeholder'=>'Bank Name', 'class'=>'form-control reg-corners alpha bankaccountclass bank','maxlength'=>'100' )); }}</div>
            <span class="errorbankname"></span>
            <span class="NoBankName">Please enter Bank Name</span>
            <span class="BankNameAE">Bank Name already exist</span>
            <input type="hidden" id="bank_name_reference" value=""/>
            <input type="hidden" value="0" id="notxistingbankedit"/>

            <br>

            <div class="fileinput fileinput-new" data-provides="fileinput">
                <p>Image</p>
                <input type="hidden" id="imagesbankedit" value="0" name="imagesbankedit">

                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" id="imgContainers"
                         style="width:113px;height: 32px;line-height: 286px;">
                        <img src="#" id="preview_images">
                    </div>
                    <div>

                    <div class="warning" style="display: none"></div>
                                    <span class="btn btn-default1 btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <input type="file" name="images" id="images" accept="image/*">
                                        <input class="btn-blue-3d" type="hidden" hidden="true" name="imagebiller" id="imagesbiller" value="0">

                                    </span>
                   </div>
            </div>
            <br>

            <div class="modal-footer" id="modaleditbankfooter">
                {{ Form::submit('Save',array('class'=>'btn btn-fb btn-large','id'=>'saveEditBank'))}}
                <input id="btncanceleditbank" type="button" class="btn btn-fb-cancel btncancel" data-dismiss="modal"
                       value="Cancel"/>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('nav-tabs')
<li class="active">
    <a href="#tabBank" data-toggle="tab" class="tabb">Bank</a>
</li>
@stop


@section('tabs')
<h3 style="position: relative; top: -15px; color: rgb(1, 82, 66); padding-left: 4px;">BANK</h3><br/>
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
<div class="btnaddmember-u"><img id="btnAddBank" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" style="float: left !important; padding-right: 10px; cursor: pointer;"/><span>ADD BANK</span></div>

<div class="tab-pane active" id="tabBank" data-id="3">
    <div class="btn-add-maintain">
    </div>
    <table id="tblBank" class="table-admin">
        <thead>
        <tr>
            <th class="tblHeaderGlobal">Bank Name</th>
            <th class="tblHeaderGlobal">Bank Is Product</th>
            <th class="tblHeaderGlobal">Bank Logo</th>
            <th class="tblHeaderGlobal">Action</th>
        </tr>
        </thead>
    </table>
</div>
@stop
