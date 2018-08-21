<?php
require_once('controller/ControllerComment.php');
require_once('controller/ControllerPost.php');
require_once('controller/ControllerConnect.php');
require_once('view/frontend/View.php');



class Router
{
    private $ctrlPost;
    private $ctrlComment;
    private $ctrlConnect;

    public function __construct()
    {
        $this->ctrlPost = new ControllerPost();
        $this->ctrlComment = new ControllerComment();
        $this->ctrlConnect = new ControllerConnect();
    }


    public function routerRequete()
    {

        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'registration') {
                    $this->ctrlConnect->registration();
                    $this->ctrlConnect->isUserConnected();
                } elseif ($_GET['action'] == 'connection') {
                    connection();
                    isUserConnected();
                } elseif ($_GET['action'] == 'logout') {
                    logout();
                    isUserConnected();
                } elseif ($_GET['action'] == 'listPosts') {
                    listPosts();
                    isUserConnected();
                } elseif ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        post();
                        isUserConnected();
                    } else {
                        // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                } elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                            addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                            isUserConnected();
                        } else {
                            // Autre exception
                            throw new Exception('Tous les champs ne sont pas remplis !');
                        }
                    } else {
                        // Autre exception
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                } elseif ($_GET['action'] == 'billet') {

                    addPost();
                    isUserConnected();
                }

            } else {
                $this->ctrlPost->listPosts();
                $this->ctrlConnect->isUserConnected();
            }

        } catch (Exception $e) {

            echo 'Erreur : ' . $e->getMessage();
        }
    }
}