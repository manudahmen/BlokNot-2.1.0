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
        <p>This is the master sidebar.</p>
        @show
    </div>
        <h1>@yield('title')</h1>
    <div class="container">
            @section('content')
            @show
        </div>
</body>
</html>