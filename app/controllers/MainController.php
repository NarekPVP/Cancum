<?php

namespace app\controllers;

use app\models\Main;
use ishop\Cache;

class MainController extends AppController {

    public function indexAction(){
        if(!isset($_SESSION['user'])){
            redirect('user/login');
        }

        // gettings posts and stories
        $posts = \R::findAll("posts");
        $stories = \R::findAll("stories");

        // creating/updating uploading post
        $main = new Main();
        $post = $main->uploadPost($_POST, 'posts');

        // gettings requests
        $requests = \R::findAll('requests', "receiver = ?", [$_SESSION['user']['id']]);
        $count_requests = \R::count('requests', "receiver = ?", [$_SESSION['user']['id']]);

        // gettings friends
        $friends = \app\helpers\User::friends();

        $this->set(compact('stories', 'posts', 'requests', 'count_requests', 'friends'));
    }

}