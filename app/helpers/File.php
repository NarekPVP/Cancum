<?php


namespace app\helpers;

use ishop\App;

class File extends Helper{

    public static function uplaodSingle($file_sorted_arary, $file_dir, $file_ext = [], $image_only = false){
        $errors = [];
        $sql_save_line = "";
        $file = $file_sorted_arary;
        if(!is_dir($file_dir)){
           array_push($errors, "Something is wrong with directory!");
        }

        if(!empty($_FILES) && isset($file)) {
            $accepted_file_size = (int)App::$app->getProperty('base_file_size');
            if ($accepted_file_size <= 0)
                throw new \Exception("file size setting must be higher then 0", 505);

            if($file['size'] > $accepted_file_size){
                array_push($errors, "File is to large");
            }
            if($image_only && !self::isImage($file)){
                array_push($errors, "File {$file['old_name']} is not an image");
            }
            $target_file = $file_dir . "/" . $file['name'];
            $ext = explode('.', $file['name']);
            $ext = end($ext);

            // check file accepted types
            if(!empty($file_ext)) if(!in_array($ext, $file_ext)) {
                array_push($errors, "{$ext} file types not allowed");
            }

            // upload files

            if(empty($errors)){
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return $target_file;
                } else {
                    echo "<div class='text-error'>Sorry, there was an error uploading your file.</div>";
                }
            }
         }
        return false;
    }

    public static function upload($file_sorted_arary, $file_dir, $file_ext = [], $image_only = false)
    {
        $errors = [];
        $sql_save_line = "";
        $files = $file_sorted_arary;
        if(!is_dir($file_dir)){
            array_push($errors, "Something is wrong with directory!");
        }

        if(!empty($_FILES) && isset($files)){
            $accepted_file_size = (int)App::$app->getProperty('base_file_size');
            if($accepted_file_size <= 0) throw new \Exception("file size setting must be higher then 0", 505);

            foreach($files as $file){
                if($file['size'] > $accepted_file_size){
                    array_push($errors, "File is to large");
                }
                if($image_only && !self::isImage($file)){
                    array_push($errors, "File {$file['old_name']} is not an image");
                }
                $target_file = $file_dir . "/" . $file['name'];
                $ext = explode('.', $file['name']);
                $ext = end($ext);

                // check file accepted types
                if(!empty($file_ext)) if(!in_array($ext, $file_ext)) {
                    array_push($errors, "{$ext} file types not allowed");
                }

                // upload files
                if(empty($errors)){
                    if (move_uploaded_file($file["tmp_name"], $target_file)) {

                        if($sql_save_line == ""){
                            $sql_save_line = $file_dir . "/" . $file['name'] . "|";
                        }else{
                            $sql_save_line .= $file_dir . "/" . $file['name'] . "|";
                        }

                    } else {
                        echo "<div class='text-error'>Sorry, there was an error uploading your file.</div>";
                    }
                }

            }

        }

        if(empty($errors) && $sql_save_line != ""){
            return substr($sql_save_line, 0, -1);
        }else{
            dd($errors);
        }

        return false;
    }

    public static function sortFilesArray($files_input_name = 'files'){
        $files_array = [];

        for ($i = 0; $i < count($_FILES[$files_input_name]['name']); $i++){
            $file = $_FILES[$files_input_name];

            $name = $_FILES[$files_input_name]['name'][$i];
            $files_array[$file['name'][$i]]['old_name'] = $file['name'][$i];
            $ext = explode('.', $name);
            $file_name = date('Y-m-d') . '-' . uniqid() . '.' . end($ext);
            //array_push($files[$file_name], $file_name);
            $_FILES[$files_input_name]['name'][$i] = $file_name;

            $files_array[$file['name'][$i]]['name'] = $file_name;
            $files_array[$file['name'][$i]]['type'] = $file['type'][$i];
            $files_array[$file['name'][$i]]['tmp_name'] = $file['tmp_name'][$i];
            $files_array[$file['name'][$i]]['error'] = $file['error'][$i];
            $files_array[$file['name'][$i]]['size'] = $file['size'][$i];
        }

        return $files_array;
    }

    public static function sortSingleFilesArray($files_input_name = 'files'){
        $file = $_FILES[$files_input_name];
        $ext = explode('.', $file['name']);
        $file['old_name'] = $file['name'];
        $file_name = date('Y-m-d') . '-' . uniqid() . '.' . end($ext);
        $file['name'] = $file_name;
        /*
         *  [image] => Array
                 (
                     [name] => daefae7d8awd7a8wd7.png
                     [old_name] => Laravel.png
                     [type] => image/png
                     [tmp_name] => C:\OpenServer\userdata\php_upload\php1265.tmp
                     [error] => 0
                     [size] => 19937
                 )

         *
         */
        return $file;
    }

    public static function download($filePath, $contentDescription = "File Transfer", $contentType = "application/octet-stream", $expires = 0, $cacheControl = "must-revalidate", $pragma = "public"){
        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
        }
    }

    protected static function isImage($file){
        $check = getimagesize($file["tmp_name"]);
        if($check[2] == 2) {
            return true;
        } else {
            return false;
        }
    }

}