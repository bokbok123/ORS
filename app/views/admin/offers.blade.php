@extends('user.admin.adminMainContainerLayout')

@section('meta')

{{ Theme::asset()->usePath()->add('css-offers', 'css/user/offers.css') }}
{{ Theme::asset()->usePath()->add('css-maintenance-billcategory', 'css/user/filtering.css') }}
{{ Theme::asset()->usePath()->add('js-offers', 'js/user/offers.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.colorbox-min', 'js/jquery.colorbox-min.js') }}

@stop

@section('hidden')
{{ Form::text('offerId',"0", array('id' => 'offerId', 'class' => 'form-control offer-id')) }}
@stop

@section('nav-tabs')
<li class="active">
    <a href="#tabBank" data-toggle="tab" class="tabb">Offers</a>
</li>
@stop

@section('tabs')
<style>
    #offer_instruction, #editoffer_instruction {
        height: 332px;
        max-height: 300px;
        overflow: auto;}
    #modalofferfooter {
        margin-top: 363px;
    }
    #labelofferinstruction {
        margin-left: 65px;
        margin-top: 10px;
    }
    .second-container {
        margin-left: 100px;
    }
    .dataTables_wrapper .dataTables_paginate {
        float: right;
        text-align: right;
        padding-top: 1.25em;
    }
    #thofferaction {
        width: 150px !important;
    }
    #search-box{
        top: 97px;
    }
    .dropdownDiv {
        margin-top: -10px;
        padding-left: 0;
        left: 25.1%;
    }
    .btnaddmember-u{
        /*top: 18%;*/
    }
    .table-admin thead th, .table-admin thead {
        background-color: #0a94bb !important;
        color: #ffffff !important;
    }
</style>
<h3 style="position: relative; top: -20px; color:  #000000;">OFFERS</h3>
<div class="btn-group dropdownDiv">
    <button id="filterActive" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        All
    </button>
    <ul class="dropdown-menu" style="width: 95%">
        <li><a data-id="2" class="filter_c" href="#" data-value="All">All</a></li>
        <li><a data-id="1" class="filter_c" href="#" data-value="Active">Active</a></li>
        <li><a data-id="0" class="filter_c" href="#" data-value="Inactive">Inactive</a></li>
    </ul>

</div>
<div class="btnaddmember-u"><img id="open" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" style="float: left !important; padding-right: 10px; cursor: pointer;"/><span>ADD OFFER</span></div>
<div class="row">
    <div class="tab-pane active" id="admin_settings">
        <table id="tblOffers" class="table-admin tableOffer display">
            <thead>
                <tr>
                    <th class="tblHeaderGlobal">Offer ID</th>
                    <th class="tblHeaderGlobal">Biller ID</th>
                    <th class="tblHeaderGlobal" >Offer Description</th>
                    <th class="tblHeaderGlobal">Offer Instruction</th>
                    <th class="tblHeaderGlobal">Points</th>
                    <th class="tblHeaderGlobal">Link</th>
                    <th class="tblHeaderGlobal">Date Expired</th>
                    <th class="tblHeaderGlobal" id="thofferaction">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@stop

@section('modal')
<div class="modal-body">

</div>

<div class="modal fade" id="myModaladdoffer" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="margin:100px 20% !important;">
        <form action="#" method="post" id="submit-offers" autocomplete="off">
        <div class="modal-content col-md-12" id="modaloffer">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Offer</h4>
            </div>
            <div id="errorDivmodalbank" class="col-md-12">

            </div>
            <div id="x"></div>

                <div class="first-container">
                    <div class="form-group row" style="margin-top: 40px;">
                        <label for="contact-email" class="col-md-4 control-label">Biller:</label>
                        <div class="col-lg-6">
                            {{ Form::select('biller',$billerList,'',array('class'=>'form-control input-sm offer-des','id' => 'biller','style' => ' width: 279px !important;')) }}                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact-email" class="col-md-4 control-label">Description:</label>
                        <div class="col-lg-6">
                            {{ Form::textarea('description', Input::old('description'), array('id' => 'description','rows'=>'2','rows'=>'2','maxlength'=>'500', 'class' => 'form-control offer-des')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact-email" class="col-md-4 control-label">Date Expired:</label>
                        <div class="col-md-6">
                            {{ Form::text('dateexpired', '', array('id' => 'dateexpired', 'class' => 'form-control txtboxNumberOnly offer-des dateexpired', 'data-date-format' => 'yyyy-mm-dd' ,'readonly'=>'true', 'maxlength' => 10, 'style' => 'cursor: pointer; background-color: #fff;')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact-email" class="col-md-4 control-label">Points:</label>
                        <div class="col-md-6">
                            {{ Form::text('points', Input::old('points'), array('id' => 'points', 'class' => 'form-control numForPoint offer-des', 'maxlength' => 5)) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact-email" class="col-md-4 control-label">Link:</label>
                        <div class="col-md-6">
                            {{ Form::text('link', Input::old('link'), array('id' => 'link', 'class' => 'form-control offer-des')) }}
                        </div>
                    </div>
                    <div class="form-group row" style="height: 70px; padding-bottom: 0px; margin-top: 7%; width: 120%; margin-left: 4%">
                        <input id="cancelOffer" type="reset" class="btn btn-fb-cancel btncancel" data-dismiss="modal" value="CANCEL" style="margin-right: 6%">
                        <button id="saveOffer" class="btn btn-fb btn-large">SAVE</button>
                    </div>
                </div>


                <div class="second-container">


                    <div class="form-group row">

                        <div class="col-md-12">
                            <label id="labelofferinstruction" for="contact-email" class="col-md-2 control-label">Instruction</label>
                            {{ Form::textarea('offer_instruction', '', array('id' => 'offer_instruction','maxlength'=>'500', 'class' => 'form-control offer-des','required')) }}
                        </div>

                    </div>

                </div>

            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="myModalEditoffer" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="margin:100px 20% !important;">
        <form action="#" method="post" id="submit-editoffers" autocomplete="off">
            <div class="modal-content col-md-12" id="modaloffer">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Offer</h4>
                </div>
                <div id="errorDivmodalbank" class="col-md-12">

                </div>
                <div id="x"></div>

                <div class="first-container">
                    <div class="form-group row" style="margin-top: 40px;">
                        <label for="contact-email" class="col-md-4 control-label">Biller:</label>
                        <div class="col-lg-6">
                            {{ Form::select('editbiller',$billerList,'',array('class'=>'form-control input-sm offer-des','id' => 'editbiller','style' => 'width: 270px ! important; height: auto;;')) }}                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact-email" class="col-md-4 control-label">Description:</label>
                        <div class="col-lg-6">
                            {{ Form::textarea('editdescription', Input::old('description'), array('id' => 'editdescription','maxlength' => '500','rows'=>'2','class' => 'form-control offer-des')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact-email" class="col-md-4 control-label">Date Expired:</label>
                        <div class="col-md-6">
                            {{ Form::text('dateexpired', '', array('id' => 'editdateexpired', 'class' => 'form-control txtboxNumberOnly offer-des dateexpired', 'data-date-format' => 'yyyy-mm-dd' ,'readonly'=>'true', 'maxlength' => 10, 'style' => 'cursor: pointer; background-color: #fff;')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact-email" class="col-md-4 control-label">Points:</label>
                        <div class="col-md-6">
                            {{ Form::text('points', Input::old('points'), array('id' => 'editpoints', 'class' => 'form-control numForPoint offer-des', 'maxlength' => 5)) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact-email" class="col-md-4 control-label">Link:</label>
                        <div class="col-md-6">
                            {{ Form::text('link', Input::old('link'), array('id' => 'editlink', 'class' => 'form-control offer-des')) }}
                        </div>
                    </div>
                    <div class="form-group row" style="height: 70px; padding-bottom: 0px; margin-top: 10%; width: 120%; margin-left: 4%">
                        <input id="cancelEditOffer" type="reset" class="btn btn-fb-cancel btncancel" data-dismiss="modal" value="CANCEL" style="margin-right: 6%">
                        <button id="saveEditOffer" class="btn btn-fb btn-large">SAVE</button>
                    </div>
                </div>


                <div class="second-container">


                    <div class="form-group row">

                        <div class="col-md-12">
                            <label id="labelofferinstruction" for="contact-email" class="col-md-2 control-label">Instruction</label>
                            {{ Form::textarea('offer_instruction', '', array('id' => 'editoffer_instruction','maxlength' => '500', 'class' => 'form-control offer-des','required')) }}
                        </div>

                    </div>

                </div>

            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="myModalinformation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin:260px 20% !important;">
        <div class="modal-content col-md-12" id="modaloffer" style="height:auto;">
            <div class="modal-body">
                <h4 style="text-align: center">Offer is already expired and could not be activated.</h4>
            </div>
        </div>
    </div>
</div>
@stop