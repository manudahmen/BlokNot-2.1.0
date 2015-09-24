<?php
$noteId = 0;
?>@extends('master')
@section('title', 'Note editor')

@section('header')
    @parent
    <script type="text/javascript" src="{{asset("js/tinymce/jquery.tinymce.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("js/tinymce/tinymce.min.js") }}"></script>


@stop

@@section('sidebar')
    @parent

    @include("note/menu", ["noteId", $noteId])

@stop
@section('content')
    <?php
    /**
     * Created by PhpStorm.
     * User: manue
     * Date: 23/08/2015
     * Time: 18:33
     */

    $user = Auth::user()->email;

    if ($folderId == 0) {
        $folderId = getRootForUser($user);
    }
    ?>
    @include("note/menu", ["noteId", 0])
    <form action="{{asset("note/save/txt/0") }}" method="GET">
        <table>
            <tr>
                <td></td>
                <td><input type="hidden" name="noteId" value="0"/>
            <tr>
                <td></td>
                <td><input type="hidden" name="mime" value="text/plain"/>
            <tr>
                <td><label for="folder_id">Dossier</label></td>
                <td>
                    <?php
                    folder_field($folderId, "folder_id", $user);  ?></td>
            </tr>
            <tr>
                <td><label for="filename">Nom de fichier</label></td>
                <td><input id="filename" type="text" name="filename" value="My new file"/></td>
            </tr>
            <tr>
                <td><label for="text_editor">Editer la note</label></td>
                <td><textarea rows="12" cols="40" name="content_file"
                              id="text_editor">
            <?php
                        echo "<p>" . gmdate("d/m/Y H:i:s", time()) . "</p>" . "<p>" . $user . "</p>";
                        ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="sauvegarder" value="Sauvergarder"/></td>
            </tr>
        </table>
    </form>
    <!-- place in header of your html document -->
    <script>
        tinymce.init({
            selector: "textarea#text_editor",
            theme: "modern",
            width: 600,
            height: 500,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],

            //content_css: "js/tinymce/css/content.css",
            toolbar: "addFile insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
    </script>
@stop