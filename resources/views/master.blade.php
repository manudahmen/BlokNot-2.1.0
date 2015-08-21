<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <!--<link href="//fonts.googleapis.com/css?family=Times New Roman:100" rel="stylesheet" type="text/css"/>-->
    <link href="{{ asset('style/main.css')}}" rel="stylesheet" type="text/css"/>
    <script src="script.js"></script>
</head>
<body>
@section('sidebar')
    <div id="sidebar">
        <?php
        if (Auth::check())
        {?><p>L'utilisateur est connect&eacute; ....</p><p><a href="{{URL::to("auth/logout")}}">Logout</a></p><?php echo Auth::user()->email;
        }
        else
        {
        ?><p>Non connect&eacute;</p><?php

        }
        ?>
        <p>Applications web de Manuel Dahmen. Formation personnelle.</p>
        @show
    </div>
    <h1>@yield('title')</h1>
    <div class="container">
        @section('content')
        @show
    </div>
</body>
</html>