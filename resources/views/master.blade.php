<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link href="//fonts.googleapis.com/css?family=Times New Roman:100" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="{{ asset('style/main.css')}}" rel="stylesheet" type="text/css"/>
    <script src="script.js"></script>
    @section('header')
    @show

</head>
<body>
@section('sidebar')
    <div id="sidebar">
        <?php
        if (Auth::check())
        {?><p id="connected_user" class="btn btn-large btn-primary openbutton" >L'utilisateur est connect&eacute; ....
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
    <h1>@yield('title')</h1>
    <div class="container">
        @section('content')
            <p>Applications web de Manuel Dahmen. Formation personnelle.</p>
        @show
    </div>
</body>
</html>