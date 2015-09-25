<!doctype html>
<html lang="fr">
<head>
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
        mixpanel.track("a", "App Click", {
            "referrer": document.referrer
        });
    </script>
    <meta charset="windows-1250">
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