<?php
require_once 'models/user.php';

class userController{
    public function register(){
        require_once 'views/user/register.php';
    }

    public function save(){
        if(isset($_POST)){
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if($name && $last_name && $email && $password){
                $user = new User();
                $user->set_name($name);
                $user->set_last_name($last_name);
                $user->set_email($email);
                $user->set_password($password);
                $save = $user->save();

                if($save){
                    $_SESSION['register'] = "completed";
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }
        }else{
            $_SESSION['register'] = "failed";
        }
        header("Location:".base_url.'user/register');
    }

    public function login(){
        if(isset($_POST)){

            $user = new User();
            $user->set_email($_POST['email']);
            $user->set_password($_POST['password']);
            
            $identify = $user->login();

            if($identify && is_object($identify)){
                $_SESSION['identify'] = $identify; 

                if($identify->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = "Identification failed";
            }
        }
        header("Location:".base_url);
    }

    public function logout(){
        if(isset($_SESSION['identify'])){
            unset($_SESSION['identify']);
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }

        header("Location:".base_url);
    }
}

?>