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

        $view = new View("listPosts");
        $view->generate(array('posts' => $posts));
       // require('view/frontend/listPostsView.php');
    }

   public function post()
    {
       $post = $this->postManager->getPost($_GET['id']);
       $comments = $this->commentManager->getComments($_GET['id']);
        $view = new View("post");
        $view->generate(array('post' => $post, 'comments' => $comments));

    }

   public function addPost()
    {
        session_start();

        if (isset ($_POST) && !empty($_POST)) {
            if( $this->ctrlConnect->isUserConnected() ) {

               $addPost =$this->postManager->insertPost();
               $view = new View("addPost");
               $view->generate(array('addPost' => $addPost));
            }
            else{

                throw new Exception('Vous n avez pas acces à cette page!');
            }
        } else {

            $view = new View("addPost");
            $view->generate(array());

           // require('view/frontend/addPostView.php');

        }



    }

}