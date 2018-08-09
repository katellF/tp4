<?php
session_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}

if ( isset( $_POST['action'] ) && $_POST['action'] === "logout" )
{
logout();
}

var_dump($_POST);
var_dump($_SESSION);

if (empty($_SESSION))
{
    echo'Aurevoir et à bientôt! ';
} else { ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Se déconnecter</title>
    </head>
    <body>
    <form method="post" action="controleurLogout.php">

        <p>
            <input type="hidden" name="action" value="logout"/>
            <input type="submit" value="Se déconnecter"/>
        </p>

    </form>
    </body>
    </html>
    <?php
}

