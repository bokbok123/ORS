@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('js-maintenance-forex', 'js/maintenance/forexMatrix.js') }}
{{ Theme::asset()->usePath()->add('css-maintenance-forex', 'css/maintenance/forexMatrix.css') }}
{{ Theme::asset()->usePath()->add('js-ajaxForm', 'js/jquery.form.js') }}
@stop

@section('modal')

<div class="btnadddata-u"><img id="btnAddData" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" style="float: left !important; padding-right: 10px; cursor: pointer;"/><span>ADD FOREX MATRIX</span></div>

<div class="tab-pane active" id="tabData" data-id="3">
    <div class="btn-add-maintain">
    </div>
    <table id="tblData" class="table-admin">
        <thead>
        <tr>
            <th class="tblHeaderGlobal">ID</th>
            <th class="tblHeaderGlobal">ForexA</th>
            <th class="tblHeaderGlobal">ForexB</th>
            <th class="tblHeaderGlobal">Rate</th>
            <th class="tblHeaderGlobal">Last Update</th>
            <th class="tblHeaderGlobal">Action</th>
        </tr>
        </thead>
    </table>
</div>
@stop


<div class="modal fade" id="myModalAddData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Forex</h4>
            </div>
            <div id="errorDivmodalData" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'ForexEntryForm','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/forex/add')) }}
            <br>
            <br>
            {{ Form::select('baseCurrency', $baseCurrency,'',['class' => 'form-control reg-corners drop ','id'=>'baseCurrency','maxlength'=>'4']) }}
            <br>
            {{ Form::select('targetCurrency', $targetCurrency,'',['class' => 'form-control reg-corners drop ','id'=>'targetCurrency','maxlength'=>'4']) }}
            <br>
            {{ Form::text('forexRate', Input::get('forexRate'),['class' => 'form-control input-sm ','placeholder' => 'Forex Rate','id'=>'forexRate','maxlength'=>'12']) }}


            <div class="modal-footer">
                <div class="row marLef">
                    {{ Form::submit('SAVE',array( 'class' => 'btn confirm','id'=>'savebiller')) }}
                    <input id="btncanceladdData" name="btncanceladdData" type="button" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="myModalEditData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Forex</h4>
            </div>
            <div id="errorDivmodalData" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'ForexEditForm','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/forex/edit')) }}
            <br>
            <br>
            {{ Form::hidden('forexId','' ,['class' => 'form-control reg-corners drop ','id'=>'forexId','maxlength'=>'4']) }}
            {{ Form::select('baseCurrencyEdit', $baseCurrency,'',['class' => 'form-control reg-corners drop ','id'=>'baseCurrencyEdit','maxlength'=>'4']) }}
            <br>
            {{ Form::select('targetCurrencyEdit', $targetCurrency,'TAI',['class' => 'form-control reg-corners drop ','id'=>'targetCurrencyEdit','maxlength'=>'4']) }}
            <br>
            {{ Form::text('forexRateEdit', Input::get('forexRateEdit'),['class' => 'form-control input-sm ','placeholder' => 'Forex Rate','id'=>'forexRateEdit','maxlength'=>'12']) }}


            <div class="modal-footer">
                <div class="row marLef">
                    {{ Form::submit('UPDATE',array( 'class' => 'btn confirm','id'=>'updateForex')) }}
                    <input id="btncanceladdData" name="btncanceladdData" type="button" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
