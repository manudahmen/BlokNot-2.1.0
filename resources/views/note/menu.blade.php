<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 27-08-15
 * Time: 06:12
 *
 * */
?>
@section(("sidebar"))
    @parent
    <div class="miniImgContainerBottom">

        <label>Actions</label>
        <ul class="onfile_actions">
            <li><a href="<?php echo asset("note/view/" . $noteId) ?>">Voir</a></li>
            <!-- note/view demande un login de plus!-->
            <li><a href="<?php echo asset("note/edit/" . $noteId); ?>">Modifier</a></li>
            <li><a href="<?php echo asset("file/download/" . $noteId); ?>">T&eacute;l&eacute;charger</a></li>
            <li>Supprimer</li>
            <li>Déplacer</li>
        </ul>
    </div>
    @include("menu", ["noteId", $noteId])
@stop
