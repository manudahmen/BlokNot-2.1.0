<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 27-08-15
 * Time: 06:12
 *
 * */

$lien = \App\Lien::findOrNew($jointId);

$lien->load($jointId);


?>
@section(("sidebar"))
    @parent
    <p>Actions sur le joint</p>
    <div class="miniImgContainerBottom">

        <label>Actions</label>
        <ul class="onfile_actions">
            <li><a href="<?php echo asset("note/joint/edit/" . $lien->getAttribute("id")) ?>">Edition</a></li>
            <li><a target="_blank" href="<?php echo asset("note/view/" . $lien->getAttribute("linked_note_id")); ?>">Voir
                    le joint</a></li>
            <li>Supprimer</li>
            <li>D�placer</li>
        </ul>
    </div>
    <p>Action sur la note</p>
    @include("note.menu", ["noteId" => $lien->getAttribute("note_id")])
@stop
