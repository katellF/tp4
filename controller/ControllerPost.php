<?php

require_once "model/PostManager.php";
require_once "model/CommentManager.php";
require_once('view/frontend/View.php');


use \OpenClassrooms\Blog\Model\PostManager;
use \OpenClassrooms\Blog\Model\CommentManager;

class ControllerPost
{

// Chargement des classes

    public function __construct()
    {
        $this->ctrlConnect = new ControllerConnect();
    }


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

    function addPost()
    {
        if (isset ($_POST) && !empty($_POST)) {
            if(isUserConnected()) {
                insertPost();
            }
            else{

                throw new Exception('Vous n avez pas acces à cette page!');
            }
        }

        require('view/frontend/addPostView.php');
    }

}