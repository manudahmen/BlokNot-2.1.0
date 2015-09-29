<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <link href='https://fonts.googleapis.com/css?family=Indie+Flower&subset=latin,latin-ext' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,latin-ext' rel='stylesheet'
          type='text/css'>
    <!-- start Mixpanel -->
    <script type="text/javascript">(function (e, b) {
            if (!b.__SV) {
                var a, f, i, g;
                window.mixpanel = b;
                b._i = [];
                b.init = function (a, e, d) {
                    function f(b, h) {
                        var a = h.split(".");
                        2 == a.length && (b = b[a[0]], h = a[1]);
                        b[h] = function () {
                            b.push([h].concat(Array.prototype.slice.call(arguments, 0)))
                        }
                    }

                    var c = b;
                    "undefined" !== typeof d ? c = b[d] = [] : d = "mixpanel";
                    c.people = c.people || [];
                    c.toString = function (b) {
                        var a = "mixpanel";
                        "mixpanel" !== d && (a += "." + d);
                        b || (a += " (stub)");
                        return a
                    };
                    c.people.toString = function () {
                        return c.toString(1) + ".people (stub)"
                    };
                    i = "disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
                    for (g = 0; g < i.length; g++)f(c, i[g]);
                    b._i.push([a, e, d])
                };
                b.__SV = 1.2;
                a = e.createElement("script");
                a.type = "text/javascript";
                a.async = !0;
                a.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ? MIXPANEL_CUSTOM_LIB_URL : "file:" === e.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
                f = e.getElementsByTagName("script")[0];
                f.parentNode.insertBefore(a, f)
            }
        })(document, window.mixpanel || []);
        mixpanel.init("8ac6f09b23ba5b96087d5e6c33fe056e");</script>
    <!-- end Mixpanel -->

    <script type="text/javascript">
        mixpanel.track("App Navigation");
    </script>
    <meta charset="windows-1250">
    <title>@yield('title')</title>
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('js/viewerJS/viewer.css') }}" rel="stylesheet" type="text/css"/>
    <link href="http://viewerjs.org/stylesheets/app.css" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('js/rdio.com/jquery.rdio.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script language="JavaScript">
        function showPlus(id) {
            $("#plus_button_" + id).removeClass('invisible').addClass('visible');
            //$("#plus_button")
            $("#moins_button_" + id).addClass('invisible').removeClass('visible');
            //$("#moins_button").removeClass('visible');
        }
        function showMoins(id) {
            $("#moins_button_" + id).addClass('visible').removeClass('invisible');
            //$("#moins_button").removeClass('invisible');
            $("#plus_button_" + id).addClass('invisible').removeClass('visible');
            //$("#plus_button").removeClass('visible');
        }
        function showMenu(id) {
            $('#ul' + id).removeClass("invisible").addClass("visible").addClass("row-3");
            ;
            //$('#' + id).addClass("visible");
            //$('#' + id).addClass("row-3");
            showMoins(id);
        }
        function hideMenu(id) {
            $('#ul' + id).addClass("invisible").removeClass("visible").removeClass("row-3");
            //$('#' + id).removeClass("visible");
            //$('#' + id).removeClass("row-3");
            showPlus(id);
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @section('header')
    @show

</head>
<body>
<div id="tree">
    @section("tree")

@stop
        </div>

<div id="sidebar">
    <ul id="profile_info">
        <li><a href="{{ URL::to("/") }}" id="HOME_LINK"><img src="/images/home.png"/><label class="onrolloverShow"/>Home</a>
        </li>
    <?php
    if (Auth::check())
        {?>
        <li id="connected_user" class="btn-large btn-primary openbutton">L'utilisateur est connect&eacute; ....
        </li>

        <li id="logout">

            <a
                    href="{{URL::to("auth/logout")}}"><img src="/images/disconnect.jpg"/><label class="onrolloverShow">Logout</label></a>
        </li>

        <li><a href="#"
          class="btn-large btn-primary openbutton">
                <?php echo Auth::user()->email; ?></a>
        </li><?php
    }
    else
    {
        ?>
        <li id="login" class="">Non connect&eacute;</li>

        <li><a href="{{URL::to("auth/login")}}">Login</a></li><?php

    }
    ?>
    @section('sidebar')
            @include("menu")
    @show
    </ul>
</div>

<div class="containerBlocnoteBrowser" style="scrollbar-face-color">
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
<!-- place in header of your html document -->
<script language="JavaScript" type="text/javascript" src="/js/tinyMCE.init.js"></script>

</body>
</html>