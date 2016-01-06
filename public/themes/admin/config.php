<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials", "views" and "widgets"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => array(

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function($theme)
        {
            // You can remove this line anytime.
            $theme->setTitle('Copyright ©  2013 - Laravel.in.th');

            // Breadcrumb template.
            // $theme->breadcrumb()->setTemplate('
            //     <ul class="breadcrumb">
            //     @foreach ($crumbs as $i => $crumb)
            //         @if ($i != (count($crumbs) - 1))
            //         <li><a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a><span class="divider">/</span></li>
            //         @else
            //         <li class="active">{{ $crumb["label"] }}</li>
            //         @endif
            //     @endforeach
            //     </ul>
            // ');
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function($theme)
        {
            /* Global CSS, JS */
            $theme->asset()->add('js-jquery', 'js/jquery-1.11.1.min.js');
            $theme->asset()->add('js-boostrap', 'js/bootstrap.min.js');
            $theme->asset()->add('js-eziloading', 'js/eziloading.js');
            $theme->asset()->add('js-boostrap-datepicker', 'js/bootstrap-datepicker.js');
            $theme->asset()->add('js-jqueryvalidate', 'js/jqueryvalidation/jquery.validate.min.js');
            $theme->asset()->add('js-jqueryvalidate-addon', 'js/jqueryvalidation/additional-methods.min.js');
            $theme->asset()->add('js-colorbox', 'js/jquery.colorbox-min.js');

            $theme->asset()->add('css-boostrap', 'css/bootstrap.css');
            $theme->asset()->add('css-boostrap-theme', 'css/bootstrap-theme.css');
            $theme->asset()->add('css-boostrap-datepicker', 'css/datepicker3.css');
            $theme->asset()->add('css-colorbox', 'css/colorbox.css');
            $theme->asset()->usePath()->add('css-chosen', 'css/jquery.chosen.css');
            $theme->asset()->usePath()->add('css-media', 'css/media.css');
            $theme->asset()->usePath()->add('js-client', 'js/client.js');


            /* Admin CSS */
            $theme->asset()->usePath()->add('js-jquery', 'js/jquery-1.11.1.min.js');

            $theme->asset()->usePath()->add('css-ofw', 'css/ezi-admin.css');
            $theme->asset()->usePath()->add('css-jquery-datatable', 'css/jquery.dataTables.css');

            $theme->asset()->usePath()->add('css-side-styles', 'css/user/side-styles.css');
            $theme->asset()->usePath()->add('css-styles_dropdown', 'css/user/styles_dropdown.css');
            $theme->asset()->usePath()->add('css-globalset', 'css/user/globalset.css');
            $theme->asset()->usePath()->add('css-jquery.iviewer-css', 'css/jquery.iviewer.css');
            $theme->asset()->usePath()->add('css-jquery.iviewer-custom', 'css/user/custom-iviewer.css');

            /* Admin JS */
            $theme->asset()->usePath()->add('js-jquery-datatable', 'js/jquery.dataTables.min.js');
            $theme->asset()->usePath()->add('js-chosen', 'js/jquery.chosen.js');
            $theme->asset()->usePath()->add('js-global', 'js/global.js');
            $theme->asset()->usePath()->add('js-confirm', 'js/jquery.confirm.js');
            $theme->asset()->usePath()->add('js-run_prettify', 'js/run_prettify.js');
            $theme->asset()->usePath()->add('js-admin_setting', 'js/user/admin_setting.js');
            $theme->asset()->usePath()->add('js-jquery.dropdown', 'js/user/jquery.dropdown.js');
            $theme->asset()->usePath()->add('js-side-script', 'js/user/side-script.js');
            $theme->asset()->usePath()->add('js-ajaxForm', 'js/jquery.form.js');

            $theme->asset()->usePath()->add('js-jquery-ui', 'js/jqueryui.js');
            $theme->asset()->usePath()->add('js-jquery.iviewer', 'js/jquery.iviewer.js');

            /* Zebra - Dialog */
            $theme->asset()->add('css-zebra-dialog', 'css/zebra-dialog/zebra_dialog.css');
            $theme->asset()->add('js-zebra-dialog', 'js/zebra_dialog.js');

            $theme->asset()->add('js-zebra-dialog', 'js/jquery-migrate-1.2.1.js');
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => array(

            'default' => function($theme)
            {
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            }

        )

    )

);