<?php


namespace app\models;


use app\helpers\File;
use Valitron\Validator;

class User extends AppModel
{

    public $attributes = [
        'login' => '',
        'firstname' => '',
        'lastname' => '',
        'email' => '',
        'password' => '',
        'role' => 'user',
    ];

    public $rules = [
        'required' => [
          ['login'],
          ['firstname'],
          ['lastname'],
          ['email'],
          ['password'],
          ['checkbox'],
        ],
        'lengthMin' => [
          ['login', 5],
          ['name', 2],
          ['password', 6],
        ],
        'email' => [
          ['email']
        ],
    ];

    public $file_types = ["jpg", "png", "gif", "jpeg", "svg"];

    public $errors = [];

    public function checkUnique()
    {
        $user = \R::findOne('user', 'login = ? OR email = ?', [$this->attributes['login'], $this->attributes['email']]);
        if($user)
        {
            if($user->login == $this->attributes['login'])
            {
                $this->errors['unique'][] = 'Please enter another login!';
            }
            if($user->email == $this->attributes['email'])
            {
                $this->errors['unique'][] = 'Please enter another email!';
            }
            return false;
        }
        return true;
    }

    public function login($isAdmin = false)
    {
        $login = trim(!empty($_POST['login'])) ? trim($_POST['login']) : null;
        $password = trim(!empty($_POST['password'])) ? trim($_POST['password']) : null;

        if($login && $password)
        {
            if($isAdmin)
            {
                $user = \R::findOne('user', "login = ? AND role = 'admin'", [$login]);
            }
            else
            {
                $user = \R::findOne('user', 'login = ?', [$login]);
            }
            if($user)
            {
                if($user->password == $password)
                {
                    foreach($user as $k => $v)
                    {
                        if($k != 'password') $_SESSION['user'][$k] = $v;
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function load($data)
    {
       foreach($this->attributes as $name => $value)
       {
           if(isset($data[$name]))
           {
               $this->attributes[$name] = $data[$name];
           }
       }
   }

    public function save($table)
    {
        $bean = \R::dispense($table);
        foreach($this->attributes as $name => $value)
        {
            $bean->$name = $value;
        }

        $bean->name = $bean->firstname . " " . $bean->lastname;

        return \R::store($bean);
    }

    public function errors()
    {
        $errors = "<ul>";
        foreach($this->errors as $error)
        {
            foreach($error as $item)
            {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= "</ul>";
        $_SESSION['error'] = $errors;
    }

    public static function checkAuth()
    {
        return isset($_SESSION['user']);
    }

    public static function isAdmin()
    {
        return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
    }

    public function validate($data)
    {
        $v = new Validator($data);
        $v::lang('ru');
        $v->rules($this->rules);
        if($v->validate()){
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }

    public function changeSettings($data, $form_data){
        $id = $_SESSION['user']['id'];
        $user = \R::findOne('user', "id = ?", [$id]);
        $err = [];
        if(!$user) return false;

        foreach($form_data as $k => $v){
              if(isset($data[$k])){
                  if($data[$k] == ""){
                      continue;
                  }
                $user->$k = $data[$k];
              }else{
                $_SESSION['error'] = $k . " not found!";
                array_push($err, $k . " not found!");
              }
        }
        // check email

        if(isset($data['email'])){
            if($this->checkEmailUnique($data['email'])){
                $user->email = $data['email'];
            }else{
                array_push($err, "email already exists");
            }
        }

        // save
        if(!empty($err)){

            foreach ($err as $item) {
                $_SESSION['error'] .= $item . "<br/>";
            }

            return false;
        }

        // change user image

        if(!empty($_FILES)){
          // upload

          $sorted_files = File::sortSingleFilesArray('image');
          $file_save_dir = 'assets/images/users';

          $sql_save_line = File::uplaodSingle($sorted_files, $file_save_dir, $this->file_types);
          if($sql_save_line){
              $user->img = $sql_save_line;
          }
        }

        if(\R::store($user)){

        }else{
            $_SESSION['error'] = "Something went wrong!";
        }


    }

    protected function checkEmailUnique($email){
        $users = \R::findAll("user");
        foreach ($users as $user){
            if($user->id == $_SESSION['user']['id']){
                continue;
            }
            if($user->email === $email){
                return false;
            }else{
                return true;
            }
        }
    }

    protected function uploadUserImage($user){

    }

}