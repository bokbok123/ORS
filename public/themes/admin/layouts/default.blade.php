<!DOCTYPE html>
<html lang="en">
    <head>
        <input id="USER_ID" type="hidden" value="<?php echo Auth::user()->id; ?>"/>
        <input id="SOCKET_IO" type="hidden" value="<?php echo Session::get('systemsettings')['SOCKET_IO']; ?>"/>
        <title> ezibills | Admin </title>
        <meta charset="utf-8">
        <meta name="keywords" content="{{ Theme::get('keywords') }}">
        <meta name="description" content="{{ Theme::get('description') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{ Theme::asset()->styles() }}
        {{ Theme::asset()->scripts() }}
        <link rel="shortcut icon" href="{{URL::to('/img/favicon.ico')}}" />
        <script src="{{ Config::get('app.server') }}/socket.io/socket.io.js"></script>
        <script src="{{URL::to('/js/setupSocket.js')}}"></script>

    </head>
    <body>

    {{ Theme::partial('header') }}

    <div class="admin-container">
        {{ Theme::partial('aside') }}
        <div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 col-xs-12">
            {{ Theme::content() }}
        </div>
        </div>
    </body>
<!--    <div class="footer">-->
<!--        {{ Theme::partial('footer') }}-->
<!--    </div>-->
    {{ Theme::asset()->container('footer')->scripts() }}
</html>
