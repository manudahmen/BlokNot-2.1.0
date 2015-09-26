<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 27-08-15
 * Time: 17:02
 */
?>

@section("sidebar")
    @parent
    <li>
        <a href="{{asset ("note/list/0/1")}}" title="Retour au dossier racine">
            <div id="goto_root_folder"></div>
        </a>
    </li>
            <?php
            if(isset($noteId) && $noteId != 0)
            {
            $note = getDBDocument($noteId);

            ?>
            <li><a href="{{asset ("note/list/".$note->folder_id."/1")}}">Dossier courant</a></li>
            <?php
            } ?>


@stop