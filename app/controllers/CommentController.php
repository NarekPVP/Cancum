<?php


namespace app\controllers;


use app\helpers\Is;

class CommentController extends AppController {

    public function addAction(){
        if(!empty($_POST)){
            $content = $_POST['comment-content'];
            $post_id = $_POST['post-id'];
            $user_id = $_SESSION['user']['id'];

            $comment = \R::dispense("comments");
            $comment->content = $content;
            $comment->post_id = $post_id;
            $comment->user_id = $user_id;

            if(\R::store($comment)){
                redirect();
            }else{
                redirect(false, 'error', "Something went wrong!");
            }
        }
    }

    public function deleteAction(){
        if(!empty($_GET)){
            $id = $_GET['id'];
            if($comment = \R::findOne("comments", "id = ?", [$id])){
                if($comment->img){
                    // delete images
                }
                \R::trash($comment);
                redirect();
            }else{
                redirect(false, 'error', "Something went wrong!");
            }
        }
    }

}