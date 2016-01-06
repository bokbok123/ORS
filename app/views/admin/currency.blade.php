@extends('user.admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('js-maintenance-forex', 'js/maintenance/forex.js') }}
{{ Theme::asset()->usePath()->add('css-maintenance-forex', 'css/maintenance/forex.css') }}
{{ Theme::asset()->usePath()->add('js-ajaxForm', 'js/jquery.form.js') }}
@stop

@section('modal')
<h3 style="position: relative; top: -20px; color: rgb(1, 82, 66); left: -264px;">Country</h3>
<div class="btnaddmember-u"><img id="btnAddCountry" class="icons" src="<?php echo Theme::asset()->url('img/add_button.png'); ?>" style="float: left !important; padding-right: 10px; cursor: pointer;"/><span>ADD COUNTRY</span></div>

<div class="tab-pane active" id="tabBank" data-id="3" style="margin-top: 43px">
    <div class="btn-add-maintain">
    </div>
    <table id="tblCurrency" class="table-admin"  style="width: 1065px !important;">
        <thead>
        <tr>
            <th class="tblHeaderGlobal" >ID</th>
            <th class="tblHeaderGlobal">Country Code</th>
            <th class="tblHeaderGlobal">Country Name</th>
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
    #country_logo {
        height: 92%;
        margin: 0 -2%;
        position: absolute;
        top: 0;
        width: 47%;
    }
    #myModalAddCountry label{
        position: absolute;
        font-weight: normal;
    }
    #country_logo-error{
        bottom: 50px;
        left: 38%;
    }
    #unique-error { text-align: center; color: red; }
</style>


<!--added by ajei-->
<div class="modal fade" id="myModalAddCountry" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Currency</h4>
            </div>
            <div id="errorDivmodalbiller" class="col-md-12">

            </div>
            <div id="x"></div>
            <div id="unique-error"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'AddCountryForm','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/forex/countrysave')) }}
            <!--            <br>-->
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="fileinput fileinput-new" data-provides="fileinput" >
                        <div class="fileinput-preview thumbnail filepreview" data-trigger="fileinput" id="imgContainer">
                            <img src="#" id="preview_image">
                        </div>
                        <div>

                            <div class="warning"></div>

									<span class="btn btn-default2 btn-file">
										<input type="file" name="country_logo" id="country_logo" size="60" accept="image/*">
                                        <img class="btnChange"
                                             src="<?php echo Theme::asset()->url('img/changeprofpic.png'); ?>"/>
                                            <span class="textProfChange">Select Country logo</span>
                                        <input type="hidden" value="0" name="country_logo_value" id="country_logo_value" >
									</span>
                            <span class="errorimage"></span>



                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="country_name" id="countryName" maxlength="50" placeholder="Country Name" value="" class="form-control input-sm alphaOnly"/>
                </div>

            </div>
            <span class="errorCountryName"></span>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="country_code" id="countryCode" maxlength="50" value="" placeholder="Country Code" class="form-control input-sm alphaOnly"/>
                </div>
            </div>
            <span class="errorCountryCode"></span>
            <br>
            <div class="modal-footer">
                <div class="row marLef">
                    <input id="savecountry" type="submit" name="savecountry" class="btn confirm" value="SAVE"/>
                    <input id="btncanceladdcountry" type="button" name="btncanceladdcountry" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="myModalEditCountry" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Currency</h4>
            </div>
            <div id="errorDivmodalbiller" class="col-md-12">

            </div>
            <div id="x"></div>
            {{ Form::open(array('method' => 'POST', 'files' => true,'id'=>'EditCountryForm','enctype'=>'multipart/form-data','url'=>'/admin/maintenance/forex/editcountrysave')) }}
            <!--            <br>-->
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="fileinput fileinput-new" data-provides="fileinput" s>
                        <div class="fileinput-preview thumbnail filepreview" data-trigger="fileinput" id="imgContainer">
                            <img src="#" id="preview_imageEdit">
                        </div>
                        <div>

                            <div class="warning"></div>
                                    <input type="hidden" id="countryId" name="countryId">
									<span class="btn btn-default2 btn-file">
										<input type="file" name="country_logoEdit" id="country_logoEdit" size="60" accept="image/*">
                                        <img class="btnChange"
                                             src="<?php echo Theme::asset()->url('img/changeprofpic.png'); ?>"/>
                                            <span class="textProfChange">Select Country logo</span>
                                        <input type="hidden" value="0" name="country_logo_value" id="country_logo_value" >
									</span>
                            <span class="errorimage"></span>



                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="countryNameEdit" id="countryNameEdit" maxlength="50" placeholder="Country Name" value="" class="form-control input-sm"/>
                </div>

            </div>
            <span class="errorCountryName"></span>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="countryCodeEdit" id="countryCodeEdit" maxlength="50" value="" placeholder="Country Code" class="form-control input-sm"/>
                    <input type="hidden" name="countryCodeEditH" id="countryCodeEditH" maxlength="50" value="" placeholder="Country Code" class="form-control input-sm"/>
                </div>
            </div>
            <span class="errorCountryCode"></span>
            <br>
            <div class="modal-footer">
                <div class="row marLef">
                    <input id="saveEditcountry" type="submit" name="savecountry" class="btn confirm" value="SAVE"/>
                    <input id="btncanceladdcountry" type="button" name="btncanceladdcountry" class="btn btn-default custom-default btn-fb-cancel" data-dismiss="modal" value="CANCEL"/>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
