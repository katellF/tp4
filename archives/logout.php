<?php
session_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}


// Suppression des variables de session et de la session
$_SESSION = array();
$session_Destroy = session_destroy();

// Suppression des cookies de connexion automatique
setcookie('pseudo', '');
setcookie('pass', '');

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
<form method="post" action="logout.php">


    <p>
        <input type="submit" value="Se déconnecter"/>
    </p>

</form>
</body>
</html>
<?php
}

