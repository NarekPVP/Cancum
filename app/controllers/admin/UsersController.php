<?php


namespace app\controllers\admin;


class UsersController extends AppController{

    public function viewAction(){
        $users = \R::findAll("user");

        $this->set(compact('users'));
        $this->setMeta('Users');
    }

    public function createAction(){

    }

}