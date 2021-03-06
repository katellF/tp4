<?php


function getUser(){

    var_dump($_POST);

    $bdd = dbConnect();

    $req = $bdd->prepare('SELECT id FROM members WHERE pseudo = :pseudo');
    $req->execute(array(
        'pseudo' => htmlspecialchars($_POST['pseudo'])));


    return $req;
}

function registerUser(){

    var_dump($_POST);

    $bdd = dbConnect();

    // Insertion
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $req = $bdd->prepare('INSERT INTO members(pseudo, pass, email, registration_date) VALUES(:pseudo, :pass, :email, CURDATE())');


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

    $bdd = dbConnect();

    // controle pour connexion automatique....
    $req = $bdd->prepare("SELECT id, pass FROM members WHERE pseudo = :pseudo AND pass = :pass");
    $req->execute(array(
        'pseudo' => $_COOKIE['pseudo'],
        'pass' => $_COOKIE['pass'],
    ));


    $resultat = $req->fetch();
    var_dump('asdasdsad ',$resultat);

    return $resultat;
}

function userConnect(){

    $bdd = dbConnect();

    $req = $bdd->prepare("SELECT id, pass FROM members WHERE pseudo = :pseudo");
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

 function insertPost()
{
    $db = dbConnect();
    $post = $db->prepare('INSERT INTO posts(id, title, content, creation_date) VALUES(?, :title, :content, NOW())');
    $affectedLines = $post->execute(array(
        'title' => $_POST['title'],
        'content' => $_POST['content'],
    ));

    return $affectedLines;
}

function dbConnect()
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    return $bdd;
}

