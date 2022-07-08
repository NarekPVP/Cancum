<?php


namespace app\models;


class Friends extends AppModel {

    public function save($bean){
        if(\R::store($bean)){
            redirect(false, "success", "Request has been send");
        }
    }

    public function deleteRequest($id){
       $request = \R::findOne("requests", "id = ?", [$id]);
       if($request){
           \R::trash($request);
       }
       redirect();
    }

}