<?php



function testme() {

    echo "test me works...";
}

function getUser() {

    var_dump($_POST);

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $req = $bdd->prepare('SELECT id FROM members WHERE pseudo = :pseudo');
    $req->execute(array(
        'pseudo' => $_POST['pseudo']));


    return $req;
}

function registerUser()
{

    var_dump($_POST);
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
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

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

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

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $req = $bdd->prepare("SELECT id, pass FROM members WHERE pseudo = :pseudo");
    $res = $req->execute(array(
        'pseudo' => $_POST['pseudo'],
    ));

    var_dump($res);

    $resultat = $req->fetch();
    return $resultat;
}

function logout(){

    // Suppression des variables de session et de la session
    $_SESSION = array();
    session_destroy();

    // Suppression des cookies de connexion automatique
    setcookie('pseudo', '');
    setcookie('pass', '');
}

