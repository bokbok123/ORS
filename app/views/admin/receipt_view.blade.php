{{ Theme::asset()->usePath()->add('css-magnifier', 'css/magnifier.css') }}
{{ Theme::asset()->usePath()->add('css-user-receipt_index', 'css/user/index.css') }}
{{ Theme::asset()->usePath()->add('css-user-receipt_view', 'css/user/receipt_view.css') }}
{{ Theme::asset()->usePath()->add('js-user-Event', 'js/Event.js') }}
{{ Theme::asset()->usePath()->add('js-user-Magnifier', 'js/Magnifier.js') }}
{{ Theme::asset()->usePath()->add('js-user-receipt_view', 'js/user/receipt_view.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.colorbox-min2', 'js/jquery.colorbox-min.js') }}

{{ Theme::asset()->usePath()->add('css-jquery-css', 'css/jquery-ui.css') }}
{{ Theme::asset()->usePath()->add('js-jquery-ui', 'js/jquery-ui.js') }}
{{ Theme::asset()->usePath()->add('js-global', 'js/global.js') }}
{{ Theme::asset()->usePath()->add('js-custom-global', 'js/custom-global.js') }}

{{ Theme::asset()->usePath()->add('js-jquery.mousewheel.min', 'js/jquery.mousewheel.min.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.iviewer', 'js/jquery.iviewer.js') }}

{{ Theme::asset()->usePath()->add('js-toastmessage', 'js/jquery.toastmessage-min.js') }}
{{ Theme::asset()->usePath()->add('css-toastmessage', 'css/jquery.toastmessage-min.css') }}

{{ Theme::asset()->usePath()->add('css-jquery.iviewer', 'css/jquery.iviewer.css') }}

{{ Theme::asset()->usePath()->add('css-isloading', 'css/isloading.css') }}
{{ Theme::asset()->usePath()->add('js-jquery.isloading', 'js/jquery.isloading.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.isloading.min', 'js/jquery.isloading.min.js') }}


<style>
    .btn-info:hover, .btn-info:focus {
        background-color: #015142 !important;
    }
    select.input-sm {
        height: 34px !important;
    }
</style>
<div class="billentryContainer">
<div class="tab-pane box-3" id="tabBillEntry">
    <h2 id="billHeader">Bill Entry</h2>


    <div id="formBorder">
        <div id="formDiv">
            {{ Form::open(array('method' => 'POST','id'=>'BillEntryForm')) }}
            {{ Form::hidden('rct_id', $rct_id,array('class'=>'form-control input-sm','readonly','id'=>'rct_id')) }}


            {{ Form::text('customerId', $userid,array('class'=>'form-control input-sm hidden','id'=>'customerId')) }}

            <table style="width: 490px;float: left;border: none !important;margin-top: 5px" class="table-billentry">
                <tr>

                    <td> {{ Form::text('customer', $CustomerList,array('class'=>'form-control input-sm
                        input-design','readonly')) }}
                    </td>
                </tr>


                <tr>

                    <td>
                        <div class="required">
                            <?php
                            try {
                                echo Form::select('category', $billerCategory, $selectedCategory, array('id' => 'categoryDrop', 'class' => 'form-control input-sm select-design', 'style' => 'color: #555'));
                            } catch (Exception $ww) {
                                echo Form::select('category', $billerCategory, 0 ,array('id' => 'categoryDrop','class'=>'form-control input-sm select-design', 'style' => 'color: #555'));
                            }
                            ?>
                        </div>
                    </td>
                </tr>

                <tr>

                    <td>
                        <div class="required">

                            <?php
                            try {
                                echo Form::select('biller', $billerList, $selectedBiller, array('class' => 'form-control input-sm select-design', 'id' => 'biller','style'=>'margin:0 auto !important; color: #555'));
                            } catch (Exception $ww) {
                                echo Form::select('biller',$billerList,0,array('class'=>'form-control input-sm select-design','id' => 'biller','style'=>'margin:0 auto !important; width: 320px !important; color: #555'));
                            }
                            ?>
                        </div>
                    </td>
                </tr>


                <tr>

                    <td>
                        <div class="required">
                        {{ Form::text('bill_accountnumber',$Status =='Save' ? '':Input::get('bill_accountnumber'),
                        array('placeholder'=>'Account Number','class' => 'form-control input-sm input-design numOnly','id' =>
                        'bill_accountnumber','maxlength'=>'30')) }}
                        </div>
                    </td>
                </tr>

                <tr>

                    <td>
                        <div class="required">
                            {{ Form::text('bill_transactionnumber',$Status =='Save' ?
                            '':Input::get('bill_transactionnumber'), array('placeholder'=>'Transaction Number','class' =>
                            'form-control input-sm input-design numOnly','id' => 'bill_transactionnumber','maxlength'=>'20')); }}
                        </div>
                    </td>
                </tr>

                <tr>

               <td>
                   <div class="required">
                       {{ Form::text('bill_amount',$Status =='Save' ? '':Input::get('bill_amount'), array('placeholder'=>'Bill Amount'
                        ,'class' => 'form-control input-sm input-design txtboxNumberOnly','id'=>'txtBillAmount','maxlength'=>'18')); }}
                   </div>
               </td>
                </tr>


<tr>

                <td>
                    <div class="required">
                        <input type="text" class="form-control input-sm input-design" id="dpDueDate" name="DueDate"
                               placeholder="Due Date" readonly>
                    </div>
                </td>
</tr>

                <tr>

                <td>
                    <div class="required">
                        <input type="text" class="form-control input-sm input-design" id="payDate" name="PayDate" readonly
                       placeholder="Pay Date"></td>
                    </div>
                </tr>
            </table>



            <img id="iviewer11" src="{{ URL::to($attachment) }}" style="display: none;">

            <div class="viewer2-margin">
                <div class="wrapper">
                    <div id="viewer2" class="viewer iviewer_cursor" style="overflow: hidden;height: 395px;top: 12px">
                        <div id="viewerBg">
                            &nbsp
                        </div>
                    </div>
                </div>
            </div>


            <br>



        </div>
    </div>
    <div class="low-container">
        <ul class="ul-lowcontainer">
            <li class="custom-inline"><a href="{{ URL::to('admin/biller/list') }}"
                                         class="btn btn-info btn-sm" id="btnCancel">CANCEL</a></li>
            <li class="custom-inline"><a data-id="{{ $rct_id }}" href="#inline2" id="btnReject"
                                         class="btn btn-danger btn-sm reject_inline">REJECT</a></li>
            <li class="custom-inline">
                <button type="submit" id="btnSave" class="btn btn-primary btn-sm btn_save">SAVE</button>
            </li>
        </ul>
    </div>
    {{Form::close()}}
</div>
</div>





<!--Modal for BPO Reject-->
<div class="modal fade bpoRejectModal" data-backdrop="static" id="bpoRejectModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirm Rejection</h4>
            </div>
            <div class="modal-body">
                <div id="preloader">
                </div>
                <div id="error" class="row "></div>
                <div class="row inline2_text">

                    <div class="col-md-10 col-md-offset-1 Reason_textbox">
                        <textarea cols="50" name="reason" rows="5" id="reason" class="form-control input-sm" placeholder="Reason for Rejecting"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row inline2_button">
                    <div class="col-sm-2 col-sm-offset-4 col-md-2 col-md-offset-4">
                        <a href="#inline3" onclick='reject_Yes()' id ="btnLoading" class="btn form-control btn-info btn-sm reject_inline2">Yes</a>
                    </div><div class="col-sm-2 col-md-2">
                        <a href="" onclick='reject()' id ="btnLoading1" class="btn form-control btn-danger btn-sm2">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







