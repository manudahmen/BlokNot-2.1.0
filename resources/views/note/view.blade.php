@extends('master')
@section('title', 'Note viewer')

@section('sidebar')
    @parent


@stop

@section('content')
    <?php
    /**
     * Created by PhpStorm.
     * User: manue_001
     * Date: 20-08-15
     * Time: 13:42
     */
    /*
        require_once(realpath(base_path("public/lib/bloc-notes/composant/browser/listesItem.php")));

        $mime = getMimeType($noteId);
        if(strpos($mime, "image") === 0)
        {
        ?><img src="{{ asset("file/view/".$noteId) }}"/><?php
    }
    else if(strchr($mime, "text") >= 0)
    {
    ?>{{ file_get_contents(asset("file/view/".$noteId)) }}<?php
    } else if ($mime == "directory") {
        echo "Répertoire";

    }*/
    ?>
    <div id="note_viewer_container" onclick="updateJoint();" style="padding: 20px; border: 3px groove #24a199">

    </div>

    <div id="lien_liste" onclick="updateJoint();" style="padding: 20px; border: 3px groove #24a199">

    </div>
    <script type="application/javascript">
        function updateJoint() {
            $.ajax({
                url: "{{asset("note/joint/list/$noteId") }}}",

                context: document.body
            }).done(function (server_response) {
                $("#lien_liste").html(server_response);
            });
        }
        var type_html_start = "errors";
        var text_to_load = "";
        function updateNote() {

            $.ajax({
                url: "{{asset("file/mime-type/$noteId")}}",
                context: document.body
            }).done(function (server_response) {
                if (server_response.search("image") >= 0) {
                    type_html_start = "<img src='{{ asset("file/view/".$noteId) }}''/>";
                }
                else if (server_response.search("text") >= 0) {
                    text_to_load = type_html_start = "{{ asset("file/view/".$noteId) }}";
                } else if ($mime == "directory") {
                    type_html_start = "Repertoire";

                }

                $("#note_viewer_container").html(type_html_start);

            });

            if (text_to_load.size() > 0) {
                $.ajax({
                    url: text_to_load,
                    context: document.body
                }).done(function (server_response) {
                    $("#note_viewer_container").html(server_response);
                });
            }
        }

        updateNote();
        updateJoint();
    </script>

@stop