<?php $theme = 'asd'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> fonebayad </title>
        {{ Theme::partial('metadata') }}
        <link rel="shortcut icon" href="{{URL::to('/img/favicon.ico')}}" />

    </head>
    <body>
<!--    {{ Theme::partial('globalmodals') }}-->
    {{-- Theme::partial('new_header') --}}

    <div class="new-full">
<!--        {{ Theme::partial('side-nav') }}-->
        {{ Theme::content() }}
    </div>

<!--    {{ Theme::partial('footer') }}-->

    {{ Theme::asset()->container('footer')->scripts() }}
    </body>
</html>