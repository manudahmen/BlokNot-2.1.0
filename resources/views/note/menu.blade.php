<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 27-08-15
 * Time: 06:12
 *
 * */
?>
<ul id="note_actions" xmlns="http://www.w3.org/1999/html">
    <li><a href="<?php echo asset("note/view/" . $noteId) ?>"><img src="/images/see.png"/>Voir</a></li>
            <!-- note/view demande un login de plus!-->
    <li><a href="<?php echo asset("note/edit/" . $noteId); ?>"><img src="/images/edit.png"/>Modifier</a></li>
    <li><a href="<?php echo asset("file/download/" . $noteId); ?>"><img src="/images/download.png"/>T&eacute;l&eacute;charger</a>
    </li>
    <li><a href="<?php echo asset("note/delete/" . $noteId); ?>" style="color: red; background: #000;"><img
                    src="/images/delete.png"/>Supprimer</a></li>
    <li><a href="<?php echo asset("note/edit/" . $noteId); ?>"><img src="/images/move.png"/>D&eacute;placer</a></li>
    <li><a href="<?php echo asset("note/list/" . getParentNoteId($noteId)."/0"); ?>"><img src="/images/folder.png"/>Dossier parent</a></li>
</ul>