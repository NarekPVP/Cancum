<?php


namespace app\controllers;

use app\models\User;

class UserController extends AppController
{

    public function registerAction()
    {
        if(isset($_SESSION['user'])) redirect();
        if(!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if($user->validate($data) || $user->checkUnique())
            {
                $_SESSION['form_data'] = $data;
                if($user->save('user'))
                {
                    if(isset($data['password2'])) if($user->attributes['password'] === $data['password2']){
                        ///
                    }else{
                        //redirect(false, 'error', 'Enter password again');
                    }

                    $user->attributes['password'] = password_hash($user->attributes['password'], 1);
                    if(!isset($_SESSION['user']))
                    {
                        redirect('login', 'success', 'User successfully registered, please login');
                    }
                    else
                    {
                        redirect(PATH, 'success', 'User successfully registered');
                    }

                }
                else
                {
                    $_SESSION['error'] = "Table not found!";
                }
            }
            else
            {
                $user->errors();
                redirect();
            }
        }
        $this->setMeta("Registration");
    }

    public function loginAction()
    {
        if(isset($_SESSION['user'])) redirect();
        if(!empty($_POST))
        {
            $data = $_POST;
            // dd($data);
            $user = new User();
            if($user->login())
            {
                redirect(PATH);
            }
            else
            {
                $_SESSION['error'] = 'Invalid login or password';
            }
            //setcookie ($name, $value = "", $expire = 0, $path = "", $domain = "", $secure = false, $httponly = false) {}
            setcookie("user", $_SESSION['user'], time() + 3600*24*7); //
        }
        $this->setMeta("Login");
    }

    public function logoutaction()
    {
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect();
    }

    public function settingsAction(){
        if(!isset($_SESSION['user'])) redirect();
        if(!empty($_POST)){
            $data = $_POST;
            $user = new User();
            $post_data = [
              'firstname' => $_SESSION['user']['firstname'],
              'lastname' => $_SESSION['user']['lastname'],
              //'email' => $_SESSION['user']['email'],
              'description' => $_SESSION['user']['description'],
              'location' => $_SESSION['user']['location'],
              'workplace' => $_SESSION['user']['workplace'],
              'relationship' => $_SESSION['user']['relationship'],
            ];

            $user->changeSettings($data, $post_data);
            redirect();
        }
    }

    public function profileAction(){
        if(!empty($_GET)){
            $id = $_GET['id'];
            $posts = \R::findAll("posts", "user_id = ?", [$id]);

        }

        $this->set(compact('id', 'posts'));
    }

}