<?php

require('model/frontend.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

use \OpenClassrooms\Blog\Model\PostManager;
use \OpenClassrooms\Blog\Model\CommentManager;

// Chargement des classes

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: controleurRegistration.php?action=post&id=' . $postId);
    }
}

function registration(){

    if ( isset ($_POST) && !empty($_POST)){

        //exemple(utiliser directement nettoye?
        $post_pseudo = htmlspecialchars($_POST['pseudo']);

        $user = getUser();

        $errorCounter = 0;

        if ( $user->rowCount() === 0 ) {
            echo 'on peut ajouter pseudo';
        } else {

            echo 'On a deja ce pseudo';
            $errorCounter++;

        }

        if( strlen( htmlspecialchars($_POST['password'] )) < 6 ){

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

        require('view/frontend/registrationView.php');

    }
}

function connection(){

    if ( isset($_COOKIE['pseudo']) && isset($_COOKIE['pass']) ){

    echo $_COOKIE['pseudo'] .'     '. $_COOKIE['pass'].'<br><br>';

//$resultat = $req->fetch();
    if( connectionAuto() == true){

        echo"Vous etes connectés";
        exit;
    }
}

    if ( isset ($_POST) && !empty($_POST)) {


    $errorCounter = 0;

    if (!isset($_POST['pseudo']) || empty($_POST['pseudo'])){
        echo 'Pseudo manquant!';
        $errorCounter++;
    }

    if (!isset($_POST['password']) || empty($_POST['password'])){
        echo 'Pwd manquant!';
        $errorCounter++;
    }

    if ($errorCounter === 0){

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

require('view/frontend/connectionView.php');


}

function logout(){

    var_dump($_SESSION);

    if ( isset( $_POST['action'] ) && $_POST['action'] === "logout" )
    {
        getLogout();
    }

    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
    {
        echo 'Bonjour ' . $_SESSION['pseudo'];
    }


    if (empty($_SESSION))
    {
        echo'Aurevoir et à bientôt! ';

    } else
    {
        require('view/frontend/logoutView.php');
    }
}


