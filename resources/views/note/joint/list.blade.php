@extends("master")

@section("content")
    <ul>

        <?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 25-08-15
 * Time: 23:33
 */

        $liens = \App\Lien::where("note_id", $noteId);
    foreach($liens as $lien)
    {
        var_dump($lien);
    ?>
    <li>{{ $lien->id }} lie note {{$lien->note_id}} à note dépendante {{$lien->linked_note_id}}</li><?php
    }
    ?>
</ul>
<a href="{{asset("note/joint/new/$noteId")}}">Ajouter un lien</a>
@stop
