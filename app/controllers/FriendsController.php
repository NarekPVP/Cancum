<?php


namespace app\controllers;


use app\helpers\Is;
use app\models\Friends;

class FriendsController extends AppController {

    public function sendRequestAction(){
        if(!empty($_GET)){
            $id = $_GET['id'];
            $friends = new Friends();
            if($id == $_SESSION['user']['id']){
                $_SESSION['error'] = "Don't send request to you!";
            }

            if(Is::user($id) && !Is::friend($id, $_SESSION['user']['id'])){
                $request = \R::dispense("requests");
                $request->receiver = $id;
                $request->sender = $_SESSION['user']['id'];
                // save
                $friends->save($request);
            }else{
                $_SESSION['error'] = "User not found!";
            }
        }
        redirect(PATH, "error", "Something went wrong");
    }

    public function ignoreAction (){
        if(!empty($_GET)){
            $id = $_GET['id'];
            $friend = new Friends();
            $friend->deleteRequest($id);
        }
    }

    public function acceptAction(){
        if(!empty($_GET)) {
            $id = $_GET['id'];
            $request = \R::findOne("requests", "id = ?", [$id]);
            $model = new Friends();
            if(Is::user($request->sender) && is::user($request->receiver)){
                $friend = \R::dispense("friends");
                $friend2 = \R::dispense("friends");

                $friend->request_id = $request->id;
                $friend->user_one = $request->sender;
                $friend->user_two = $request->receiver;

                $friend2->request_id = $request->id;
                $friend2->user_one = $request->receiver;
                $friend2->user_two = $request->sender;

                \R::store($friend);
                \R::store($friend2);
                // delete request
                $model->deleteRequest($id);
                $_SESSION['success'] = "Friend has been added";
            }
        }
        redirect();
    }

}