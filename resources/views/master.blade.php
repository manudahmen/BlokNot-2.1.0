<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/page.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('js\viewerJS\viewer.css') }}" rel="stylesheet" type="text/css"/>
    <link href="http://viewerjs.org/stylesheets/app.css" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('js/rdio.com/jquery.rdio.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @section('header')
    @show

</head>
<body>
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
        @section('sidebar')

        @show
    </div>

    <div class="containerBlocnoteBrowser">
        <div id="top_container">
            <h1>@yield("title")</h1>
            @section("top")
            @show
        </div>
        <div id="navbar">
        @section("navbar")
            @include("navigation.navbuttons")
            @include("navigation.history")
            <a onclick="history().back()">&lt;&minus;</a><a onclick="history().next()">&minus;&gt;</a>
        @show
        </div>
        @section('content')
            <p>Applications web de Manuel Dahmen. Formation personnelle.</p>
        @show
    </div>
    <div id="api"></div>
</body>
</html>