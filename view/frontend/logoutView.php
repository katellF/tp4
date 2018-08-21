<?php

$this->title = 'Se déconnecter';

?>


    <form method="post" action="index.php?action=logout">

        <p>
            <input type="hidden" name="action" value="logout"/>
            <input type="submit" value="Se déconnecter"/>
        </p>

    </form>
