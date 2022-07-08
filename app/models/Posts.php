<?php


namespace app\models;


class Posts extends AppModel{

    public static $file_allowed_types = ['jpeg', 'png', 'jpg', 'svg'];

    public static function validate($data){
        if(!empty($data)){
            if($data['title'] == ""){
                if(!empty($_SESSION['error'])){
                    $_SESSION['error'] .= "Title required";
                }else{
                    $_SESSION['error'] = "Title required";
                }

            }
            if($data['content'] == ""){
                if(!empty($_SESSION['error'])){
                    $_SESSION['error'] .= "Content required";
                }else{
                    $_SESSION['error'] = "Content required";
                }
            }

        }
    }

    public function save($bean){
        if(\R::store($bean)){
            redirect(PATH, 'success',"Post has been changed!");
        }else{
           redirect(PATH, 'error',"Something went wrong, please try again later");
        }
    }

}