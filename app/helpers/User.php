<?php


namespace app\helpers;


class User extends Helper {

    public static function get($id){
        return \R::findOne('user', "id = ?", [$id]);
    }

    public static function getUserFullName($id = null){
        if($id == null) $id = $_SESSION['user']['id'];
        $user = self::get($id);
        if($user){
            return $user->firstname . " " . $user->lastname;
        }
        return "User not found!";
    }

    public static function getImgCode($id = null, $classes = "", $width = "", $height = "", $href = true){
        if($id == null) $id = $_SESSION['user']['id'];
        $user = self::get($id);

        if($user->img != ""){
            if(is_file($user->img)){
                if($href == false){
                    echo "<img src='{$user->img}' class='bg-gray-200 border border-white rounded-full w-11 h-11 {$classes}' style='width: {$width}; height: {$height}; '>";
                }else{
                    echo "<img href='user/profile?id={$user->id}' src='{$user->img}' class='bg-gray-200 border border-white rounded-full w-11 h-11 {$classes}' style='width: {$width}; height: {$height}; '>";
                }


            }
        }else{
            if($href == false){
                echo "<img src='assets/images/default-user.jpg' class='bg-gray-200 border border-white rounded-full w-11 h-11 {$classes}' style='width: {$width}; height: {$height}; '>";
            }else{
                echo "<img href='user/profile?id={$user->id}' src='assets/images/default-user.jpg' class='bg-gray-200 border border-white rounded-full w-11 h-11 {$classes}' style='width: {$width}; height: {$height}; '>";
            }

        }
    }

    public static function friends($id = null){
        if($id == null) $id = $_SESSION['user']['id'];
        if(Is::user($id)){
            return \R::findAll("friends", "user_one = ?", [$id]);
        }else{
            return false;
        }
    }

    public static function isAdmin(){
        return $_SESSION['user']['role'] == 'admin';
    }

}