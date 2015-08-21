<?php
require_once(realpath(base_path("public/lib/bloc-notes/composant/browser/listesItem.php")));

displayNote($id);

?>
<div class="note_container">
    <p class="noteTitle" id="note_title"></p>
    <div class="noteContent" id="note_content"></div>
</div>
