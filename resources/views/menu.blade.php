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
    <div class="miniImgContainerBottom">

        <label>Actions</label>
        <ul>
            <li><a href="{{asset ("note/list/0/1")}}">Retour au dossier racine</a></li>
            <?php
            if(isset($noteId))
            {
            $note = getDBDocument($noteId);

            ?>
            <li><a href="{{asset ("note/list/".$note->folder_id."/1")}}">Dossier courant</a></li>
            <?php
            }
            ?>
        </ul>
    </div>


@stop