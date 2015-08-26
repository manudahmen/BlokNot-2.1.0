<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 25-08-15
 * Time: 23:01
 */
require_once(realpath(base_path("public/lib/bloc-notes/composant/browser/listesItem.php")));

$note = new \App\Note();

$note->findOrFail($noteId);
?>
<form action="{{asset("note/joint/save/$noteId")}}" method="POST">
<label for="directory">Choisir un répertoire</label>
<select id="directory" name="folder_id" ></select>

<label for="file">Choisir un fichier</label>
<select id="file" name="note_id" ></select>
    <textarea name="text">Entrer une description</textarea>
<input type="submit" name="" value="Enregistrer"/>
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
