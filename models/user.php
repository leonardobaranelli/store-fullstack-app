<?php

class User{
    private $id;
    private $name;
    private $last_name;
    private $email;
    private $password;
    private $rol;
    private $image;    
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function get_id(){
        return $this->id;
    }
    
    function get_name(){
        return $this->name;
    }

    function get_last_name(){
        return $this->last_name;
    }

    function get_email(){
        return $this->email;
    }

    function get_password(){
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function get_rol(){
        return $this->rol;
    }

    function get_image(){
        return $this->image;
    }

    function set_id($id) {
        $this->id = $id;
    }
    
    function set_name($name) {
        $this->name = $this->db->real_escape_string($name);
    }

    function set_last_name($last_name) {
        $this->last_name = $this->db->real_escape_string($last_name);
    }

    function set_email($email) {
        $this->email = $this->db->real_escape_string($email);
    }
    
    function set_password($password) {
        $this->password = $password;
    }

    function set_rol($rol) {
        $this->rol = $rol;
    }

    function set_image($image) {
        $this->image = $image;
    }    

    public function save(){
        $result = false;
        
        $sql = "INSERT INTO users VALUES(NULL, '{$this->get_name()}', '{$this->get_last_name()}'
        , '{$this->get_email()}', '{$this->get_password()}', 'user', NULL);";

        $save = $this->db->query($sql);
        if($save){
            $result = true;
        }

        return $result;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;

        $sql = "SELECT * FROM users WHERE email = '$email';";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $user = $login->fetch_object();

            $verify = password_verify($password, $user->password);

            if($verify){
                $result = $user;
            }
        }

        return $result;
    }
}

?>