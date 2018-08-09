<?php
var_dump($_POST);

//try {
//    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
//} catch (Exception $e) {
//    die('Erreur : ' . $e->getMessage());
//}
//

//if ( isset($_COOKIE['pseudo']) && isset($_COOKIE['pass']) ) {
//
//    echo $_COOKIE['pseudo'] .'     '. $_COOKIE['pass'].'<br><br>';
//
//
//    // controle pour connexion automatique....
//    $req = $bdd->prepare("SELECT id, pass FROM membres WHERE pseudo = :pseudo AND pass = :pass");
//    $req->execute(array(
//        'pseudo' => $_COOKIE['pseudo'],
//        'pass' => $_COOKIE['pass'],
//    ));
//
//
//
//    $resultat = $req->fetch();
//    var_dump('asdasdsad ',$resultat);
//
//    if( $resultat == true){
//
//        echo"Vous etes connectés";
//        exit;
//
//    }
//}


//if ( isset ($_POST) && !empty($_POST)) {
//
//
//    $errorCounter = 0;
//
//    if (!isset($_POST['pseudo']) || empty($_POST['pseudo'])) {
//        echo 'Pseudo manquant!';
//        $errorCounter++;
//    }
//
//    if (!isset($_POST['password']) || empty($_POST['password'])) {
//        echo 'Pwd manquant!';
//        $errorCounter++;
//    }
//
//    if ($errorCounter === 0) {
//
//
//
//
//        $req = $bdd->prepare("SELECT id, pass FROM membres WHERE pseudo = :pseudo");
//        $req->execute(array(
//            'pseudo' => $_POST['pseudo'],
//        ));
//
//        echo "Rows = ".$req->rowCount() ."<br>";
//
//        $resultat = $req->fetch();
//
//        var_dump($resultat);
//
//        $isPasswordCorrect = password_verify($_POST['password'], $resultat['pass']);
//        if (!$resultat) {
//            echo 'Mauvais identifiant ou mot de passe !1';
//        } else {
//            if ($isPasswordCorrect) {
//                session_start();
//                $_SESSION['id'] = $resultat['id'];
//                $_SESSION['pseudo'] = $_POST['pseudo'];
//                if ( isset( $_POST['check'] ) && $_POST['check'] === "on" ) {
//                    setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
//                    setcookie('pass', $resultat['pass'], time() + 365*24*3600, null, null, false, true);
//                }
//
//                echo 'Vous êtes connecté !';
//            } else {
//                echo 'Mauvais identifiant ou mot de passe !2';
//            }
//        }
//    }
//}
//
//?>

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