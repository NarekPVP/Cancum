<?php


namespace app\controllers;


use app\helpers\File;
use app\helpers\Is;
use app\migrations\CreateUserSettingsTable;
use app\migrations\Migration;
use app\migrations\tables\UpdateUserSettingsTable;

class TestController extends AppController{

    public function indexAction(){
        $table = new CreateUserSettingsTable();
        $updateTable = new UpdateUserSettingsTable();
        $updateTable->up();
        //$table->up();
    }

    public function deleteAction(){
        $table = new CreateUserSettingsTable();
        $table->down();
        redirect();
    }

    /*
     *
     * if(Is::ajax()){
                 if(!empty($_FILES)) {
                     // save files
                     $file_sorted_array = File::sortFilesArray('files');

                     $lines = File::upload($file_sorted_array, 'assets/images/test', [
                         'png', 'jpg', 'jpeg', 'svg'
                     ]);

                     return $lines;
                 }
             }
     * */

}