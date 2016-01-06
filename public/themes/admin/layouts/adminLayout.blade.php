{{ Theme::asset()->usePath()->add('css-user-adminDashboard', 'css/user/adminDashboard.css') }}

<!DOCTYPE html>
<html lang="en">
<head>
    <title> ezibills | Login </title>
    <meta charset="utf-8">
    <meta name="keywords" content="{{ Theme::get('keywords') }}">
    <meta name="description" content="{{ Theme::get('description') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{URL::to('/img/favicon.ico')}}" />


    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->scripts() }}
    <style>
    </style>


</head>

<body class="adminLayout">

<div class="container">
    <div class="main-container">
        {{ Theme::content() }}
    </div>
</div>

</body>
</html>

