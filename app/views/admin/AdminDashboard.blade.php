{{ Theme::asset()->usePath()->add('css-user-dashboard','css/user/dashboard.css') }}
<style>
    #fb-root{
        position: absolute;
        right: 0px;
        left: 0px;
        bottom: 0px;
        background-color: rgba(0, 0, 0, 0.3);
        top: 56%;
    }
    .close{
        left: 5%;
    }
</style>
<div class="bg-body">
    <ul class="ch-grid row" style="padding: 0">
        <div class="col-sm-12">
            <div class="col-sm-3 col-xs-12">
                <li style="" class="list-bg">

                    <div class="ch-item ch-img-1">
                        <div class="ch-info-wrap" style="top: 56%; left: 18.5%; transform: translate(-50%, -50%); position: fixed;">
                            <a href="{{ URL::to('admin/transaction') }}" style="cursor: pointer;">
                            <div class="ch-info">
                                <div class="ch-info-front ch-img-1"></div>
                                <div class="ch-info-back" id="icon-inside">
                                    <span style="position: relative;top: 100px; color: #035041; font-weight: bold;">TRANSACTIONS</span>
                                </div>
                            </div>
                                </a>
                        </div>
                    </div>
                    <div style="color: #cccccc;font-size: 18px;top: 76%;left: 18.5%;transform: translate(-50%, -50%);position: fixed;">Transactions</div>

                 </li>
            </div>
            <div class="col-sm-3 col-xs-12">
                <li style="">
                    <div class="ch-item ch-img-2">
                        <div class="ch-info-wrap" style="top: 56%; left: 39.5%; transform: translate(-50%, -50%); position: fixed;">
                            <a href="{{ URL::to('admin/users') }}" style="cursor: pointer;">
                            <div class="ch-info">
                                <div class="ch-info-front ch-img-2"></div>
                                <div class="ch-info-back" id="icon-inside">
                                    <span style="position: relative;top: 100px; color: #035041; font-weight: bold;">MEMBERS</span>
                                </div>
                            </div>
                                </a>
                        </div>
                    </div>

                    <div style="color: #cccccc;font-size: 18px;top: 76%;left: 39.5%;transform: translate(-50%, -50%);position: fixed;">Members</div>
                </li>
            </div>
            <div class="col-sm-3 col-xs-12">
                <li style="">
                    <div class="ch-item ch-img-3">
                        <div class="ch-info-wrap" style="top: 56%; left: 60.5%; transform: translate(-50%, -50%); position: fixed;">
                            <a href="{{ URL::to('admin/ofw') }}" style="cursor: pointer;">
                            <div class="ch-info">
                                <div class="ch-info-front ch-img-3"></div>
                                <div class="ch-info-back" id="icon-inside">
                                    <span style="position: relative;top: 100px; color: #035041; font-weight: bold;">OFW</span>
                                </div>
                            </div>
                                </a>
                        </div>
                    </div>
                    <div style="color: #cccccc;font-size: 18px;top: 76%;left: 61%;transform: translate(-50%, -50%);position: fixed;">OFW</div>


                </li>
            </div>

            <div class="col-sm-3 col-xs-12">
                <li style="">
                    <div class="ch-item ch-img-4">
                        <div class="ch-info-wrap" style="top: 56%; left: 81.5%; transform: translate(-50%, -50%); position: fixed;">
                            <a href="{{ URL::to('admin/maintenance/biller-category/add') }}" style="cursor: pointer;">
                            <div class="ch-info">
                                <div class="ch-info-front ch-img-4"></div>
                                <div class="ch-info-back" id="icon-inside">
                                    <span style="position: relative;top: 100px; color: #035041; font-weight: bold;">MAINTENANCE</span>
                                </div>
                            </div>
                                </a>
                        </div>
                    </div>
                    <div style="color: #cccccc;font-size: 18px;top: 76%;left: 81.5%;transform: translate(-50%, -50%);position: fixed;">Maintenance</div>
                </li>
            </div>
        </div>
    </ul>
</div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '936829496331198',
            xfbml      : true,
            status     : true,
            version    : 'v2.1'
        });
    };
</script>
<div id="fb-root"></div>
