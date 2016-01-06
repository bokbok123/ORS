@extends('admin.adminMainContainerLayout')

@section('meta')
{{ Theme::asset()->usePath()->add('css-user-member', 'css/user/member.css') }}
{{ Theme::asset()->usePath()->add('css-isloading', 'css/isloading.css') }}
{{ Theme::asset()->usePath()->add('js-user-index', 'js/user/index.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.isloading', 'js/jquery.isloading.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.isloading.min', 'js/jquery.isloading.min.js') }}



@stop

@section('nav-tabs')
<style>
    .dropdownDiv {
        padding-bottom: 10px;
        right: 56.8%;
        width: 18%;
    }
    .btnaddmember-u {
        position: absolute;
        right: 0;
    }
    .btnaddmember-u span{
        display: inline-block;
        vertical-align: middle;
        color: #252525;
        padding-top: 4px;
        font-size: 17px;
    }
    #tblReject th:last-child, #tblReject th:last-child{
        width: 21% !important;
    }
    .iviewer_print{margin-left: 15px !important;}
    .iviewer_download{margin-left: 90px;}
    .iviewer_zoom_in{margin-left: 150px !important;}
    .iviewer_zoom_out{margin-left: 190px !important;}
    .iviewer_zoom_fit{margin-left: 200px !important;}
    .iviewer_rotate_left {margin-left: 180px !important;}
    .iviewer_rotate_right {margin-left: 220px !important;}

    .table-admin thead th, .table-admin thead {
        background-color: #0a94bb !important;
        color: #ffffff !important;
    }

</style>

<!-- ADD MEMBER MODAL -->
<form id="FormAddUser" method="post" enctype="multipart/form-data" style="margin: 0px 50px 0px 50px;">
    <div class="modal fade" id="addNewMemberModal" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content modal-content-custom" id="addbillmodal">
                <div class="modal-header modal-header-add" style="height: 66px;">
                    <span class="msg label-color" id="p-select">ADD USER</span>

                    <div class="form-group">
                    </div>
                </div>
                <div class="modal-body" style="padding-left: 80px !important;padding-right: 80px !important;" id="divForm">
                    <div class="form-group">
                    </div>

                    <div class="column-user">
                        <div class="column-left">
                            Title
                        </div>
                        <div class="column-center">
                            {{ Form::select('salutation', array( '' => 'Select', 'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Ms.' => 'Ms.'),'', array('class' =>'form-control reg-corners salutation', 'style' => 'color: #555 !important ')) }}
                        </div>
                        <div class="column-right title">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
                            First Name
                        </div>
                        <div class="column-center">
                            {{ Form::text('fname', Input::old('fname'), array('class'=>'auto-cap form-control required-input2 reg-corners alphaOnly','maxlength'=>'50','autocomplete'=>'off' )); }}
                        </div>
                        <div class="column-right fname">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
                            Middle Name
                        </div>
                        <div class="column-center">
                            {{ Form::text('mname', Input::old('mname'), array('class'=>'auto-cap form-control
                            reg-corners alphaOnly','maxlength'=>'50','autocomplete'=>'off' )); }}
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
                            Last Name
                        </div>
                        <div class="column-center">
                            {{ Form::text('lname', Input::old('lname'), array('class'=>'auto-cap form-control
                            reg-corners required-input2 alphaOnly','maxlength'=>'50','autocomplete'=>'off' )); }}
                        </div>
                        <div class="column-right lname">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
                            Username
                        </div>
                        <div class="column-center">
                            {{ Form::text('user_username', Input::old('user_username'), array('id'=>'user_username','placeholder'=>'',
                            'class'=>'noSpacing zpass form-control reg-corners required-inputz','maxlength'=>'20','minlength'=>'6','autocomplete'=>'off')); }}
                        </div>
                        <div class="column-right username">
                            *
                        </div>
                    </div>
                    <div class="column-user">
                        <div class="column-left">
                            Country
                        </div>
                        <div class="column-right role">
                            *
                        </div>
                    </div>
                    <div class="column-user">
                        <div class="column-left">
                            User Role
                        </div>
                        <div class="column-center">
                            {{ Form::select('user_role', array('' => 'Select', '1' => 'Admin', '3' => 'BPO', '4' => 'Accountant'),'', array('class' =>'form-control reg-corners chosen-select user_role', 'style' => 'color: #555 !important ')) }}
                        </div>
                        <div class="column-right role">
                            *
                        </div>
                    </div>

                    <div class="column-user">
                        <div class="column-left">
<!--                            Email Address-->
                        </div>
                        <div class="column-center">
                            {{--{{ Form::text('user_email', Input::old('user_email'), array('id'=>'user_email','class'=>'form-control
                            reg-corners required-input2','maxlength'=>'30','autocomplete'=>'off')); }}--}}
                        </div>
                        <div class="column-right email">
                            *
                        </div>
                    </div>

                    <div class="column-user" style="display:none">
                        <div class="column-left">
                            Password
                        </div>
                        <div class="column-center">
                            {{ Form::password('password', array('id'=>'password','class'=>' zpass form-control reg-corners required-inputz','maxlength'=>'50','autocomplete'=>'off' )); }}
                        </div>
                        <div class="column-right newpassword">
                            *
                        </div>
                    </div>

                    <div class="column-user" style="display: none;">
                        <div class="column-left">
                            Confirm Password
                        </div>
                        <div class="column-center">
                            {{ Form::password('password_confirmation', array('id'=>'confirmNewPassword','maxlength'=>'50','class'=>' zpass form-control reg-corners required-inputz','autocomplete'=>'off' )); }}
                        </div>
                        <div class="column-right passwordconfirm">
                            *
                        </div>
                    </div>
                    <div class="column-user" id="errorNotif">
                        <center>
                            <span class="error"  style="margin-left: -4px;"></span>
                        </center>
                    </div>

                </div>
                <div id="footeraddbill" class="txtaligncenter" style="padding:0 85px 27px;">
                    <input
                        class="btn btn-fb-cancel" name="btnSub" data-dismiss="modal"
                        type="button" value="CANCEL">
                    <input id="btnSubmitUser" style="margin-left: 5%"
                           class="btn btn-fb" name="btnSub"
                           type="button" value="CREATE">
                </div>
</form>
</div>
</div>
</div>

<!-- SUCCESS MODAL -->
<div class="modal fade" id="MemberAddedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="margin: 200px auto !important;">
        <div class="modal-content modal-no-delete">
            <div class="">
                <div class="modal-title select-title" id="title-bottom">Member Added
                </div>
            </div>
        </div>
    </div>
</div>

<li class="active">
    <a href="#tabMembers" id="members" role="tab" data-toggle="tab" class="tabb">
        Members
    </a>
</li>
<!--<li class="">-->
<!--    <a href="#tabReview" id="review" role="tab" data-toggle="tab" class="tabb">Reviewed</a>-->
<!--</li>-->
<!--<li class="">-->
<!--    <a href="#tabRejected" id="rejected" role="tab" data-toggle="tab" class="tabb">Rejected</a>-->
<!--</li>-->

@stop

@section('tabs')
{{ Theme::asset()->usePath()->add('css-adminmenu', 'css/bpo/index.css') }}

<div class="tab-pane active" id="tabMembers" data-id="1">
    <div class="btn-group dropdownDiv">
        <button id="filterActive" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            All
        </button>
        <ul class="dropdown-menu">
            <li><a data-id="2" class="filter_c" href="#" data-value="All">All</a></li>
            <li><a data-id="1" class="filter_c" href="#" data-value="Active">Active</a></li>
            <li><a data-id="0" class="filter_c" href="#" data-value="Deactivate">Inactive</a></li>
        </ul>

    </div>
    <div class="btnaddmember-u" id="btnAddMember" style="cursor: pointer; padding-top: 5px;"><img class="icons" src="<?php echo Theme::asset()->url('img/addbill.png'); ?>" style="float: left !important; padding-right: 10px;padding-top:4px; height: 30px;"/><button style="background: #0a94bb none repeat scroll 0 0;
    border: medium none;
    color: white;
    height: 36px;
    left: -2px;
    position: relative;
    top: -31px;
    width: 100%;">Add Users</button></div>
    <table id="tblActiveUsers" class="table-admin">
        <thead>
        <tr>
            <!--            <th class="tblHeaderGlobal"><input type="checkbox"/> </th>-->
            <th class="tblHeaderGlobal" >ID</th>
            <!--        style="padding-left: 30px !important;"    <th class="tblHeaderGlobal"></th>-->
            <th class="tblHeaderGlobal">First Name</th>
            <th class="tblHeaderGlobal">Last Name</th>
            <th class="tblHeaderGlobal">Email</th>
            <th class="tblHeaderGlobal">User Name</th>
            <th class="tblHeaderGlobal">Status</th>
            <th class="tblHeaderGlobal">Type</th>
            <th class="tblHeaderGlobal" ></th>
            <th class="tblHeaderGlobal">Action</th>
        </tr>
        </thead>
    </table>
</div>
<div class="tab-pane" id="tabReview" data-id="2" style="padding-top: 43px;">
    <table id="tblForReview" class="table-admin">
        <thead>
        <tr>
            <th class="tblHeaderGlobal">ID</th>
            <!--            <th class="tblHeaderGlobal"></th>-->
            <th class="tblHeaderGlobal">First Name</th>
            <th class="tblHeaderGlobal">Last Name</th>
            <th class="tblHeaderGlobal">Email</th>
            <th class="tblHeaderGlobal">User Name</th>
            <th class="tblHeaderGlobal">Status</th>
            <th class="tblHeaderGlobal">Action</th>
        </tr>
        </thead>
    </table>
</div>
<div class="tab-pane" id="tabRejected" data-id="3" style="padding-top: 43px;">
    <table id="tblReject" class="table-admin">
        <thead>
        <tr>
            <th class="tblHeaderGlobal">ID</th>
            <!--            <th class="tblHeaderGlobal"></th>-->
            <th class="tblHeaderGlobal">First Name</th>
            <th class="tblHeaderGlobal">Last Name</th>
            <th class="tblHeaderGlobal">Email</th>
            <th class="tblHeaderGlobal">User Name</th>
            <th class="tblHeaderGlobal">Status</th>
            <th class="tblHeaderGlobal" >Action</th>
        </tr>
        </thead>
    </table>
</div>
</div>
@stop

@section('modal')
<div class="modal-view" id="mod" data-backdrop="static">
    <div class="row bill_view" id='bill_view'>
        <div class="modal-header" id="preload">
            <h3 align='center'>Member's Details</h3>
        </div>
        <div class="modal-body">
            <table align='center' id="billsview">
                <tr>
                    <td colspan='3' id="td_Name" align="center"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Email:</td>
                    <td class="" id="td_Email"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Mobile:</td>
                    <td class="" id="td_Mobile"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Home:</td>
                    <td class="" id="td_Home"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Office:</td>
                    <td class="" id="td_Office"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Address 1:</td>
                    <td class="" id="td_Add1"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Address 2:</td>
                    <td class="" id="td_Add2"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>City:</td>
                    <td class="" id="td_City"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Region:</td>
                    <td class="" id="td_Region"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Postal Code:</td>
                    <td class="" id="td_Postal"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Country:</td>
                    <td class="" id="td_Country"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Date of Birth:</td>
                    <td class="" id="td_DoB"></td>
                </tr>
                <tr>
                    <td class="" colspan='2'>Status:</td>
                    <td class="" id="td_Status"></td>
                </tr>

            </table>
            <table>
                <tr id="buttonRow">
                    <td id="btn1"></td>
                    <td id="btn2"></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>
@stop


<div class="modal fade" id="kycContentModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
    <div class="modal-dialog modal-sizeBig" >
        <div class="modal-content no-aura confirmation modal-content-Big1">
            <div class="modal-header" id="modal-headerpay" style="height: 55px;">
                <span class="msg label-color" id="p-select">KYC VIEW</span>
                <input class="btn-close-addmanual" type="image"
                       src="<?php echo Theme::asset()->url('img/cancel-modal.png'); ?>" data-dismiss="modal" data-reload="no" aria-hidden="true">
            </div>
            <div class="modal-body Kyc-Modal-Body">
                <div class="addbill_head"></div>
                <div class="div-select-addbill">
                    <div class="kycBtnDiv row">
                        <input type="hidden" id="lou" name="id">

                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators" style="display: none">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li class="li3ol"data-target="#myCarousel" data-slide-to="2"></li>

                            </ol>

                            <!-- Wrapper for slides -->

                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="li1 col-md-8 col-md-offset-2">
                                        <div class="transZindex" style="position: absolute; height: 100%; z-index: 9999; display: block; left: 0%; width: 100%;"></div>
                                        <div class="imgPlace viewer"></div>
                                        <div id="actionButtonBar"></div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="li2 col-md-8 col-md-offset-2">
                                        <div class="transZindex2" style="position: absolute; height: 100%; z-index: 9999; display: block; left: 0%; width: 100%;"></div>
                                        <div class="imgPlace viewer"></div>
                                        <div id="actionButtonBar"></div>
                                    </div>
                                </div>

                                <div class="item itemli3">
                                    <div class="li3 col-md-8 col-md-offset-2">
                                        <div class="transZindex3" style="position: absolute; height: 100%; z-index: 9999; display: block; left: 0%; width: 100%;"></div>
                                        <div class="imgPlace viewer"></div>
                                        <div id="actionButtonBar"></div>
                                    </div>
                                </div>

                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="carouselControl"><img src="{{ URL::to('img/chevron-left.png') }}" style="height: 40px" /></span>
<!--                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
<!--                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
                                <span class="carouselControl"><img src="{{ URL::to('img/chevron-right.png') }}" style="height: 40px" /></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="viewUploadModalApprovedKyc" data-backdrop="static" class="modal fade" role="dialog">
    <div class="modal-dialog modalContentSuccess">

        <!-- Modal content-->
        <div class="modal-content ">

            <div class="modal-body">
                <p class="successAddReloadBody">Approved</p>
            </div>
            <div class="modal-footer modalFooterSuccess">
                <button type="button" class="btn btn-default btnSuccess" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="viewUploadModalRejectedKyc" data-backdrop="static" class="modal fade" role="dialog">
    <div class="modal-dialog modalContentSuccess">

        <!-- Modal content-->
        <div class="modal-content ">

            <div class="modal-body">
                <p class="successAddReloadBody">Rejected</p>
            </div>
            <div class="modal-footer modalFooterSuccess">
                <button type="button" class="btn btn-default btnSuccess" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--END OF KYC REVIEW MODAL-->

<!--CSS FOR KYC VIEW MODAL-->
<style>
    .successAddReloadBody {
        color: #194940;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }
    .btn-default
    {
        background-color: #fff;
        background-image: none;
        background-size: auto auto;
        border: 2px solid #015242;
        border-radius: 5px !important;
        color: #015242;
        font-size: 14px;
        font-weight: bold;
        height: 40px;
        text-shadow: none;
        width: 138px;
    }
    .btn-close-kycView
    {
        position: absolute;
        right: 0;
        top: 0;
    }
    .modal-headerKyc {
        border-bottom: 5px solid #e5e5e5;
        height: 88px;
        min-height: 16.4286px;
        padding: 37px 8px 8px;
    }
    #kycContentModaldiv
    {
        background-clip: padding-box;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0;
        box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
        margin-left: -110px;
        margin-top: 205px !important;
        outline: 0 none;
        position: relative;
        width: 138%;
    }
    .kycBtnDiv li
    {
        text-align: center;
    }
    .li1, .li2, .li3{
        float: left;
        overflow: hidden !important;
        padding: 0;
    }
    #actionButtonBar {
        background: #33363d none repeat scroll 0 0;
        bottom: 0;
        height: 40px;
        left: 0;
        margin: 0 auto;
        width: 100%;
    }
    .carouselControl{position: relative; top: 104px;}

</style>