@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('css-toastmessage', 'css/jasny-bootstrap.min.css') }}
{{ Theme::asset()->usePath()->add('css-jasny', 'css/jquery.toastmessage-min.css') }}

{{ Theme::asset()->usePath()->add('js-user-toast', 'js/jquery.toastmessage-min2.js') }}
{{ Theme::asset()->usePath()->add('js-jasny', 'js/jasny-bootstrap.min.js') }}
{{ Theme::asset()->usePath()->add('js-user-index', 'js/user/index.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.validate', 'js/jquery.validate.js') }}
{{ Theme::asset()->usePath()->add('js-maintenance-billcategory', 'js/maintenance/billcategory.js') }}
{{ Theme::asset()->usePath()->add('css-maintenance-billcategory', 'css/maintenance/billercategory.css') }}
{{ Theme::asset()->usePath()->add('css-maintenance-billcategory', 'css/user/filtering.css') }}
{{ Theme::asset()->usePath()->add('js-ajaxForm', 'js/jquery.form.js') }}


@stop

@section('modal')
<style>
    #description{
        margin-left: 0;
        width: 100%;
    }

    .modal-footer {
        text-align: center;
    }
    .errordescription, .errorcategory{
        position: absolute;
    }
    #search-box {
        top: 91px;
    }
    .dropdownDiv {
        margin-top: -11px;
        padding-bottom: 7px;
    }
    ul.dropdown-menu{
        top: 76%;
        left: 5px;
        min-width: 170px;
    }
    .table-admin thead th, .table-admin thead {
        background-color: #0a94bb !important;
        color: #ffffff !important;
    }
    #btncanceladdbillerCate{
        background: #af2835 none repeat scroll 0 0 !important;
        border-color: #73020d !important;
        border-radius: 2px !important;
        border-style: none none solid !important;
        border-width: 0 0 4px !important;
        color: white;
        font-weight: lighter;
        height: 32px;
        position: relative;
        right: -9px;
        width: 153px;
    }
    #savebillerCate{
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
        right: -6px;
        width: 153px;
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

<!--Modal for add-->
<div class="modal fade" id="myModalAddBillerCate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header" style="border: none">
                <h4 class="modal-title" id="myModalLabel">Add Biller Category</h4>
                <hr style="bottom: 6px;
    height: 1px;
    position: relative;
    background:  #e5e5e5;
    right: 53px;
    width: 123%;">
            </div>
            <div id="errorDivmodalbillerCate" class="col-md-12">

            </div>
            <form url='/admin/maintenance/biller-category/add/save' id="form" method="post" style="bottom: 17px;
    position: relative;">
                <br>
                <input type='hidden' class='form-control input-sm' placeholder="id" id="category_id" name="category_id" value="0">
                <br>

                <input type='text' class='form-control input-sm billercategory alpha' placeholder="Name" id="category"  name="category" autocomplete="off" maxlength="50">
                <span class="errorcategory"></span>
                <input type="hidden" id="biller_name_reference" value=""/>
                <input type="hidden" value="0" id="notxistingcate"/>
                <br>
                <input type='text' class='form-control alpha input-sm' placeholder="Description" id="description" name="description" autocomplete="off" maxlength="500">
                <span class="errordescription"></span>
                <br>

                <div class="modal-footer" style="border: none;">
                    {{ Form::submit('Save',array( 'class' => 'btn btn-fb btn-large','id'=>'savebillerCate')) }}
                    <input id="btncanceladdbillerCate" type="button" class="btn btn-fb-cancel btncancel"
                           data-dismiss="modal" value="Cancel"/>
                </div>
            </form>
        </div>
    </div>
</div>
<!--------------->
<div class="modal fade" id="myModalEditBillerCate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header" style="border: none">
                <h4 class="modal-title" id="myModalLabel">Edit Biller Category</h4>
                <hr style="bottom: 6px;
    height: 1px;
    position: relative;
    background:  #e5e5e5;
    right: 53px;
    width: 123%;">
            </div>
            <div id="errorDivmodalbillerCate" class="col-md-12">

            </div>
            <form url='/admin/maintenance/biller-category/add/save' id="formedit" method="post" style="position: relative;
    top: -22px;">
                <br>
                <input type='hidden' class='form-control input-sm' placeholder="id" id="categoryedit_id" name="category_id" value="0">
                <br>

                <input type='text' class='form-control input-sm billercategory alpha' placeholder="Name" id="categoryedit" name="category" autocomplete="off" maxlength="50">

                <span class="errorcategory"></span>
                <input type="hidden" id="biller_name_reference" value=""/>
                <input type="hidden" value="0" id="notxistingeditcate"/>
                <br>
                <input type='text' class='form-control input-sm alpha' placeholder="Description" id="descriptionedit" name="description" autocomplete="off" maxlength="500">
                <span class="errordescription"></span>
                <br>

                <div class="modal-footer" style="border: none">

                    {{ Form::submit('Save',array( 'class' => 'btn btn-fb btn-large','id'=>'savebillerEditCate')) }}
                    <input id="btncancelEditbillerCate" type="button" class="btn btn-fb-cancel btncancel"
                           data-dismiss="modal" value="Cancel"name="cancel"/>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

<!--For add image button-->

@section('nav-tabs')
<div class="view_menus">
    <ul class="nav nav-tabs" id="tabBillerView">
        <li class="active">
            <a href="#tabMembers" data-toggle="tab" class="tabb">Bill Category</a>
        </li>
    </ul>
</div>
@stop
<!--interface content of datatable-->

@section('tabs')
<h3 style="position: relative; top: -15px; color: black; padding-left: 4px;">BILL CATEGORY</h3>
<!--<br/>-->
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
<div class="btnaddmember-u"><img id="btnAddbillerCate" class="icons" src="<?php echo Theme::asset()->url('img/addbill.png'); ?>" style="color: white;
    cursor: pointer;
    float: left !important;
    height: 30px;
    left: 10px;
    opacity: 0.01;
    padding-right: 10px;
    position: relative;
    width: 100%;
    z-index: 999;"/><button style="border: medium none;
    height: 36px;
    left: 8px;
    position: relative;
    background: #0a94bb !important;
    color: white;
    top: -45px;
    width: 100%;">ADD BILLER CATEGORY</button></div>
<div class="tab-pane active" id="tabMembers" data-id="1" style="position: relative;
    top: 8px;">
    <div class="btn-add-maintain">
    </div>
    <table id="tblbillerCate" class="table-admin">
        <thead>
        <tr>
            <th  class="tblHeaderGlobal">ID</th>
            <th  class="tblHeaderGlobal">Category Name</th>
            <th  class="tblHeaderGlobal">Category Description</th>
            <th  class="tblHeaderGlobal" style="
    padding-left: 26px;
    position: relative;
    text-align: left;
    width: 205px;">Action</th>
        </tr>
        </thead>
    </table>
</div>
<style>
    .tab-content {
        margin: 30px 20px 0;
    }
</style>
@stop