<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 25-08-15
 * Time: 23:33
 */

$liens = \App\Lien::where("note_id", "=", $noteId)->get();

?>
@extends("master")
@section("title", "Liste de joints")
@section("sidebar")
    @parent
    @include("note/menu", ["noteId", $noteId])

@stop

@section("content")
    <ul>

        <?php        foreach($liens as $lien)
        {
        ?>
        <li>{{ $lien->getAttribute("id") }} lie note {{$lien->getAttribute("note_id")}} à <a
                    href="{{asset("note/view/".$lien->getAttribute("linked_note_id"))}}">note
                dépendante<?php echo $lien->getAttribute("linked_note_id"); ?></a><a
                    href="{{asset("note/joint/edit/".$lien->getAttribute("id"))}}">Modifier le lien</a></li><?php
        }
        ?>
        <li></li>
        <a href="{{asset("note/joint/new/$noteId")}}">Ajouter un lien</a></li>
    </ul>
@stop
