<?php
require_once "model/PostManager.php";
require_once "model/CommentManager.php";
require_once "model/UserManager.php";
require_once('view/frontend/View.php');

use \OpenClassrooms\Blog\model\UserManager;

class ControllerConnect
{
    private $UserConnect;

    public function __construct()
    {
        $this->UserConnect = new UserManager();

    }

    function registration(){

        if ( isset ($_POST) && !empty($_POST)){

            $post_pseudo = htmlspecialchars($_POST['pseudo']);

            $user = $this->UserConnect->getUser();

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

               $this->UserConnect->registerUser();

            }

        } else {

           $view = new View("registration");
           $view->generate(array());

        }
    }

    function connection(){

        if ( isset($_COOKIE['pseudo']) && isset($_COOKIE['pass']) ){

            echo $_COOKIE['pseudo'] .'     '. $_COOKIE['pass'].'<br><br>';


            if( $this->UserConnect->connectionAuto() == true){

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

                $res = $this->UserConnect->userConnect();

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

        $view = new View("connection");
        $view->generate(array());


    }

    function logout(){

        session_start();

        if ( isset( $_POST['action'] ) && $_POST['action'] === "logout" )
        {
            $this->UserConnect->getLogout();
        }

        if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
        {
            echo 'Bonjour ' . $_SESSION['pseudo'];
        }


        if (empty($_SESSION))
        {
            echo'Au revoir et à bientôt! ';

        } else
        {
            $view = new View("logout");
            $view->generate(array());
        }
    }
    function isUserConnected(){

        if ( isset($_SESSION) && isset($_SESSION['pseudo'])){

            echo'Vous êtes connectés '.$_SESSION['pseudo'].'!';

            return true;
        } else {
            return false;
        }
    }


}