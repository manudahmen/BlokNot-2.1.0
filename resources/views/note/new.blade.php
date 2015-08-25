    <?php
    /**
     * Created by PhpStorm.
     * User: manue
     * Date: 23/08/2015
     * Time: 18:33
     */

    $user = Auth::user()->email;

    if ($folderId == 0) {
        $folderId = getRootForUser($user);
    }
    ?>
    <form action="{{asset("note/save/txt/0") }}" method="GET">
        <table>
            <tr>
                <td></td>
                <td><input type="hidden" name="noteId" value="0"/>
            <tr>
                <td></td>
                <td><input type="hidden" name="mime" value="text/plain"/>
            <tr>
                <td><label for="folder_id">Dossier</label></td>
                <td>
                    <?php
                    folder_field($folderId, "folder_id", $user);  ?></td>
            </tr>
            <tr>
                <td><label for="filename">Nom de fichier</label></td>
                <td><input id="filename" type="text" name="filename" value="My new file"/></td>
            </tr>
            <tr>
                <td><label for="text_editor">Editer la note</label></td>
                <td><textarea rows="12" cols="40" name="content_file"
                              id="text_editor">
            <?php
                        echo "<p>" . date(time()) . "</p>" . "<p>" . $user . "</p>";
                        ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="sauvegarder" value="Sauvergarder"/></td>
            </tr>
        </table>
    </form>
