<?php

namespace app\controllers;

use app\models\AppModel;
use ishop\base\Controller;

class AppController extends Controller{

    public function __construct($route){
        parent::__construct($route);
        new AppModel();
    }

    public function save($bean, $success = "success", $error = "Something went wrong!"){
        if(\R::store($bean)){
            $_SESSION['success'] = $success;
        }else{
            $_SESSION['error'] = $error;
        }
    }

}