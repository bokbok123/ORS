{{ Theme::asset()->usePath()->add('js-remarks','js/user/remarks.js') }}

<div style="right: 1px;position: relative;top: 41px;">
    <h3 style="color:#000000">Add Remarks</h3>
    <button style="background: #0a94bb none repeat scroll 0 0;
    border: medium none;
    border-radius: 1px;
    color: white;
    position: relative;
    top: -5px;
    float: right;
    height: 34px;
    width: 10% !important;" class="btn btn-primary btnResetRem" data-toggle="modal" data-target="#myModalAddRemarks">Add Remarks</button>

        <ul id="hearder2Right" class="nav navbar-nav navbar-right custom-navbar-nav" style="margin-top: 10px;">

            <li style="margin-left: 20px;margin-right: 76px;">
                <div class="input-group" style=" bottom: 14px;
    float: left;
    position: relative;
    right: 657px;">
                    <span class="input-group-addon" style="background-color: #ffffff !important;width:0px !important;">
                        <img src="<?php echo Theme::asset()->url('img/searchmagni.png'); ?>" >
                    </span>
                    <input type="text" id="SearchMyBills" name="SearchMyBills" placeholder="Search" class="form-control" style="width: 221px; padding: 0">
                </div>
            </li>
        </ul>


    <table id="tblremarks" class="table-admin" style=" position: relative;">
        <thead>
        <th>ID</th>
        <th>Description</th>
        <th>Remark Title</th>
        <th>Actions</th>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="myModalAddRemarks" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="position: relative;top: 190px;">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Remarks</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('id' => 'formRemarksAdmin')) }}
                <input type="text" required id="addreasoncode" name="addreasoncode" class="form-control" placeholder="Reason Title"/><br>
                <input type="text" required id="addreason" name="addreason" class="form-control" placeholder="Reason"/>
            </div>
            <div class="modal-footer clearfix" style="border: none" >
                <div class="row">
                    <input id="btncanceladdbank" type="button" class="btn btncancel btnCancelR" data-dismiss="modal"
                           value="Cancel"/>
                    {{ Form::submit('Save',array('class'=>'btn btn-fb btn-large btnSaveRemark','id'=>'addRemarks'))}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editRemarksModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style=" position: relative;
    top: 197px;">
        <div class="modal-content col-md-12" style="background-clip: padding-box;
    background-color: #fff;
    border: 14px solid rgba(0, 0, 0, 0.2);
    border-radius: 26px;
    box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
    outline: 0 none;
    position: relative;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Update Remarks</h4>
            </div>
            <div class="modal-body">
                <label class="label">Reason</label>
                <input type="text" id="editreason" name="editreason" class="form-control" placeholder="reason"/>
            </div>
            <div class="modal-footer clearfix" style="padding: 15px; border: none;
    text-align: right;" >
                <div class="row">
                    <input style=" position: relative; right: 69px;" id="btncanceladdbank" type="button" class="btn  btncancel btnCancelRemarks" data-dismiss="modal"
                           value="Cancel"/>
                    {{ Form::submit('Save',array('class'=>'btn btn-fb btn-large btn-cancelRemarks','id'=>'editRemarks',))}}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-cancelRemarks{
        background: #0a94bb none repeat scroll 0 0 !important;
        border-color: #006e96 !important;
        border-radius: 2px !important;
        border-style: none none solid !important;
        border-width: 0 0 4px !important;
        color: #fff !important;
        font-family: "Roboto-Regular",sans-serif !important;
        font-size: 12px !important;
        font-weight: bold !important;
        height: 32px;
        position: relative;
        right: 87px;
        width: 153px;

    }
    .btn-cancelRemarks:hover{
        color: white;
    }

   .btnCancelRemarks{
       background: #af2835 none repeat scroll 0 0 !important;
       border-color: #73020d !important;
       border-radius: 2px !important;
       border-style: none none solid !important;
       border-width: 0 0 4px !important;
       color: white;
       font-weight: lighter;
       height: 32px;
       left: -13px;
       margin-right: 15px;
       position: relative;
       width: 153px;
   }
    .btnCancelRemarks:hover{
        color: white;
    }
    .btn-confirm-remarks{
        background: #0a94bb none repeat scroll 0 0 !important;
        border-color: #006e96 !important;
        border-radius: 2px !important;
        border-style: none none solid !important;
        border-width: 0 0 4px !important;
        color: #fff !important;
        font-family: "Roboto-Regular",sans-serif !important;
        font-size: 12px !important;
        font-weight: bold !important;
        height: 32px;
        position: relative;
        right: 87px;
        width: 153px;
    }
    .cancelEditRemarks {
        background: #af2835 none repeat scroll 0 0 !important;
        border-color: #73020d !important;
        border-radius: 2px !important;
        border-style: none none solid !important;
        border-width: 0 0 4px !important;
        color: white;
        font-weight: lighter;
        height: 32px;
        position: relative;
        right: 102px;
        width: 153px;
    }
    .cancelEditRemarks:hover{
        color: white;
    }
    .btnSaveRemark{
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
        height: 32px;
        width: 153px;
    }
    .btnCancelR{
        background: #af2835 none repeat scroll 0 0 !important;
        border-color: #73020d !important;
        border-radius: 2px !important;
        border-style: none none solid !important;
        border-width: 0 0 4px !important;
        color: white;
        font-weight: lighter;
        height: 32px;
        position: relative;
        right: 57px;
        width: 153px;
    }
    .btnCancelR:hover{
        color: white;
    }
</style>