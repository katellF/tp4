<?php
session_start();
require('model.php');

if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}

if ( isset( $_POST['action'] ) && $_POST['action'] === "logout" )
{
    logout();
}

var_dump($_POST);
var_dump($_SESSION);

if (empty($_SESSION))
{
    echo'Aurevoir et à bientôt! ';
} else
{
    require('logoutView.php');
}