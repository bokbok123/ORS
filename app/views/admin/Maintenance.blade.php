<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
{{ Theme::asset()->usePath()->add('css-user-index', 'css/user/index.css') }}
{{ Theme::asset()->usePath()->add('js-user-index', 'js/user/index.js') }}
<div id="errorDiv">

    @if ($Status =='Save')
    <div class="row alert alert-success">
        <label class="control-label" for="inputSuccess1">{{$Tab}} has been Sucessfully saved</label>
    </div>
    @endif
    @if ($Status =='Error')
    <div class="row alert alert-danger" style="display:none;">
        <label class="control-label" for="inputSuccess1"></label>
    </div>
    @endif
</div>
<div class="modal fade" id="myModalAddBillerCate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Biller Category</h4>

            </div>
            <div id="errorDivmodalbillerCate" class="col-md-12">

            </div>
            <form action='admin/biller/category/add' id="form" method="post">

                <br>
                <input type='text' class='form-control input-sm' placeholder="Bill" id="category" name = "category">

                <br>
                <input type='text' class='form-control input-sm' placeholder="Description" id="description" name = "description">
                <br>

                <div class="modal-footer">
                    <a class="btn btn-info btn-large" id="savebillerCate"> Save </a>
                    <input id="btncanceladdbillerCate" type="button" class="btn btn-default btncancel" data-dismiss="modal" value="Cancel"/>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalAddBiller" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Biller</h4>
            </div>
            <div id="errorDivmodalbiller" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'BillerEntryForm','enctype'=>'multipart/form-data','url'=>'admin/biller/add')) }}

            <br>
            <div class="row">
                <div class="col-md-8">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 46px; font-size: 0px;" id="imgContainer"></div>
                        <div>

                            <div class="warning"></div>

									<span class="btn btn-default1 btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="biller_logo" id="biller_logo">
									</span>

                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">{{ Form::select('category', $billerCategory, $Status =='Save' ? '':Input::get('category'),array('class' => 'form-control reg-corners','id'=>'category')) }}</div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-8">{{ Form::text('billerName', $Status =='Save' ? '':Input::get('billerName'),['class' => 'form-control input-sm','placeholder' => 'Biller Name','id'=>'billerName']) }}</div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-8">{{ Form::text('billerAccount', $Status =='Save' ? '':Input::get('billerAccount'),['class' => 'form-control input-sm','placeholder'=>'Biller Account','id'=>'billerAccount']); }}</div>
            </div>
            <br>
            <div class="modal-footer">
                <div class="row">
                    {{ Form::submit('Save',array( 'class' => 'btn btn-info btn-large','id'=>'savebiller')) }}
                    <input id="btncanceladdbiller" type="button" class="btn btn-default btncancel" data-dismiss="modal" value="Cancel"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="myModalAddBank" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Bank</h4>
            </div>
            <div id="errorDivmodalbank" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('url'=>'addpostBank', 'files'=>true,'id'=>'BankEntryForm')) }}
            Bank Name : {{ Form::text('bank_name', Input::old('bank_name'), array('id' => 'bank_name', 'style' => '','placeholder'=>'Bank Name', 'class'=>'form-control reg-corners bankaccountclass' )); }}
            Branch Name : {{ Form::text('branch_name', Input::old('branch_name'), array('id' => 'branch_name', 'style' => '','placeholder'=>'Branch Name', 'class'=>'form-control reg-corners bankaccountclass' )); }}
            Branch Address : {{ Form::text('branch_address', Input::old('branch_address'), array('id' => 'branch_address', 'style' => '','placeholder'=>'Branch Address', 'class'=>'form-control reg-corners bankaccountclass' )); }}
            Contact No. : {{ Form::text('branch_contactno', Input::old('branch_contactno'), array('id' => 'branch_contactno', 'style' => '','placeholder'=>'Contact Number', 'class'=>'form-control reg-corners bankaccountclass' )); }}
            <br>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <p>Image(test)</p>
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:113px;height: 32px;;line-height: 286px;"></div>
                <div>
                    <div class="warning"></div>
                                    <span class="btn btn-default1 btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input class="btn-blue-3d" type="file" name="image" id="image" size="60">
                                    </span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
            </div>
            <br>
            <div class="modal-footer">
                {{ Form::submit('Save',array('class'=>'btn btn-info btn-large','id'=>'savebank'))}}
                <input id="btncanceladdbank" type="button" class="btn btn-default btncancel" data-dismiss="modal" value="Cancel"/>
                {{ Form::close() }}
            </div>
        </div>
    </div>
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
            {{ Form::open(array('url'=>'addpostBankBranch', 'files'=>true,'id'=>'BankBranchEntryForm')) }}
            Branch Name : {{ Form::text('branch_name', Input::old('branch_name'), array('id' => 'branch_name', 'style' => '','placeholder'=>'Branch Name', 'class'=>'form-control reg-corners bankaccountclass' )); }}
            Branch Address : {{ Form::text('branch_address', Input::old('branch_address'), array('id' => 'branch_address', 'style' => '','placeholder'=>'Branch Address', 'class'=>'form-control reg-corners bankaccountclass' )); }}
            Contact No. : {{ Form::text('branch_contactno', Input::old('branch_contactno'), array('id' => 'branch_contactno', 'style' => '','placeholder'=>'Contact Number', 'class'=>'form-control reg-corners bankaccountclass' )); }}
            Bank Name :{{ Form::select('branchbankname', $banklist, $Status =='Save' ? '':Input::get('branchbankname'),array('class' => 'form-control reg-corners','id'=>'branchbankname')) }}

            <br>
            <div class="modal-footer">
                {{ Form::submit('Save',array('class'=>'btn btn-info btn-large','id'=>'savebankBranch'))}}
                <input id="btncanceladdbankBranch" type="button" class="btn btn-default btncancel" data-dismiss="modal" value="Cancel"/>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div class="view_menus">
    <ul class="nav nav-tabs" id="tabBillerView">
        <li class="active">
            <a href="#tabMembers"  data-toggle="tab" class="tabb">Bill Category</a>
        </li>
        <li class="">
            <a href="#tabBiller"  data-toggle="tab" class="tabb">Biller</a>
        </li>
        <li class="">
            <a href="#tabBank" data-toggle="tab" class="tabb">Bank</a>
        </li>
        <li class="">
            <a href="#tabbankbran"  data-toggle="tab" class="tabb">Bank Branches</a>
        </li>
    </ul>
</div>
<div class="tab-content">
<div class="tab-pane active" id="tabMembers" data-id="1">
    <div class="btn-add-maintain">
        <img id="btnAddbillerCate" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" />
    </div>
    <table id="tblbillerCate" class="table compact">
        <thead>
        <tr>
            <th class="th_left" style="background-color: #788C9E;">Category Name</th>
            <th class="" style="background-color: #788C9E;">Category Description</th>
            <th class="" style="background-color: #788C9E;">Action</th>
        </tr>
        </thead>
    </table>
</div>

<div class="tab-pane " id="tabBiller" data-id="2">
    <div class="btn-add-maintain">
        <img id="btnAddbiller" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>"/>
    </div>
    <table id="tblbiller" class="billerBinTable table compact">
        <thead>
        <tr>
            <th class="th_left" style="background-color: #788C9E;">Biller Name</th>
            <th class="" style="background-color: #788C9E;">Biller Category</th>
            <th class="" style="background-color: #788C9E;">Biller Logo</th>
            <th class="" style="background-color: #788C9E;">Action</th>
        </tr>
        </thead>

    </table>
</div>

<div class="tab-pane " id="tabBank" data-id="3">
    <div class="btn-add-maintain">
        <img id="btnAddBank" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>"/>
    </div>
    <table id="tblBank" class="BankBinTable table compact">
        <thead>
        <tr>
            <th class="th_left" style="background-color: #788C9E;">Bank Name</th>
            <th class="" style="background-color: #788C9E;">Bank Is Product</th>
            <th class="" style="background-color: #788C9E;">Bank Logo</th>
            <th class="" style="background-color: #788C9E;">Action</th>
        </tr>
        </thead>
    </table>
</div>

<div class="tab-pane " id="tabbankbran" data-id="4">
    <div class="btn-add-maintain">
        <img id="btnAddBankBranch" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" />
    </div>
    <table id="tblbankbran" class="bankbranBinTable table compact">
        <thead>
        <tr>
            <th class="th_left" style="background-color: #788C9E;">Branch Name</th>
            <th class="" style="background-color: #788C9E;">Address</th>
            <th class="" style="background-color: #788C9E;">Contact No.</th>
            <th class="" style="background-color: #788C9E;">Bank Name</th>
            <th class="" style="background-color: #788C9E;">Bank Logo</th>
            <th class="" style="background-color: #788C9E;">Action</th>
        </tr>
        </thead>
    </table>
</div>


<script>
$(document).ready(function() {
    var BASE_URL = $('#hdnBaseUrl').val();
    $('#tblBank').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL+"/admin/biller/ajax?type=bank-list",
        "lengthMenu": [[ 12, 50], [ 15, 50]],
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": false }
        ]

    });

    $("#tblBank").on('click','.btn-deactivateBank',function(){
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button) {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-deactivate-bank",
                    beforeSend : function (){
                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function(req,status){

                    },
                    success: function(ret){
                        $().iseziloading('hide');
                        global.updateDataTable('tblBank');
                    }
                });

            },
            cancel: function(button) {
            }

        });
    });

    $("#tblBank").on('click','.btn-activateBank',function(){
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function(button) {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-activate-bank",
                    beforeSend : function (){
                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function(req,status){

                    },
                    success: function(ret){
                        $().iseziloading('hide');
                        global.updateDataTable('tblBank');
                    }
                });

            },
            cancel: function(button) {
            }

        });
    });

    $('#tblbillerCate').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL+"/admin/biller/ajax?type=billerCate-list",
        "lengthMenu": [[ 12, 50], [ 15, 50]],
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": false }
        ]

    });

    $("#tblbillerCate").on('click','.btn-deactivateBill',function(){
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button) {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-deactivate",
                    beforeSend : function (){
                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function(req,status){

                    },
                    success: function(ret){
                        $().iseziloading('hide');
                        global.updateDataTable('tblbillerCate');
                    }
                });

            },
            cancel: function(button) {
            }

        });
    });

    $("#tblbillerCate").on('click','.btn-activateBill',function(){
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function(button) {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-activate",
                    beforeSend : function (){
                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function(req,status){

                    },
                    success: function(ret){
                        $().iseziloading('hide');
                        global.updateDataTable('tblbillerCate');
                    }
                });

            },
            cancel: function(button) {
            }

        });
    });

    $('#tblbiller').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL+"/admin/biller/ajax?type=biller-list",
        "lengthMenu": [[ 10, 50], [ 15, 50]],
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": false }
        ]

    });

    $("#tblbiller").on('click','.btn-deactivateBiller',function(){
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button) {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-deactivate-biller",
                    beforeSend : function (){
                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function(req,status){

                    },
                    success: function(ret){
                        $().iseziloading('hide');
                        global.updateDataTable('tblbiller');
                    }
                });

            },
            cancel: function(button) {
            }

        });
    });

    $('#SearchMyBills').keyup(function () {
        $('#tblbiller').dataTable().fnFilter($(this).val());
    });

    $("#tblbiller").on('click','.btn-activateBiller',function(){
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function(button) {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-activate-biller",
                    beforeSend : function (){
                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function(req,status){

                    },
                    success: function(ret){
                        $().iseziloading('hide');
                        global.updateDataTable('tblbiller');
                    }
                });

            },
            cancel: function(button) {
            }

        });
    });

    $('#tblbankbran').dataTable({
        "sDom": 'rt<"bottom"ip><"clear">',
        "bServerSide": true,
        "sAjaxSource": BASE_URL+"/admin/biller/ajax?type=bankbran-list",
        "lengthMenu": [[ 7, 50], [ 15, 50]],
        "aoColumnDefs": [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": true },
            { "aTargets": [ 4 ], "bSortable": true },
            { "aTargets": [ 5 ], "bSortable": false }
        ]

    });
    $("#tblbankbran").on('click','.btn-deactivateBranches',function(){
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm deactivation</div>",
            confirm: function(button) {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-deactivate-branches",
                    beforeSend : function (){
                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function(req,status){

                    },
                    success: function(ret){
                        $().iseziloading('hide');
                        global.updateDataTable('tblbankbran');
                    }
                });

            },
            cancel: function(button) {
            }

        });
    });

    $("#tblbankbran").on('click','.btn-activateBranches',function(){
        var id = $(this).data('id');
        $.confirm({
            text: "<div style='font-size: 18px;'>Please confirm Activation</div>",
            confirm: function(button) {
                $.ajax({
                    type: 'post',
                    url: BASE_URL+"/admin/biller/ajax?type=btn-activate-branches",
                    beforeSend : function (){
                        $().iseziloading('show');
                    },
                    data: {
                        id: id
                    },
                    error: function(req,status){

                    },
                    success: function(ret){
                        $().iseziloading('hide');
                        global.updateDataTable('tblbankbran');
                    }
                });

            },
            cancel: function(button) {
            }

        });
    });


    $("#btnAddbillerCate").click(function(){
        $("#myModalAddBillerCate").modal("show");
    });
    $("#btnAddbiller").click(function(){
        $("#myModalAddBiller").modal("show");
    });
    $("#btnAddBank").click(function(){
        $("#myModalAddBank").modal("show");
    });
    $("#btnAddBankBranch").click(function(){
        $("#myModalAddBankBranch").modal("show");
    });
    $(".btncancel").mouseover(function(){
        $(this).focus();
    });
    $("#savebillerCate").on('click',  function(e)
    {
        e.preventDefault();
        $.confirm({
            text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",

            confirm: function(button)
            {
                /*@category This is for category input value*/
                /*@description This is for category description input value*/
                /*@index This is for a counter*/
                /*@text This is for validation text*/

                var category = $("#category").val();
                var description = $("#description").val();
                var index;
                var text = "";
                if(category!=""&& description!="")
                {
                    $('#form').submit();
                    return true;
                }
                else
                {
                    var fields = [category,description];
                    for (index = 0; index < fields.length; index++)
                    {
                        var name;
                        if(index==0 && fields[index]=="")
                        {
                            name="BILL IS REQUIRED"
                            text += name  + "";

                        }
                        else if(index==1 && fields[index]=="")
                        {
                            name="BILL DESCRIPTION IS REQUIRED"
                            text += "</br>" + name  + "";
                        }

                    }

                    document.getElementById('errorDivmodalbillerCate').innerHTML="<div class='row alert alert-danger'>"+text+"</div>";
                    return false;
                }

            },
            cancel: function(button)
            {
                return false;
            }
        });
    });
    $('#biller_logo').change(function()
    {
        validateUpload(this.files[0]);
    });

    $('#image').change(function()
    {
        validateUpload(this.files[0]);
    });
    function validateUpload(file)
    {

        /*@uploadFile This is for file parameter.*/
        /*@image This is for new Instantiate of image class.*/
        /*@reader This is for new Instantiate of FileReader class.*/
        /*@uploadFileName This is for image file name.*/
        /*@fileType This is for uploaded image file type*/

        var uploadFile = file;
        var image  = new Image();
        var reader = new FileReader();
        var uploadFileName = uploadFile.name;
        var fileType = uploadFileName.split('.')[uploadFileName.split('.').length - 1].toLowerCase();


        if (fileType == 'png' || fileType == 'jpeg' || fileType == 'jpg')
        {
            reader.readAsDataURL(uploadFile);
            reader.onload = function(_file)
            {
                image.src   = _file.target.result;
                image.onload = function()
                {
                    var w = this.width;
                    var h = this.height;

                    if (w > 240 && h > 70)
                    {
                        var imgContainer = document.getElementById("imgContainer");
                        var img = imgContainer.children[0];
                        imgContainer.removeChild(img);

                        $(".warning").text("File Size must be 240 x 70 pixels");
                    }
                    else
                    {
                        $(".warning").text("");
                    }
                };
            };
        }
        else
        {
            $(".warning").text("File type not supported.");
//                $("#x").text("False");
        }
    }
    $("#savebiller").on('click',  function(e){
        e.preventDefault();
        $.confirm({
            text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",

            confirm: function(button)
            {
                /*@file This is for biller logo input value.*/
                /*@category This is for biller category input value.*/
                /*@billerName This is for biller name input value.*/
                /*@billerAccount This is for biller account number input value.*/
                /*@index This is for a counter */
                /*@text This is for validation text.*/

                var file = $("#biller_logo").val();
                var category = $("#category").val();
                var billerName = $("#billerName").val();
                var billerAccount = $("#billerAccount").val();
                var index;
                var text = "";
                if(file!=''&&category!=0&&billerName!=""&&billerAccount!=""){

                    $('#BillerEntryForm').submit();
                    return true;
                }else{
                    var fields = [file,category, billerName, billerAccount];
                    for (index = 0; index < fields.length; index++)
                    {
                        var name;
                        if(index==0 && fields[index]==''){
                            name="IMAGE IS REQUIRED";
                            text += name  + "";

                        }
                        else if(index==1 && fields[index]==0){
                            name="CATEGORY IS REQUIRED";
                            text += "</br>" + name  + "";
                        }
                        else if(index==2 && fields[index]==""){
                            name="BILLING NAME IS REQUIRED";
                            text += "</br>" + name  + "";
                        }
                        else if(index==3 && fields[index]=="")
                        {
                            name="BILLING ACCOUNT IS REQUIRED";
                            text += "</br>" + name  + "";
                        }
                    }
                    //text += "";
                    document.getElementById('errorDivmodalbiller').innerHTML="<div class='row alert alert-danger'>"+text+"</div>";
                    return false;
                }

                return false;
            },
            cancel: function(button) {
                return false;
            }
        });
    });
    $("#savebank").on('click',  function(e){
        e.preventDefault();
        $.confirm({
            text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",

            confirm: function(button)
            {
                /*@file This is for biller logo input value.*/
                /*@category This is for biller category input value.*/
                /*@billerName This is for biller name input value.*/
                /*@billerAccount This is for biller account number input value.*/
                /*@index This is for a counter */
                /*@text This is for validation text.*/

                var file = $("#image").val();
                var bank_name = $("#bank_name").val();
                var branch_name = $("#branch_name").val();
                var branch_address = $("#branch_address").val();
                var branch_contactno = $('#branch_contactno').val();

                var index;
                var text = "";
                if(file!=''&&bank_name!=""){

                    $('#BankEntryForm').submit();
                    return true;
                }else{
                    var fields = [file,bank_name,branch_name,branch_address,branch_contactno];
                    for (index = 0; index < fields.length; index++)
                    {
                        var name;
                        if(index==0 && fields[index]==''){
                            name="IMAGE IS REQUIRED";
                            text += name  + "";

                        }
                        else if(index==1 && fields[index]==''){
                            name="BANK NAME IS REQUIRED";
                            text += "</br>" + name  + "";
                        }
                        else if(index==2 && fields[index]=='') {
                            name = "BRANCH NAME IS REQUIRD"
                            text += "</br>" + name + "";
                        }
                        else if(index==3 && fields[index]==''){
                            name="BRANCH NAME IS REQUIRED";
                            text += "</br>" + name  + "";
                        }
                        else if(index==4 && fields[index]==''){
                            name="CONTACT NUMBER IS REQUIRED AND MUST BE ATLEAST 7 NUMBER";
                            text += "</br>" + name  + "";

                        }

                    }
                    document.getElementById('errorDivmodalbank').innerHTML="<div class='row alert alert-danger'>"+text+"</div>";
                    return false;
                }

                return false;
            },
            cancel: function(button) {
                return false;
            }
        });
    });
    $("#savebankBranch").on('click',  function(e){
        e.preventDefault();
        $.confirm({
            text: "<div style='font-size: 13px; font-weight: bold; margin: 0 30% 0  30%;'>Please confirm to save</div>",

            confirm: function(button)
            {
                /*@file This is for biller logo input value.*/
                /*@category This is for biller category input value.*/
                /*@billerName This is for biller name input value.*/
                /*@billerAccount This is for biller account number input value.*/
                /*@index This is for a counter */
                /*@text This is for validation text.*/


                var branch_name = $("#branch_name").val();
                var branch_address = $("#branch_address").val();
                var branch_phone = $("#branch_contactno").val();
                var bank_name = $("#branchbankname").val();
                var index;
                var text = "";
                if(branch_name!=""&&branch_address!=""&&branch_phone!=""&&bank_name!=0&&branch_phone.length>=7){

                    $('#BankBranchEntryForm').submit();
                    return true;
                }else{
                    var fields = [branch_name,branch_address,branch_phone,bank_name];
                    for (index = 0; index < fields.length; index++)
                    {
                        var name;
                        if(index==0 && fields[index]==''){
                            name="BRANCH NAME IS REQUIRED";
                            text += name  + "";

                        }
                        else if(index==1 && fields[index]==''){
                            name="BRANCH ADDRESS IS REQUIRED";
                            text += "</br>" + name  + "";
                        }
                        else if(index==2 && fields[index]==''){
                            name="CONTACT NUMBER IS REQUIRED AND MUST BE ATLEAST 7 NUMBER";
                            text += "</br>" + name  + "";
                        }
                        else if(index==3 && fields[index]==0){
                            name="BANK IS REQUIRED";
                            text += "</br>" + name  + "";
                        }
                    }
                    //text += "";
                    document.getElementById('errorDivmodalbankbranch').innerHTML="<div class='row alert alert-danger'>"+text+"</div>";
                    return false;
                }

                return false;
            },
            cancel: function(button) {
                return false;
            }
        });
    });
    $("#branch_contactno").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
</script>


