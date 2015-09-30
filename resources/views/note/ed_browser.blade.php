<html>

<head>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('js/rdio.com/jquery.rdio.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="/js/tinyMCE.init.js"></script>
    <script src="/js/BlokNotTInyMCEBrowser.js"></script>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
</head>
<body>

<?php
$user = Auth::user()->email;
require_once(realpath(base_path("main_functions.php")));
listerNotes_browser($user);
?>
</body>
</html>