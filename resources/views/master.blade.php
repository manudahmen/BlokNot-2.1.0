<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link href="//fonts.googleapis.com/css?family=Times New Roman:100" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="{{ asset('style/main.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/page.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/jquery.tinymce.min.js') }}"></script>
    @section('header')
    @show

</head>
<body>
@section('sidebar')
    <div id="sidebar">
        <p><a href="{{ URL::to("/") }}" id="HOME_LINK" class="btn btn-large btn-primary openbutton">Accueil - Home</a>
        </p>
        <?php
        if (Auth::check())
        {?><p id="connected_user" class="btn btn-large btn-primary openbutton">L'utilisateur est connect&eacute; ....
        </p>

        <p id="logout">
            <a class="btn btn-large btn-primary openbutton"
               href="{{URL::to("auth/logout")}}">Logout</a></p>

        <p><a href="#"
              class="btn-large btn-primary openbutton">
                <?php echo Auth::user()->email; ?></a>
        </p><?php
        }
        else
        {
        ?><p id="login" class="">Non connect&eacute;</p>

        <p><a href="{{URL::to("auth/login")}}" class="btn btn-large btn-primary openbutton">Login</a></p><?php

        }
        ?>

        @show
    </div>
    <div class="container">
        @section('content')
            <p>Applications web de Manuel Dahmen. Formation personnelle.</p>
        @show
    </div>
@section("navbar")
    <a onclick="history().back()">&lt;&minus;</a><a onclick="history().next()">&minus;&gt;</a>
@show
</body>
</html>