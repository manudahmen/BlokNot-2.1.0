<html>
    <body>
        <div class="container">
		<p><?php
                    $id
                   ?></p>
		<?php
                require_once("../../../app/Libs/all-configured-and-secured-included.php");
                displayNote($id);
		?>
        </div>
    </body>
</html>