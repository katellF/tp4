<?php
session_start();
require('model.php');


if ( isset( $_POST['action'] ) && $_POST['action'] === "logout" )
{
    getLogout();
}

if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}

var_dump($_POST);
var_dump($_SESSION);

if (empty($_SESSION))
{
    echo'Aurevoir et à bientôt! ';
    exit;
} else
{
    require('logoutView.php');
}