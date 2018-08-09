<?php

if ( isset ($_POST) && empty($_POST)) {
    echo "premier chargement";
}

if ( isset ($_POST) && !empty($_POST)) {


    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $req = $bdd->prepare('SELECT id FROM members WHERE pseudo = :pseudo');
    $req->execute(array(
            'pseudo' => $_POST['pseudo']));

    $errorCounter = 0;

    if ( $req->rowCount() === 0 ) {
        echo 'on peut ajouter pseudo';
    } else {
        echo 'On a deja ce pseudo';
        $errorCounter++;

    }

    if( strlen( $_POST['password'] ) < 6 ){

        echo 'Mdp trop court,  il faut au moins 6 chars...';
        $errorCounter++;
    }

    if($_POST['password'] !== $_POST['confirmPassword']){

        echo 'Vos 2 mots de passe doivent etre identiques';
        $errorCounter++;
    }

//    if(1 !== preg_match("#^[a-z]||[0-9]@*\.#", $_POST['email'])){
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)=== false) {
         echo 'ecriture email fausse';
        $errorCounter++;
    }

    if ( $errorCounter === 0) {

        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Insertion
        $req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, registration_date) VALUES(:pseudo, :pass, :email, CURDATE())');
        $req->execute(array(
            'pseudo' => $_POST['pseudo'],
            'pass' => $pass_hache,
            'email' => $_POST['email']));

        echo'Bienvenue chez nous';

    }

}

?>

<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8" />
     <title>Inscription</title>
 </head>
 <body>
 <form method="post" action="registration.php">

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

