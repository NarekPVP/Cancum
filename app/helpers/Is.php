<?php


namespace app\helpers;


class Is extends Helper {

    public static function user($user_id = null){
        if($user_id == null) $user_id = $_SESSION['user']['id'];
        $user = \R::findOne("user", "id = ?", [$user_id]);
        if($user){
            return true;
        }

        return false;
    }

    public static function post($id){
        $post = \R::findOne('posts', "id = ?", [$id]);
        if($post){
           return true;
        }
        return false;
    }

    public static function friend($user_one, $user_two){
        if(!self::user($user_one) || !self::user($user_two)){
            return false;
        }
        if($friend = \R::findOne("friends", "user_one = ? AND user_two = ?", [$user_one, $user_two])){
            return true;
        }
        return false;
    }

    public static function ajax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}