<?php


namespace app\models;


use app\helpers\File;

class Main extends AppModel{

    protected $file_allowed_types = ['jpeg', 'png', 'jpg', 'svg'];

    public function uploadPost($data, $table = 'posts'){
        if(!empty($data)){
            $content = trim($data['content']);
            if(!isset($data['title'])){
                $data['title'] = preg_replace('/(\s*)([^\s]*)(.*)/', '$2', $content) . "...";
            }
            $post = \R::dispense($table);
            $post->title = $data['title'];
            $post->content = $content;
            $post->user_id = $_SESSION['user']['id'];

            if(!empty($_FILES)){
                $files = File::sortFilesArray('images');
                // upload($file_sorted_arary, $file_dir, $file_ext = [], $image_only = false)
                $file_dir = "assets/images/post";
                $sql_parts = File::upload($files, $file_dir, $this->file_allowed_types);
                $post->img = $sql_parts;

                //C:\OpenServer\domains\cancum.loc/public/assets/images/post/2021-08-05-610c30b90d712.jpg|C:\OpenServer\domains\cancum.loc/public/assets/images/post/2021-08-05-610c30b90d71a.png
            }

            $this->save($post);
        }
    }

    protected function save($bean){
        if(\R::store($bean)){
            redirect(PATH, 'success',"Post has been added!");
        }else{
            redirect(PATH, 'error',"Something went wrong, please try again later");
        }
    }

}