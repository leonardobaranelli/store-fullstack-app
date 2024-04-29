<?php

class Product{
    private $id;
    private $category_id;
    private $name; 
    private $description; 
    private $price;
    private $stock;
    private $offer;
    private $date;
    private $image;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function get_id(){
        return $this->id;
    }
    
    function get_category_id(){
        return $this->category_id;
    }

    function get_name(){
        return $this->name;
    }

    function get_description(){
        return $this->description;
    }

    function get_price(){
        return $this->price;
    }

    function get_stock(){
        return $this->stock;
    }

    function get_offer(){
        return $this->offer;
    }

    function get_date(){
        return $this->date;
    }

    function get_image(){
        return $this->image;
    }

    function set_id($id) {
        $this->id = $id;
    }
    
    function set_category_id($category_id) {
        $this->category_id = $category_id;
    }

    function set_name($name) {
        $this->name = $this->db->real_escape_string($name);
    }   

    function set_description($description){
        $this->description = $this->db->real_escape_string($description);
    }

    function set_price($price){
        $this->price = $this->db->real_escape_string($price);
    }

    function set_stock($stock){
        $this->stock = $this->db->real_escape_string($stock);
    }

    function set_offer($offer){
        $this->offer = $this->db->real_escape_string($offer);
    }

    function set_date($date){
        $this->date = $date;
    }

    function set_image($image){
        $this->image = $image;
    }

    public function get_all(){
        return $this->db->query("SELECT * FROM products ORDER BY id DESC;");
    }

    public function get_all_by_category(){
        $sql = "SELECT p.*, c.name AS 'category_name' FROM products p 
                INNER JOIN categories c ON c.id = p.category_id
                WHERE p.category_id = {$this->get_category_id()}
                ORDER BY id DESC";
        $products = $this->db->query($sql);
        return $products;
    }
        
    public function get_random($limit){
        return $this->db->query("SELECT * FROM products ORDER BY RAND() LIMIT $limit;");
    }

    public function get_one(){
        $product = $this->db->query("SELECT * FROM products WHERE id = {$this->get_id()};");
        return $product->fetch_object();
    }

    public function save(){
        $result = false;
        
        $sql = "INSERT INTO products VALUES(NULL, '{$this->get_category_id()}', '{$this->get_name()}', 
        '{$this->get_description()}', '{$this->get_price()}', '{$this->get_stock()}', NULL, CURDATE(), '{$this->get_image()}');";

        $save = $this->db->query($sql);
        if($save){
            $result = true;
        }

        return $result;  
    }

    public function edit(){
        $result = false;
        
        $sql = "UPDATE products SET (name='{$this->get_name()}', description='{$this->get_description()}', 
        price={$this->get_price()}, stock={$this->get_stock()}, category_id={$this->get_category_id()}";

        if($this->get_image() != null){
            $sql .= ", image={$this->get_image()}'";
        }
        $sql .= " WHERE id={$this->id});";

        $save = $this->db->query($sql);
        if($save){
            $result = true;
        }

        return $result;  
    }

    public function delete(){
        $result = false;
        
        $sql = "DELETE FROM products WHERE id={$this->id};";
        $delete = $this->db->query($sql);

        if($delete){
            $result = true;
        }

        return $result;
    }
}

?>