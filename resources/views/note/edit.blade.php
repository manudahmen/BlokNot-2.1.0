@extends('master')
@section('title', 'Note editor')

@section('header')
    @parent
    <script type="text/javascript" src="{{asset("js/tinymce/jquery.tinymce.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("js/tinymce/tinymce.min.js") }}"></script>


@stop
@section('sidebar')
    @parent

    @include("note/menu", ["noteId", $noteId])

@stop
@section('content')

    <?php
    /**
     * Created by PhpStorm.
     * User: manue_001
     * Date: 20-08-15
     * Time: 13:42
     */

    //require_once(realpath(base_path("lib/bloc-notes2/composant/browser/listesItem.php")));
    $note = \App\Note::findOrFail($noteId);

    $attributes = $note->getAttributes();

    $filename = $attributes["filename"];
    $folder_id = $attributes["folder_id"];
    $content_file = $attributes["content_file"];
    $user = Auth::user()->email;
    $mime = $attributes["mime"];
    $ext = getExtension($filename);


    /*
        $filename = $note->filename;
        $content_file = $note->content_file;
        $folder_id = $note->folder_id;
        $user = Auth::user()->email;
        $ext = getExtension($filename);
        echo $mime = $note->mime;
    */


    if(isTexte($ext, $mime))
    {

    ?>
    <form action="{{asset("note/save/txt/".$noteId) }}" method="GET">
        <table>
            <tr>
                <td></td>
                <td><input type="hidden" name="option" value="edit.db"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="hidden" name="composant" value="save.db"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="hidden" name="noteId" value="<?php echo $noteId; ?>"/>
            <tr>
                <td></td>
                <td><input type="hidden" name="mime" value="<?php echo $mime; ?>"/>
            <tr>
                <td><label for="folder_id">Dossier</label></td>
                <td>
                    <?php
                    folder_field($folder_id, "folder_id", $user);  ?></td>
            </tr>
            <tr>
                <td><label for="filename">Nom de fichier</label></td>
                <td><input id="filename" type="text" name="filename" value="<?php echo $filename; ?>"/></td>
            </tr>
            <tr>
                <td><label for="text_editor">Editer la note</label></td>
                <td><textarea rows="12" cols="40" name="content_file"
                              id="text_editor"><?php echo $content_file; ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="sauvegarder" value="Sauvergarder"/></td>
            </tr>
        </table>
    </form>
    <?php
    }
    else if(isImage($ext, $mime)) {?>
    <form action="{{asset("images".$noteId) }}" method="GET">
        <input type="hidden" name="noteId" value="<?php echo $noteId; ?>"/>
        <?php
        folder_field($folder_id, "folder_id", $user);  ?>
        <input type="text" name="filename" value="<?php echo $filename; ?>"/>
        <input type="submit" name="sauvegarder" value="Sauvergarder"/>
    </form><?php
    }
    else {?>
    <form action="{{asset("note/save/other/".$noteId) }}" method="GET">
        <input type="hidden" name="noteId" value="<?php echo $noteId; ?>"/>
        <?php
        folder_field($folder_id, "folder_id", $user);  ?>
        <input type="text" name="filename" value="<?php echo $filename; ?>"/>
        <input type="submit" name="sauvegarder" value="Sauvergarder"/>
    </form>
    <?php
    }
    ?>
    <a href="{{asset("note/joint/new/$noteId")}}" target="NEW">Ajouter
        un fichier</a>
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
