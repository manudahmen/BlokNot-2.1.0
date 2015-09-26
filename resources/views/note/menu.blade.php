<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 27-08-15
 * Time: 06:12
 *
 * */
?>
@section("sidebar")
    @parent
            <li><a href="<?php echo asset("note/view/" . $noteId) ?>">Voir</a></li>
            <!-- note/view demande un login de plus!-->
            <li><a href="<?php echo asset("note/edit/" . $noteId); ?>">Modifier</a></li>
            <li><a href="<?php echo asset("file/download/" . $noteId); ?>">T&eacute;l&eacute;charger</a></li>
    <li><a href="<?php echo asset("note/delete/" . $noteId); ?>">Supprimer</a></li>
    <li><a href="<?php echo asset("note/edit/" . $noteId); ?>">">Déplacer</a></li>
    @include("menu", ["noteId", $noteId])
@stop
