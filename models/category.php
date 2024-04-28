<?php

class Category{
    private $id;
    private $name; 
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

    function set_id($id) {
        $this->id = $id;
    }
    
    function set_name($name) {
        $this->name = $this->db->real_escape_string($name);
    }   

    public function get_all(){
        return $this->db->query("SELECT * FROM categories ORDER BY id DESC;");
    }

    public function save(){
        $result = false;        

        $sql = "INSERT INTO users VALUES(NULL, '{$this->get_name()}');";
        $save = $this->db->query($sql);
        
        if($save){
            $result = true;
        }

        return $result;  
    }
}

?>