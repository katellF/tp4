<?php
require('model.php');

if ( isset($_COOKIE['pseudo']) && isset($_COOKIE['pass']) ) {

echo $_COOKIE['pseudo'] .'     '. $_COOKIE['pass'].'<br><br>';

//$resultat = $req->fetch();
    if( connectionAuto() == true){

    echo"Vous etes connectés";
    exit;
    }
}


if ( isset ($_POST) && !empty($_POST)) {


    $errorCounter = 0;

    if (!isset($_POST['pseudo']) || empty($_POST['pseudo'])) {
        echo 'Pseudo manquant!';
        $errorCounter++;
    }

    if (!isset($_POST['password']) || empty($_POST['password'])) {
        echo 'Pwd manquant!';
        $errorCounter++;
    }

    if ($errorCounter === 0) {

        $res = userConnect();

        $isPasswordCorrect = password_verify($_POST['password'], $res['pass']);
        if (!$res) {
            echo 'Mauvais identifiant ou mot de passe 1!';
        } else {
            if ($isPasswordCorrect) {
                session_start();
                $_SESSION['id'] = $res['id'];
                $_SESSION['pseudo'] = $_POST['pseudo'];
                if ( isset( $_POST['check'] ) && $_POST['check'] === "on" ) {
                    setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
                    setcookie('pass', $res['pass'], time() + 365*24*3600, null, null, false, true);
                }

                echo 'Vous êtes connecté !';
            } else {
                echo 'Mauvais identifiant ou mot de passe !2';
            }
        }
    }
}


require('connectionView.php');

