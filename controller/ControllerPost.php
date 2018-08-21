<?php

require_once "model/PostManager.php";
require_once "model/CommentManager.php";
require_once "model/UserManager.php";
require_once('view/frontend/View.php');


use \OpenClassrooms\Blog\Model\PostManager;
use \OpenClassrooms\Blog\Model\CommentManager;



class ControllerPost
{
    private $commentManager;
    private $postManager;
    private $ctrlConnect;

// Chargement des classes

    public function __construct()
    {
        $this->commentManager = new CommentManager();
        $this->postManager = new PostManager();
        $this->ctrlConnect = new ControllerConnect();
    }

    public function listPosts()
    {

        $posts = $this->postManager->getPosts(); // Appel d'une fonction de cet objet

        require('view/frontend/listPostsView.php');
    }

   public function post()
    {
        $this->postManager->getPost($_GET['id']);
        $this->commentManager->getComments($_GET['id']);

        require('view/frontend/postView.php');
    }

   public function addPost()
    {
        if (isset ($_POST) && !empty($_POST)) {
            if($this->ctrlConnect->isUserConnected()) {

                $this->postManager->insertPost();
            }
            else{

                throw new Exception('Vous n avez pas acces à cette page!');
            }
        }

        require('view/frontend/addPostView.php');
    }

}