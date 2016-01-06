<?php
/**
 * Created by PhpStorm.
 * User: christian.labini
 * Date: 9/16/15
 * Time: 1:38 PM
 */
?>
@extends('user.admin.adminMainContainerLayout')

@section('meta')

{{ Theme::asset()->usePath()->add('js-ajaxForm', 'js/jquery.form.js') }}
{{ Theme::asset()->usePath()->add('js-maintenance-forex', 'js/maintenance/transperarate.js') }}
{{ Theme::asset()->usePath()->add('css-maintenance-forex', 'css/maintenance/forex.css') }}
@stop

@section('modal')
<h3 style="position: relative; top: -20px; color: black; left: -264px;">TRANSPERA RATE</h3>
<div class="btnaddmember-u"><img id="btnAddMatrix" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" style="float: left !important; padding-right: 10px; cursor: pointer;"/><span>ADD MATRIX</span></div>

<div class="tab-pane active" id="tabBank" data-id="3" style="margin-top: 43px">
    <div class="btn-add-maintain">
    </div>
    <table id="tblTransperaRate" class="table-admin" style="width: 1065px; !important;">
        <thead>
        <tr>
            <th class="tblHeaderGlobal" style="padding-left: 30px !important;">ID</th>
            <th class="tblHeaderGlobal">Currency From</th>
            <th class="tblHeaderGlobal">Currency To</th>
            <th class="tblHeaderGlobal">Base</th>
            <th class="tblHeaderGlobal">Ceilling</th>
            <th class="tblHeaderGlobal">Rate</th>
            <th class="tblHeaderGlobal" style="text-align: center;">Action</th>
        </tr>
        </thead>
    </table>
</div>
@stop
<style>
    #profile-caret {
        margin-top: 0 !important;
    }
    #MatrixRate, #MatrixRateEdit,#Ceilling, #CeillingEdit,#Base, #BaseEdit{text-align: right}
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
    #MatrixEntryForm label,#myModalEditMatrix label{
        position: absolute;
    }
    #myModalAddMatrix #Base,
    #myModalAddMatrix #Ceilling,
    #myModalAddMatrix #MatrixRate,
    #myModalAddMatrix #baseCurrency,
    #myModalAddMatrix #baseCurrencyTo,
    #myModalEditMatrix #BaseEdit,
    #myModalEditMatrix #CeillingEdit,
    #myModalEditMatrix #MatrixRateEdit,
    #myModalEditMatrix #baseCurrencyEditTo,
    #myModalEditMatrix #baseCurrencyEdit{
        color: #555;
    }
    #search-box{
        bottom: -26px;
    }
    .table-admin thead th, .table-admin thead {
        background-color: #0a94bb !important;
        color: #ffffff !important;
    }
    .unique-matrix { text-align: center; color: red; }
</style>

<div class="modal fade" id="myModalAddMatrix" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Matrix</h4>
            </div>
            <div id="errorDivmodalForex" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'MatrixEntryForm','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/matrix/add')) }}
            <br>
            <br>
            <div class="unique-matrix"></div>
            {{ Form::select('baseCurrency', $baseCurrency,'',['class' => 'form-control reg-corners drop ','id'=>'baseCurrency','maxlength'=>'4']) }}
            <br>
            {{ Form::select('baseCurrencyTo', $baseCurrencyTo,'',['class' => 'form-control reg-corners drop ','id'=>'baseCurrencyTo','maxlength'=>'4']) }}
            <br>
            {{ Form::text('Base', Input::get('Base'),['class' => 'form-control input-sm txtboxNumberOnly','placeholder' => 'Base','id'=>'Base','maxlength'=>'12']) }}
            <br>
            {{ Form::text('Ceilling', Input::get('Ceilling'),['class' => 'form-control input-sm txtboxNumberOnly','placeholder' => 'Ceilling','id'=>'Ceilling','maxlength'=>'12']) }}
            <br>
            {{ Form::text('MatrixRate', Input::get('MatrixRate'),['class' => 'form-control input-sm numberOnly','placeholder' => 'Transpera Rate','id'=>'MatrixRate','maxlength'=>'12']) }}


            <div class="modal-footer" style="padding: 3% 15%;">
                <div class="row marLef">
                    {{ Form::submit('SAVE',array( 'class' => 'btn confirm','id'=>'saveMatrix')) }}
                    <input id="btncanceladdMatrix" name="cancelMatrix" type="button" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>


<div class="modal fade" id="myModalEditMatrix" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Matrix</h4>
            </div>
            <div id="errorDivmodalForex" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'MatrixEditForm','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/matrix/edit')) }}
            <br>
            <br>
            <div class="unique-matrix"></div>
            {{ Form::hidden('matrixId','' ,['class' => 'form-control reg-corners drop ','id'=>'matrixId','maxlength'=>'4']) }}
            <br>
            {{ Form::select('baseCurrencyEdit', $baseCurrency,'',['class' => 'form-control reg-corners drop ','id'=>'baseCurrencyEdit','maxlength'=>'4']) }}
            <br>
            {{ Form::select('baseCurrencyTo', $baseCurrencyTo,'',['class' => 'form-control reg-corners drop ','id'=>'baseCurrencyEditTo','maxlength'=>'4']) }}
            <br>
            {{ Form::text('BaseEdit', Input::get('BaseEdit'),['class' => 'form-control input-sm txtboxNumberOnly','placeholder' => 'Base','id'=>'BaseEdit','maxlength'=>'12']) }}
            <br>
            {{ Form::text('CeillingEdit', Input::get('CeillingEdit'),['class' => 'form-control input-sm txtboxNumberOnly','placeholder' => 'Ceilling','id'=>'CeillingEdit','maxlength'=>'12']) }}
            <br>
            {{ Form::text('MatrixRateEdit', Input::get('MatrixRateEdit'),['class' => 'form-control input-sm numberOnly','placeholder' => 'Transpera Rate','id'=>'MatrixRateEdit','maxlength'=>'12']) }}


            <div class="modal-footer" style="padding: 3% 13%">
                <div class="row" >
                    {{ Form::submit('UPDATE',array( 'class' => 'btn confirm','id'=>'updateMatrix')) }}
                    <input id="btncanceladdForex" name="cancelMatrix" type="button" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>