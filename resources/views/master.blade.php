<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
     <link href="//fonts.googleapis.com/css?family=Times New Roman:100" rel="stylesheet" type="text/css"/>
     <link href="{{ asset('style/main.css')}}" rel="stylesheet" type="text/css"/>
  <script src="script.js"></script>
</head>
<body>
    @section('sidebar')
    <div id="sidebar">
        <p><?php
            if (Auth::check())
            {?>L'utilisateur est connect&eacute; <?php echo Auth::user()->email;
            }
            ?>.</p>
        <p>Applications web de Manuel Dahmen. Formations personnelle.</p>
        @show
    </div>
        <h1>@yield('title')</h1>
    <div class="container">
            @section('content')
            @show
        </div>
</body>
</html>