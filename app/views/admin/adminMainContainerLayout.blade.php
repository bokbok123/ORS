{{ Theme::asset()->usePath()->add('css-user-receipt_index', 'css/user/index.css') }}
{{ Theme::asset()->usePath()->add('js-user-index', 'js/user/index.js') }}

@yield('meta')

@yield('hidden')
<input type="hidden" value="<?php echo URL::to('/'); ?>" id="hdnBaseUrl" />
<div class="view_menus">
    <ul class="nav nav-tabs" id="tabBillerView">
        @yield('nav-tabs')
    </ul>
</div>

<div class="tab-content">
    @include('admin.searchBox')
    @yield('tabs')
</div>

@yield('modal')

