@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('css-toastmessage', 'css/jquery.toastmessage-min.css') }}
<!-- END OF CSS FOR CREATE BILL - ADMIN  -->

<!--- JS FOR CREATE BILL  - ADMIN -->
{{ Theme::asset()->usePath()->add('js-jquery.colorbox-min1', 'js/jquery.colorbox-min.js') }}
{{ Theme::asset()->usePath()->add('js-user-receipt_index', 'js/user/receipt_index.js') }}
{{ Theme::asset()->usePath()->add('js-toastmessage', 'js/jquery.toastmessage-min.js') }}
<!---END OF  JS FOR CREATE BILL  - ADMIN -->
@stop

@section('hidden')
    <input type="hidden" id="status" value="{{$Status}}"/>
@stop

@section('nav-tabs')
    <li class="active"><a href="#tabUploadedBill" role="tab" data-toggle="tab"><span class="badge pull-right" id="upload-tab">
        {{isset($no_bills) ? $no_bills : 0}}</span>Uploaded Bills</a></li>
    <li class=""><a href="#tabRejectedBill" role="tab" data-toggle="tab">Rejected Bills</a></li>
@stop

@section('tabs')
    <div class="tab-pane active" id="tabUploadedBill">
        <table id="tblUploadedReceipts" class="table-admin table compact">
            <thead>
            <tr>
                <th class="tblHeaderGlobal">ID</th>
                <th class="tblHeaderGlobal"></th>
                <th class="tblHeaderGlobal" style="width: 285px;">Date</th>
                <th class="tblHeaderGlobal" style="width: 400px !important;">Member</th>
                <th class="tblHeaderGlobal">Action</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="tab-pane" id="tabRejectedBill">
        <table id="tblRejectedReceipts" class="table-admin table compact">
            <thead>
            <tr>
                <th class="tblHeaderGlobal">ID</th>
                <th class="tblHeaderGlobal">Date</th>
                <th class="tblHeaderGlobal">Member</th>
                <th class="tblHeaderGlobal">Reason</th>
                <th class="tblHeaderGlobal">Action</th>
            </tr>
            </thead>
        </table>
    </div>
@stop

<div class="modal-view" id="mod" data-backdrop="static">
    <div  class="receipt_views" id='receipt_view'>
    </div>
</div>
