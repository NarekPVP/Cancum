<?php


namespace app\controllers;


use app\helpers\File;
use app\helpers\Is;
use app\helpers\Post;
use app\helpers\Str;
use app\models\Posts;

class PostsController extends AppController {

    public function editAction(){
        if(!empty($_GET)){
            $id = $_GET['id'];
            $errors = [];
            $categories = \R::findAll("categories");
            if(!empty($_POST)){
                $data = $_POST;
                Posts::validate($data);
                $post = \R::findOne('posts', "id = ?", [$id]);
                if($post){
                    $post->title = $data['title'];
                    $post->content = $data['content'];
                    $post->category_id = $data['category'];
                    if(!empty($_FILES)){
                        $files = File::sortFilesArray('images');
                        $file_dir = 'assets/images/post';
                        $sql_save_line = File::upload($files, $file_dir, Posts::$file_allowed_types, false);
                        if(!$sql_save_line) array_push($errors, "Something went wrong with files");
                        if($post->img){
                            $post->img .= "|";
                            $post->img .= $sql_save_line;
                        }else{
                            $post->img = $sql_save_line;
                        }
                    }
                    if(empty($errors)) $this->save($post, "Post has been changed");
                }


            }else{ array_push($errors, "Nothing found"); }

        }

        $this->set(compact('id', 'categories'));
    }

    public function deleteImageAction(){
        if(Is::ajax()){
            if(!empty($_GET)){
                $post_id = $_GET['id'];
                $path = $_GET['path'];
                $model = new Posts();

                $post = Post::get($post_id);
                if($post){
                    if(strpos($post->img, $path)){
                        str_replace($path, "", $post->img);
                    }
                    
                    if(file_exists($path)){
                        unlink($path);
                    }

                    $model->save($post);
                }
            }
        }
        redirect();
    }

    public function deleteAllImagesAction(){
        if(!empty($_GET)){
            $id = $_GET['id'];
            $post = Post::get($id);
            if($post->img){
                if(strpos($post->img, "|")){
                    $files = explode('|', $post->img);
                    foreach($files as $path){
                        if(is_file($path)){
                            unlink($path);
                        }
                    }
                    $post->img = "";
                    $model = new Posts();
                    $model->save($post);
                }
            }else{
                redirect(false, "error", "No images found to delete");
            }

        }
    }

    public function deleteAction(){
        if(!empty($_GET)){
            if($post = \R::findOne("posts", "id = ?", [$_GET['id']])){
                // delete post images
                if($post->img){
                    if(strpos($post->img, "|")){
                        $images = explode('|', $post->img);
                        foreach ($images as $image){
                            if(is_file($image)){
                                unlink($image);
                            }
                        }
                    }else{
                        if(is_file($post->img)){
                            unlink($post->img);
                        }
                    }
                }

                \R::trash($post);
                redirect(false, 'success', "Post has been deleted!");
            }else{
                redirect(false, 'error', "Post not found!");
            }
        }
    }

    public function likeAction(){
        if(!empty($_GET)){
            if(Is::ajax()){
                if($like = \R::findOne("likes", "post_id = ? AND user_id = ?", [$_GET['id'], $_SESSION['user']['id']])){
                    if($like) \R::trash($like);
                }else{
                    $post_like = \R::dispense("likes");
                    $post_like->post_id = $_GET['id'];
                    $post_like->user_id = $_SESSION['user']['id'];
                    \R::store($post_like);
                }
            }
        }
        redirect();
    }

}