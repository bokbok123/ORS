{{ Theme::asset()->usePath()->add('css-user-adminDashboard', 'css/user/adminDashboard.css') }}

<!DOCTYPE html>
<html lang="en">
<head>
    <title> ezibills | Admin </title>
    <meta charset="utf-8">
    <meta name="keywords" content="{{ Theme::get('keywords') }}">
    <meta name="description" content="{{ Theme::get('description') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{URL::to('/img/favicon.ico')}}" />

    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->scripts() }}

</head>
{{ Theme::partial('header') }}
<body class="adminDashboard">


<div class="container2">

    <div class="main-containerAdmin">
        {{ Theme::content() }}
    </div>
</div>

</body>
</html>

