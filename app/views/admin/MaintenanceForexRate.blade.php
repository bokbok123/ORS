@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('js-maintenance-forex', 'js/maintenance/forex.js') }}
{{ Theme::asset()->usePath()->add('css-maintenance-forex', 'css/maintenance/forex.css') }}
{{ Theme::asset()->usePath()->add('js-ajaxForm', 'js/jquery.form.js') }}
@stop

@section('modal')
<h3 style="position: relative; top: -20px; color: black; left: -264px;">FOREX RATE</h3>
<div class="btnaddmember-u" style="display: none"><img id="btnAddForex" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" style="float: left !important; padding-right: 10px; cursor: pointer;"/><span>ADD FOREX</span></div>

<div class="tab-pane active" id="tabBank" data-id="3" style="margin-top: 43px">
    <div class="btn-add-maintain">
    </div>
    <table id="tblForex" class="table-admin"  style="width: 1065px !important;">
        <thead>
        <tr>
            <th class="tblHeaderGlobal" >ID</th>
            <th class="tblHeaderGlobal">Forex A</th>
            <th class="tblHeaderGlobal">Forex B</th>
            <th class="tblHeaderGlobal">Rate</th>
            <th class="tblHeaderGlobal">Last Update</th>
            <th class="tblHeaderGlobal" >Action</th>
        </tr>
        </thead>
    </table>
</div>
@stop
<style>
    #profile-caret {margin-top: 0 !important;}
    #forexRateEdit, #forexRate{text-align: right}
    ::-webkit-input-placeholder {
        text-align: left;
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
    #search-box{
        bottom: -26px;
    }
    #imgContainer{
        height: 150px ;
        margin-bottom: 0;
        padding: 0;

    }
    div.fileinput {
        float: none;
        margin: 0 auto;
        width: 50%;
    }
    .btn-default2 {
        font-weight: bolder;
        margin-right: 0;
        width: 100% !important;
        height: 45px;
    }
    .table-admin thead th, .table-admin thead {
        background-color: #0a94bb !important;
        color: #ffffff !important;
    }

</style>

<div class="modal fade" id="myModalAddForex" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Forex</h4>
            </div>
            <div id="errorDivmodalForex" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'ForexEntryForm','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/forex/add')) }}
            <br>
            <br>
            {{ Form::select('baseCurrency', $baseCurrency,'',['class' => 'form-control reg-corners drop','id'=>'baseCurrency','maxlength'=>'4']) }}
            <br>
            {{ Form::select('targetCurrency', $targetCurrency,'',['class' => 'form-control reg-corners drop ','id'=>'targetCurrency','maxlength'=>'4']) }}
            <br>
            {{ Form::text('forexRate', Input::get('forexRate'),['class' => 'form-control input-sm numberOnly','placeholder' => 'Forex Rate','id'=>'forexRate','maxlength'=>'12']) }}

            <br/>
            <div class="modal-footer">
                <div class="row marLef">
                    {{ Form::submit('SAVE',array( 'class' => 'btn confirm','id'=>'savebiller')) }}
                    <input  type="button" name="cancelBiller" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="myModalEditForex" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Forex</h4>
            </div>
            <div id="errorDivmodalForex" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'ForexEditForm','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/forex/edit')) }}
            <br>
            <br>
            {{ Form::hidden('forexId','' ,['class' => 'form-control reg-corners drop ','id'=>'forexId','maxlength'=>'4']) }}
            {{ Form::select('baseCurrencyEdit', $baseCurrency,'',['class' => 'form-control reg-corners drop ','disabled','id'=>'baseCurrencyEdit','maxlength'=>'4']) }}
            <br>
            {{ Form::select('targetCurrencyEdit', $targetCurrency,'TAI',['class' => 'form-control reg-corners drop ','disabled','id'=>'targetCurrencyEdit','maxlength'=>'4']) }}
            <br>
            {{ Form::text('forexRateEdit', Input::get('forexRateEdit'),['class' => 'form-control input-sm numberOnly','autocomplete'=>'off','placeholder' => 'Forex Rate','id'=>'forexRateEdit','maxlength'=>'12']) }}

            <br/>
            <div class="modal-footer">
                <div class="row marLef">
                    {{ Form::submit('UPDATE',array( 'class' => 'btn confirm','id'=>'updateForex')) }}
                    <input name="cancelforex"  type="button" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

