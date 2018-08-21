<?php

require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'registration') {
            registration();
            isUserConnected();
        }
        elseif ($_GET['action'] == 'connection') {
            connection();
            isUserConnected();
        } elseif ($_GET['action'] == 'logout') {
            logout();
            isUserConnected();
        }
        elseif ($_GET['action'] == 'listPosts') {
            listPosts();
            isUserConnected();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
                isUserConnected();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    isUserConnected();
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'billet'){

            addPost();
            isUserConnected();
        }

    } else {
        listPosts();
        isUserConnected();
    }

}

catch(Exception $e){

    echo 'Erreur : ' . $e->getMessage();
}