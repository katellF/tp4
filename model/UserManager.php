<?php
namespace OpenClassrooms\Blog\Model;
require_once("model/Manager.php");

class UserManager extends Manager
{
    public function getUser(){

        $db = $this->dbConnect();

        $req = $db->prepare('SELECT id FROM members WHERE pseudo = :pseudo');
        $req->execute(array(
            'pseudo' => htmlspecialchars($_POST['pseudo'])));


        return $req;
    }

    public function registerUser(){

        $db = $this->dbConnect();

        // Insertion
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $req = $db->prepare('INSERT INTO members(pseudo, pass, email, registration_date) VALUES(:pseudo, :pass, :email, CURDATE())');


        $res = $req->execute(array(
            'pseudo' => $_POST['pseudo'],
            'pass' => $pass_hache,
            'email' => $_POST['email']));

        echo'Bienvenue chez nous';
        exit;
    }

    public function connectionAuto(){

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

    public function userConnect(){

        $db = $this->dbConnect();

        $req = $db->prepare("SELECT id, pass FROM members WHERE pseudo = :pseudo");
        $res = $req->execute(array(
            'pseudo' => $_POST['pseudo'],
        ));

        $resultat = $req->fetch();
        return $resultat;
    }

    public function getLogout(){

        // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();

        // Suppression des cookies de connexion automatique
        setcookie('pseudo', '');
        setcookie('pass', '');
    }
}