@extends("master")
@section("title", "Edition de joints")
@section("sidebar")
    @parent
    @include("note.joint.menu", ["jointId",  $jointId])
@stop

@section("content")
    <?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 25-08-15
 * Time: 23:01
 */
$joint = new \App\Lien();

$user = Auth::user()->email;
$directoryList = getFolderList(Auth::user()->email);

$notesList = getDocumentsFiltered("", FALSE, 0, $user);
print_r($directoryList);
?>
<form action="{{asset("note/joint/save/0")}}" method="POST">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
    <input type="hidden" id="note_id" name="note_id" value="{{$noteId}}">
    <label for="directory">Choisir un répertoire</label>
    <select id="directory" name="folder_id" id="folder_id" onchange="populateNotes()">
        <?php
        foreach ($directoryList as $folderId) {
            echo "<option value='" . $folderId["folder_id"] . "'>" . $folderId["filename"] . "</option>";
        }

        ?>
    </select>
    <label for="file">Choisir un fichier</label>
    <select id="file" name="linked_note_id">
        <?php
        foreach ($notesList as $note) {
            echo "<option value='" . $note["id"] . "'>" . $note["filename"] . "</option>";
        }

        ?>

    </select>
    <textarea name="text">Entrer une description</textarea>
    <input type="text" name="name" value=""/>
    <input type="hidden" name="user_id" value="{{$user}}"/>
    <input type="submit" name="submit" value="Enregistrer"/>
</form>
<script>
    function populateNotes() {
        $dirId = $("#folder_id").val();


    }
</script>
@stop
