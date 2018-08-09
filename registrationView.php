<?php
var_dump($_POST);
if ( isset ($_POST) && empty($_POST)) {
    echo "premier chargement";
}



?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>
    </head>
    <body>
    <form method="post" action="controleurRegistration.php">

        <p>
            <label for="pseudo">Votre Pseudo</label><input type="text" name="pseudo" id="pseudo"  value="<?php if( isset($_POST['pseudo'])){ echo $_POST['pseudo'];} ?>"  required/>
        </p>

        <p>
            <label for="email">Votre Email</label><input type="text" name="email" id="email" required/>
        </p>

        <p>
            <label for="pass">Votre Mot de passe</label><input type="password" name="password" id="pass" required/>
        </p>

        <p>
            <label for="confirmPass">Confirmez votre mot de passe</label><input type="password" name="confirmPassword" id="confirmPass" required/>
        </p>

        <p>
            <input type="submit" value="Enregistrer"/>
        </p>

    </form>
    </body>
    </html>

<?php

