<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Se connecter</title>
</head>
<body>
<form method="post" action="controleurConnection.php">
    <p>
        <label for="pseudo">Votre Pseudo</label><input type="text" name="pseudo" id="pseudo" value="<?php if( isset($_COOKIE['pseudo']) ){echo $_COOKIE['pseudo'];} ?>"  />
    </p>

    <p>
        <label for="pass">Votre Mot de passe</label><input type="password" name="password" id="pass" value=""  />
    </p>

    <p>
        <input type="checkbox" name="check" id="check" /><label for="check">Connexion automatique</label>
    </p>

    <p>
        <input type="submit" value="Se connecter"/>
    </p>
    <?php
    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
    {
        echo 'Bonjour ' . $_SESSION['pseudo'];
    }
    ?>
</form>
</body>
</html>