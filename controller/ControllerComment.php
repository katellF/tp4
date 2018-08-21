<?php
require_once "model/PostManager.php";
require_once "model/CommentManager.php";
require_once('view/frontend/View.php');


use \OpenClassrooms\Blog\model\CommentManager;

class ControllerComment
{
    function addComment($postId, $author, $comment)
    {
        $commentManager = new CommentManager();

        $affectedLines = $commentManager->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }

}