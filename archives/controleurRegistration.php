<?php
require('frontend.php');
var_dump($_POST);

if ( isset ($_POST) && !empty($_POST)) {
    $user = getUser();

    $errorCounter = 0;

    if ( $user->rowCount() === 0 ) {
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

        registerUser();

    }
} else {

    require('registrationView.php');

}



//require('logoutView.php');
