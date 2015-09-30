<html>

<head>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('js/rdio.com/jquery.rdio.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="/js/tinyMCE.init.js"></script>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
    <script type="text/javascript" src="/js/tinymce/tiny_mce_popup.js"></script>
</head>
<body>
<form name="file_select">
    <input name="url" value=""/>
    <input name="submit" type="submit" value="Inserer"/>
    <hr/>
<?php
$user = Auth::user()->email;
require_once(realpath(base_path("main_functions.php")));
listerNotes_browser($user);
?>

</form>
</body>
</html>