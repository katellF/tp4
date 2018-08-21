<?php
namespace OpenClassrooms\Blog\Model;
require_once("model/Manager.php");

class UserManager extends Manager
{
    function getUser(){

        var_dump($_POST);

        $db = $this->dbConnect();

        $req = $db->prepare('SELECT id FROM members WHERE pseudo = :pseudo');
        $req->execute(array(
            'pseudo' => htmlspecialchars($_POST['pseudo'])));


        return $req;
    }

    function registerUser(){

        var_dump($_POST);

        $db = $this->dbConnect();

        // Insertion
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $req = $db->prepare('INSERT INTO members(pseudo, pass, email, registration_date) VALUES(:pseudo, :pass, :email, CURDATE())');


        $res = $req->execute(array(
            'pseudo' => $_POST['pseudo'],
            'pass' => $pass_hache,
            'email' => $_POST['email']));

        var_dump($res);

        echo'Bienvenue chez nous';
        exit;
    }

    function connectionAuto(){

        var_dump($_POST);

        $db = $this->dbConnect();

        // controle pour connexion automatique....
        $req = $db->prepare("SELECT id, pass FROM members WHERE pseudo = :pseudo AND pass = :pass");
        $req->execute(array(
            'pseudo' => $_COOKIE['pseudo'],
            'pass' => $_COOKIE['pass'],
        ));


        $resultat = $req->fetch();
        var_dump('asdasdsad ',$resultat);

        return $resultat;
    }

    function userConnect(){

        $db = $this->dbConnect();

        $req = $db->prepare("SELECT id, pass FROM members WHERE pseudo = :pseudo");
        $res = $req->execute(array(
            'pseudo' => $_POST['pseudo'],
        ));

        var_dump($res);

        $resultat = $req->fetch();
        return $resultat;
    }

    function getLogout(){

        var_dump($_SESSION);

        // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();

        // Suppression des cookies de connexion automatique
        setcookie('pseudo', '');
        setcookie('pass', '');
    }



}