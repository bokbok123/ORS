{{ Theme::asset()->usePath()->add('css-adminmenu', 'css/bpo/index.css') }}

<div class="input-group" id="search-box">
    <span class="input-group-addon" style="background-color: #ffffff !important;width:0px !important; border-right: 1px solid #ffffff !important;">
        <img src="<?php echo Theme::asset()->url('img/magnifying.png'); ?>" >
    </span>
    <input type="text" id="SearchMyBills" placeholder="Search" name="SearchMyBills" class="form-control" style="width: 222px; margin-left: -1px">
</div>

<style>
    #search-box{
        float: right;
        margin-bottom: 20px;
        /*bottom: -25px;*/
    }
    .search-text{
        float: left !important;
        font-size: 18px;
        padding-top: 9px;
        padding-right: 10px;
    }
</style>