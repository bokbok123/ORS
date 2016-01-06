{{ Theme::asset()->usePath()->add('css-user-view', 'css/user/view.css') }}
{{ Theme::asset()->usePath()->add('css-user-index', 'css/user/index.css') }}
{{ Theme::asset()->usePath()->add('js-user-view', 'js/user/view.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.colorbox-min', 'js/jquery.colorbox-min.js') }}

{{ Theme::asset()->usePath()->add('css-isloading', 'css/isloading.css') }}
{{ Theme::asset()->usePath()->add('js-jquery.isloading', 'js/jquery.isloading.js') }}
{{ Theme::asset()->usePath()->add('js-jquery.isloading.min', 'js/jquery.isloading.min.js') }}

<style>
    #tblUserTransactionFilter li {
        display: inline;
    }

    #profile-caret {
        margin-top: 0 !important;
    }
    #errorDiv{
        text-align: center;
    }
</style>

<input type="hidden" id="userID" value="{{ $id }} " />


<div class="nav row tab-content" id="div_menu">
	<div class="col-md-6" >
        <img class="Dashboard_" src="{{ URL::to('img/fonebayad/personal-icon.png') }}">
        <strong>
            <div class="p-details">
                <span style="text-transform: capitalize">{{$Name}}</span>
                <br>
                {{$MemberSince}}
                <br>
                <span id="memberType" class=''>{{$typeOfMembership}} </span>
                <br>
                @if($isActive=='Active')
                <span class="active">Activated</span>
                @endif @if($isActive=='Inactive')
                <span class="inactive">Deactivated</span>
                @endif
            </div>

		</strong>
	</div>
        <div class="f-right row col-md-6">

            <div class="d-inline col-md-4" style="display: none">
                <img class="DashboardB"  src="{{ URL::to('img/fonebayad/fonebayad.png') }}">

                {{--<div class="div_amount2" id="div_amount2">{{$ezicard}}</div>--}}
            </div>
            <div class="d-inline col-md-4" style="display: none"
                <img class="DashboardC"src="{{ URL::to('img/fonebayad/transcredit.png') }}">
                {{--<div class="div_amount3" id="div_amount3">{{$ezicredit}}</div>--}}
            </div>
            <div class="d-inline col-md-4" style="display: none">
                <img class="DashboardD" src="{{ URL::to('img/fonebayad/transperareward.png') }}">
                {{--<div class="div_amount4" id="div_amount4">{{$ezirewards}}</div>--}}
            </div>
        </div>
    </div>
<div class="view_menus menuWidth">
    <ul class="tabs  primary-nav" id="tabView">
        <li class="active tabs__item">
            <a href="#tabDetails" class="tabs__link" role="tab" data-toggle="tab">Details</a>
        </li>
        <li class="tabs__item">
            <a href="#tabAccounts" class="tabs__link" role="tab" data-toggle="tab">
                Accounts
                <span class="badge pull-right " id="badgeAccount"> {{ $cntAccount }}</span>
            </a>
        </li>

        <li class="tabs__item">
            <a href="#tabDevices" class="tabs__link" role="tab" data-toggle="tab">
                Devices
                <span class="badge pull-right" id="badgeDevice"> {{ $cntDevice }}</span>
            </a>
        </li>
        <li class="tabs__item">
            <a href="#tabBills" class="tabs__link" role="tab" data-toggle="tab">
                Bills
                <span class="badge pull-right" id="badgeBills"> {{ $cntBills }}</span>
            </a>
        </li>
        <li class="tabs__item">
            <a href="#tabTransaction" class="tabs__link" role="tab" data-toggle="tab">Transaction Log</a>
        </li>
    </ul>
</div>

<div class="tab-content marginTop20">
    <div class="tab-pane active" id="tabDetails">
        <div class="">
            <div id="errorDiv" class="row">
                @if ($Status =='SAVE')
                <div class="row alert alert-success" style="display: none;">
                    <label class="control-label" for="inputSuccess1">Files has been Sucessfully saved</label>
                </div>
                @endif @if ($Status =='ERROR')
                <div class="row alert alert-danger">
                    <label class="control-label" for="inputSuccess1"> @foreach ($Error_Message->all() as $error) {{ $error }} @endforeach </label>
                </div>
                @endif
            </div>
            <br/>
            <div class="row">
                <div class = "nava">
                    <ul id="statusMenu">
                        <li>
                            <a id = "drop" href='#' style="font-family: Arial, sans-serif; font-weight: bold;"> Change Status
                                <span class="caret"></span></a>
                            <ul id="statusSubMenu">
                                <li>
                                    <a href=# class="btn-activateUser" data-id='{{ $id }}'> Activate </a>
                                </li>
                                <li>
                                    <a href=# class="btn-deactivateUser" data-id='{{ $id }}'> Deactivate </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    {{ Form::open(array('url' => 'admin/users/view/'.$id, 'method' => 'POST','id'=>'submitMem')) }}
                    <div id="detailsRow1">
                        <div class="col-md-2">
                            <span id = "detailLabel"> Title </span>
                            <br>

                                {{ Form::text('user_salutation', $user['user_salutation'],array('size'=>'7', 'id' => 'user_salutation','maxlength'=>'3', 'required', 'class' => 'txtboxLetterOnly hidden', 'pattern' => '.{2,}')) }}
                            {{ Form::select('salutation', array( 'default' => 'Select', 'Mr.' => 'Mr', 'Mrs.' => 'Mrs', 'Ms.' => 'Ms'),$user['user_salutation'], array('id' => 'user_salutationDrop','class' =>'form-control reg-corners', 'style' => 'color: rgb(85, 85, 85) ! important; height: 30px; width: 146%;')) }}
                            <div id="validateSalutation" class="minlength-title"><span>2 to 3 characters minimum.</span></div>
                        </div>
                        <div class="col-md-2" id="firstName">
                            <span id = "detailLabel"> First Name </span>
                            <br>
                            {{ Form::text('user_fname', $user['user_fname'],array('size'=>'27', 'id' => 'user_fname','maxlength'=>'50', 'required', 'class' => 'txtboxLetterOnly'))}}
                            <div id="validateFname" class="minlength-fname"><span>1 characters minimum.</span></div>
                        </div>
                        <div class="col-md-2" id="lastName">
                            <span id = "detailLabel"> Last Name </span>
                            <br>
                            {{ Form::text('user_lname', $user['user_lname'],array('size'=>'28', 'id' => 'user_lname','maxlength'=>'50', 'required', 'class' => 'txtboxLetterOnly'))}}
                            <div id="validateLname" class="minlength-fname"><span>1 characters minimum.</span></div>
                        </div>
                        <div class="col-md-2" id="middleName">
                            <span id = "detailLabel"> Middle Name </span>
                            <br>
                            {{ Form::text('user_mname', $user['user_mname'],array('size'=>'27', 'id' => 'user_mname','maxlength'=>'50',  'class' => 'txtboxLetterOnly'))}}
                            <div id="validateMname" class="minlength-fname"><span>1 characters minimum.</span></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="detailsRow2">
                        <div class="col-md-2" id="streetNo">
                            <span id = "detailLabel"> Address</span>
                            <br>
                            {{ Form::text('user_address',$user['user_address'],array('size'=>'27', 'id' => 'user_streetnumber','maxlength'=>'100', 'required'))}}
                            <div id="validateStreetNo" class="minlength-fname"><span>5 characters minimum.</span></div>
                        </div>
                        <div class="col-md-2" id="city">
                            <span id = "detailLabel"> City </span>
                            <br>
                            {{ Form::text('user_city', $user['user_city'],array('size'=>'27', 'id' => 'user_city','maxlength'=>'100', 'required', 'class' => 'txtboxLetterOnly'))}}
                        </div>
                        <div class="col-md-2" id="country">
                            <span id = "detailLabel"> Country </span>
                            <br>
                            {{ Form::text('user_country', $user['user_country'],array('size'=>'27','readonly', 'id' => 'user_country','maxlength'=>'100', 'required', 'class' => 'txtboxLetterOnly'))}}
                        </div>
                        <div class="col-md-2" id="zip" >
                            <span id = "detailLabel"> Zip Code</span>
                            <br>
                            {{ Form::text('user_zip', $user['user_zip'],array('size'=>'27', 'id' => 'user_zip','maxlength'=>'10', 'required', 'class' => 'numOnly'))}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="detailsRow3">
                        <div class="col-md-2" id="email">
                            <span id = "detailLabel"> Email </span>
                            <br>
                            {{ Form::text('user_email', $user['user_email'],array('size'=>'27', 'id' => 'user_email','maxlength'=>'30', 'required', 'readonly'))}}
                        </div>
                        <div class="col-md-2" id="bday">
                            <span id = "detailLabel"> Birth Date </span>
                            <br>
                            <input type="text" class="form-control" id="dp1" required style="width: 89%" name="user_birthdate" value="{{ $user['user_birthdate']=="0000-00-00"?'':$user['user_birthdate'] }}" data-date-format="yyyy-mm-dd" placeholder="Birth Date">
                        </div>
                        <div class="col-md-2" id="mobilePhone">
                            <span id = "detailLabel"> Mobile Phone </span>
                            <br>
                            {{ Form::text('user_mobile', $user['user_mobile'],array('size'=>'27', 'id' => 'user_mobile','maxlength'=>'30',  'class' => 'txtboxNumberOnly')) }}
                            <div id="validateMobilePhone" class="minlength-fname"><span>7 characters minimum.</span></div>
                        </div>
                    </div>
                </div>

                <br>

            </div>
        </div>
        <div class="LowerBox">

            <div class="row ">
                <div id="detailsRow5">
                    <div class="col-md-2" id="pin">
                        <span id = "detailLabel"> User Name: </span>{{ Form::label('user_username', $user['user_username'])}}

                    </div>
                    <div class="col-md-2" id="userName">

                    </div>
                    <div class="col-md-2" id="password">

                        <input id ='tabDetailsField' type="hidden" name="user_password" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2  col-md-offset-10">{{ Form::submit('UPDATE',array( 'class' => 'btn btn-primary','id'=>'btnSave')) }}</div>
            </div>
            <br>
        </div>
    </div>
    {{Form::close()}}
    <div class="tab-pane " id="tabAccounts">
        <table id="tblUserAccounts" class="table-admin tables compact tblUserAccounts">
            <thead>
            <tr>
                <th class="th_left tbl-th-color">ID</th>
                <th class="tbl-th-color">Account Name</th>
                <th class="tbl-th-color">Account Type</th>
                <th class="tbl-th-color">Currency</th>
                <th class="tbl-th-color">Balance</th>
                <th class="tbl-th-color">Bank Name</th>
                <th class="tbl-th-color">Branch</th>
                <th class="th_right tbl-th-color">Action</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="tab-pane " id="tabPortfolio">
        <table id="tblUserPortfolio" class="table-admin tables compact">
            <thead>
            <tr>
               <th class="th_left tbl-th-color">ID</th>
               <th class="tbl-th-color">Company Name</th>
               <th class="tbl-th-color">Business Name</th>
               <th class="tbl-th-color">Owner</th>
               <th id="portfolio_action" class="th_right th_left tbl-th-color">Action</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="tab-pane " id="tabDevices">
        <table id="tblUserDevices" class="table-admin tables compact">
            <thead>
            <tr>
               <th class="th_left tbl-th-color">Device Name</th>
               <th class="tbl-th-color">Mac Address</th>
               <th class="tbl-th-color">Device IMEI</th>
               <th id="devices_action" class="th_right tbl-th-color">Action</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="tab-pane " id="tabBills">
        <div class="DueDates">
            <table id="tblUserTransactionFilters" align="left">
                <tr>
                    <td>
                        <div class="btn-group" data-toggle="buttons">

                            <label class="btn btn-primary active btn-xs" id="optionAll" data-id='{{ $id }}'>
                                <input type="radio" name="options" id="optionAll" checked>
                                <div class="allBtn">
                                    <div id="allCont">
                                        All
<!--                                        <table>-->
<!--                                            <tr id="row1">-->
<!--                                                <th>-->
                                                    <span id="dollarSignAll" class="c-white">PHP</span>
                                                    <span id="valueAll" class="c-white">
                                                        <a class="toolBill" href="#" data-toggle="tooltip" title="{{$Billstotal_All}}">
                                                            <div class="overflowBill">{{$Billstotal_All}}</div>
                                                        </a>
                                                    </span>
                                                    <span id="forwardImgAll" class="c-white">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<!--                                                </th>-->
<!---->
<!--                                            </tr>-->
<!--                                            <tr id="row2">-->
<!--                                                <th>--><br/>
                                                    <span id="totalBillsDue" class="c-white">Total Bills Due</span>
<!--                                                </th>-->
<!--                                            </tr>-->
<!--                                        </table>-->
                                    </div>

                                </div>

                            </label>
                            <label class="btn btn-warning btn-xs" id="optionWeek" data-id='{{ $id }}'>
                                <input type="radio" name="options" id="optionWeek">
                                <div class="allBtn">
                                    <div id="allCont">
                                        THIS WEEK
<!--                                        <table>-->
<!--                                            <tr id="row1">-->
<!--                                                <th>-->
                                                    <span id="dollarSignWeek" class="c-white">PHP</span>
                                                    <span id="valueWeek" class="c-white">
                                                        <a class="toolWeek" href="#" data-toggle="tooltip" title="{{$Billstotal_ThisWeek}}">
                                                            <div class="overflowBill">{{$Billstotal_ThisWeek}}</div>
                                                        </a>
                                                    </span>
                                                    <span id="forwardImgAll" class="c-white">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<!--                                                </th>-->
<!--                                            </tr>-->
<!--                                            <tr id="row2">-->
<!--                                                <th>--><br/>
                                                    <span id="totalBillsDueweek" class="c-white">Total Bills Due</span>
<!--                                                </th>-->
<!--                                            </tr>-->
<!--                                        </table>-->
                                    </div>
                                </div>
                            </label>
                            <label class="btn btn-danger btn-xs" id="optionDue" data-id='{{ $id }}'>
                                <input type="radio" name="options" id="optionDue">
                                <div class="allBtn">
                                    <div id="allCont">
                                        OVER DUE
<!--                                        <table>-->
<!--                                            <tr id="row1">-->
<!--                                                <th>-->
                                                    <span id="dollarSignDue" class="c-white">PHP</span>
                                                    <span id="valueDue" class="c-white">
                                                        <a class="toolWeek" href="#" data-toggle="tooltip" title="{{$Billstotal_OverDue}}">
                                                            <div class="overflowBill">{{$Billstotal_OverDue}}</div>
                                                        </a>
                                                    </span>
                                                    <span id="forwardImgAll" class="c-white">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<!--                                                </th>-->
<!--                                            </tr>-->
<!--                                            <tr id="row2">-->
<!--                                                <th>--><br/>
                                                    <span id="totalBillsDueover" class="c-white">Total Bills Due</span>
<!--                                                </th>-->
<!--                                            </tr>-->
<!--                                        </table>-->
                                    </div>
                                </div>
                            </label>
                        </div>
                    </td>
                    <td id="DateSearch_td_DateFromA">
                        <input type="text" class="form-control input-sm" value="" id="dp2" placeholder="Date From" readonly>
                    </td>
                    <td id="DateSearch_td_DateToA">
                        <div style="position: relative; right: 11px;">
                            <input type="text" class="span2 form-control input-sm" id="dp3" placeholder="Date To" readonly>
                        </div>
                    </td>
                    <td>
                        <div style="position: relative; right: 28px;">
                            <input type="button" value="Process" class="btn btn-sm" id="btnTransactionProcess1">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <table id="tblUserBills" class="table-admin compact tblUserBills-margin" style="/*width: 1196px;*/margin-left: 0px;">
            <thead>
            <tr>
                <th class="th_left tbl-th-color"></th>
                <th class="tbl-th-color" >Category</th>
                <th class="tbl-th-color" >Biller</th>
                <th class="tbl-th-color" >Amount</th>
                <th class="tbl-th-color" >Status</th>
                <th class="tbl-th-color" >Due Date</th>
<!--                <th class="tbl-th-color" >Week</th>-->
                <th id="bills_action" class="th_right tbl-th-color" >Action</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="tab-pane " id="tabTransaction">
        <div class="DateSearch">
            <ul id="tblUserTransactionFilter" align="center">
                <li class="li-inline" >
                    {{ Form::select('module', $trans_mod,'',array('class' => 'form-control input-sm','id'=>'module')) }}
                </li>
                <li class="li-inline" id="DateSearch_td_DateFrom">
                    <input type="text" class="form-control input-sm" value="" id="dp4" placeholder="Date From" readonly>
                </li>
                <li class="li-inline" id="DateSearch_td_DateTo">
                    <input type="text" class="span2 form-control input-sm" id="dp5" placeholder="Date To" readonly>
                </li>
                <li class="li-inline">
                    <input type="button" value="Process" class="btn btn-sm" id="btnTransactionProcess">
                </li>
            </ul>
        </div>
        <div id = "tblLog">
            <table id="tblUserTransactionsLog" class="table-admin tables compact" style="white-space: nowrap;">
                <thead>
                <tr>
                    <th class="th_left tbl-th-color" >Transaction No.</th>
                    <th class="tbl-th-color" >Date & Time</th>
                    <th class="tbl-th-color" >Device ID</th>
                    <th class="tbl-th-color" >Location Details</th>
                    <th class="tbl-th-color" >Transaction Type</th>
                    <th class="th_right tbl-th-color" >Description</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

    <div class="modal-view">
        <div class="row portfolio_views" id='portfolio_view'>
            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <h4 id="modalHeader">Business Details</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2 col-md-offset-1">
                    <b>Company Name</b>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 col-md-offset-1" id="companyNameText">{{ Form::text('1', $BusinessName,array('readonly','size'=>'35'))}}</div>
            </div>

            <div class="row">
                <div class="col-md-2 col-md-offset-1">
                    <b>Owner</b>
                </div>
            </div>
            <div class="col-md-2 col-md-offset-2">
                <b>Address</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-1">{{ Form::text('2', $owner,array('readonly'))}}</div>
            <div class="col-md-2 col-md-offset-2">{{ Form::text('5', $company_address,array('readonly'))}}</div>
        </div>

        <div class="row">
            <div class="col-md-2 col-md-offset-1">
                <b>Email</b>
            </div>
            <div class="col-md-2 col-md-offset-2">
                <b>ABN</b>
            </div>
            <div class="col-md-2 col-md-offset-2">
                <b>ACN</b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 col-md-offset-1">{{ Form::text('6', $company_email,array('readonly'))}}</div>
            <div class="col-md-2 col-md-offset-2">{{ Form::text('3', $company_acn,array('readonly'))}}</div>
            <div class="col-md-2 col-md-offset-2">{{ Form::text('4', $company_abn,array('readonly'))}}</div>
        </div>

        <br>
        <div class="row"></div>
        <br>

        <br>
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <table id="tblBankAccount" class="table-admin tables compact">
                    <thead>
                    <tr>
                        <th class="th_left tbl-th-color">ID</th>
                        <th class="tbl-th-color" >Account Name</th>
                        <th class="tbl-th-color" >Account Type</th>
                        <th class="th_right tbl-th-color th-width">Action</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-6 close_modal">
                <input type="button" value="Close" id="btn_close" class="btn form-control btn-info btn-xs">
            </div>
        </div>
    </div>
</div>
</div>




<!--Modal for billsview-->
<div class="modal fade" id="billsViewModal" role="dialog" data-backdrop="static" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document" style="width: 800px; top: 85px;">
        <div class="modal-content" style="height: 420px; width: 800px;">
            <div class="modal-header">
                <button type="button" style="top: 3px;
    left: -4px;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="gridSystemModalLabel">Bills View</h3>
            </div>
            <div class="modal-body">
                <div id="imgPlace"></div>

                <div class="col-md-6 billsview_div billsview-WH">
                    <table border=0 width='100%' align='center' height="100%" id="billsview">
                        <col width="45%" />
                        <col width="5%" />
                        <col width="5%" />
                        <col width="45%" />
                        <tr height="80">
                            <td colspan='4' id="td_Biller" align="center"></td>
                        </tr>

                        <tr height=30" >
                            <td class="td_accountNumber" colspan='4'>Account No. &nbsp; <span id="td_accountNumber"></span></td>
<!--                            <td class="" colspan="2" id="td_accountNumber"></td>-->
                        </tr>
                        <tr>
                            <td colspan='4' id="td_billCategory" align="center"></td>
                        </tr>

<!--                            <td class="billsview_td" colspan='2'>Transaction Number</td>-->
<!--                                <td class="billsview_td2" id="td_TransactionNumber"></td>-->

                        <tr height=30">
                            <td class="billsview_td td_duedate">Due Date</td>
                            <td class="td_dash" colspan='2' > - </td>
                            <td class="billsview_td2 td_duedateval" id="td_DueDate"></td>
                        </tr>
                        <tr height=30">
                            <td class="billsview_td td_payment">Payment Date</td>
                            <td class="td_dash"  colspan='2'> - </td>
                            <td class="billsview_td2 td_paymentval" id="td_PaymentDate"></td>
                        </tr>
                        <tr height=30">
                            <td class="billsview_td td_billstatus">Bill Status</td>
                            <td class="td_dash" colspan='2' > - </td>
                            <td class="billsview_td2 td_billstatusval" id="td_Billstatus"></td>
                        </tr>

                        <tr height="60" class="billAmount_tr">
                            <td id="td_billAmount2" colspan='2' class=""><span id = "dollar">PHP</span></td>
                            <td colspan='2'>
                                <a class="toolAmount" href="#" data-toggle="tooltip" title="">
                                    <div id="td_billAmount" class=""></div>
                                </a>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table border='0' width='80%' align='center'>
                        <tr>
                            <td width='30%' id="btn1"></td>
                            <td width='30%' id="btn2"></td>
                            <td width='30%' id="btn3"></td>
                        </tr>
                    </table>
                    <div class="row" style="display: none">
                        <div class="col-md-2 col-md-offset-6 close_modal">
                            <input type="button" value="CLOSE" id="bill_view_btn_close" class="btn btn-default custom-default cancel">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!---->
