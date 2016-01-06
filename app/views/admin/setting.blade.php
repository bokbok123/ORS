{{ Theme::asset()->usePath()->add('css-user-index', 'css/user/index.css') }}
{{ Theme::asset()->usePath()->add('css-adminmenu', 'css/bpo/index.css') }}
<style>
    .col-lg-2 {
        width: 35.667%;
    }
    #btnEditSettings {
        margin-right: 158px;
        margin-top: 10px;
    }
    .tab-content {
        margin: 50px 20px 0px;
    }
    #search-box{
        top: 95px !important;
    }
    .table-admin thead th, .table-admin thead {
        background-color: #0a94bb !important;
        color: #ffffff !important;
    }

</style>
<h3 style="color:black; top: 30px; position: relative; padding-left: 22px;">ADMIN SETTINGS</h3>
<br/><br/>
<div class="input-group" id="search-box">
    <span class="input-group-addon" style="background-color: #ffffff !important;width:0px !important; border-right: 1px solid #ffffff !important;">
        <img src="<?php echo Theme::asset()->url('img/magnifying.png'); ?>" >
    </span>
    <input type="text" id="SearchMyBills" name="SearchMyBills" placeholder="Search" class="form-control" style="width: 222px; margin-left: -1px">
</div>

<style>
    #search-box {
        margin-bottom: 20px;
        position: absolute;
        top: 59px;
        left: 35px;
    }
    #colorbox {
        width: 580px !important;
        left: 405px !important;
    }
    #cboxContent {
        width: 582px !important;
    }
    .modal-footer {
        text-align: center;
    }
    #btnEditSettings {
        margin-right: 0px !important;
        margin-top: 0px !important;
        margin-left: 0px !important;
    }
    .modal-footer .btn + .btn {
        margin-left: 0px !important;
    }
    #profile-caret {
        margin-top: 0;
    }
    #field_value{text-align: right}
    ::-webkit-input-placeholder {
        text-align: left;field_value
    }
    ::-moz-placeholder { /* Firefox 19+ */
        text-align: left;
    }
    :-ms-input-placeholder {
        text-align: left !important;
    }
    :-moz-placeholder { /* Firefox 18- */
        text-align: left;
    }
    #hideSpan{
        color: #ff0000;
        display: none;
        margin-top: -12px;
        position: absolute;
        right: 92px;
    }
</style>
    <div class="tab-content">
<!--        <br/>-->
        <div class="tab-pane active" id="admin_settings">
            <table id="tblAdminSettings" class="table-admin">
                <thead>
                    <tr>
                        <th>Setting ID</th>
                        <th>Field Code</th>
                        <th>Field Name</th>
                        <th>Field value</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- End of Tab panes -->

<div class="modal fade" id="edit_admin_settings" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header" style="border: none;">
                <h4 class="modal-title" id="add_new_client">Settings</h4>
                <hr style="bottom: 6px;
    height: 1px;
    position: relative;
    background:  #e5e5e5;
    right: 53px;
    width: 123%;">
            </div>
            <div id="errorDivmodalbillerCate" class="col-md-12">
            </div>
            <form id="editAdminSubmit" role="form" method="post" id="" class="form-horizontal" style="bottom: 10px;
    position: relative;">
                <input type="hidden" id="hdnId" name="hdnId"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="contact-name" class="col-lg-2 control-label">Field Code:</label>
                        <div class= "col-lg-6">
                            {{ Form::text('field_code', Input::old('text'), array('id' => 'field_code', 'class' => 'form-control', 'readonly' =>'readonly')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-email" class="col-lg-2 control-label">Field Name:</label>
                        <div class="col-lg-6">
                            {{ Form::text('field_name', Input::old('value'), array('id' => 'field_name', 'class' => 'form-control ', 'readonly' =>'readonly')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-email" class="col-lg-2 control-label">Field Value:</label>
                        <div class="col-lg-6">
                            {{ Form::text('field_value', Input::old('value'), array('id' => 'field_value', 'class' => 'form-control')) }}
                        </div>
                    </div>
                    <span id="hideSpan">This field is required.</span>
                </div>

                <div class="modal-footer" style="border: none">
                    <button id="btnEditSettings" class="btn btn-fb confirm" type="button">SAVE</button>
                    <input id="btncanceladdbillerCate" type="button" class="btn btn-fb-cancel btncancel"
                           data-dismiss="modal" value="Cancel"/>
                </div>
            </form>
        </div>
    </div>
</div>

