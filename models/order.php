<?php

class Order{
    private $id;
    private $user_id;
    private $province; 
    private $location; 
    private $address;
    private $cost;
    private $status;
    private $date;
    private $hour;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function get_id(){
        return $this->id;
    }
    
    function get_user_id(){
        return $this->user_id;
    }

    function get_province(){
        return $this->province;
    }

    function get_location(){
        return $this->location;
    }

    function get_address(){
        return $this->address;
    }

    function get_cost(){
        return $this->cost;
    }

    function get_status(){
        return $this->status;
    }

    function get_date(){
        return $this->date;
    }

    function get_hour(){
        return $this->hour;
    }

    function set_id($id) {
        $this->id = $id;
    }
    
    function set_user_id($user_id) {
        $this->user_id = $user_id;
    }

    function set_province($province) {
        $this->province = $this->db->real_escape_string($province);
    }   

    function set_location($location){
        $this->location = $this->db->real_escape_string($location);
    }

    function set_address($address){
        $this->address = $this->db->real_escape_string($address);
    }

    function set_cost($cost){
        $this->cost = $cost;
    }

    function set_status($status){
        $this->status = $status;
    }

    function set_date($date){
        $this->date = $date;
    }

    function set_hour($hour){
        $this->hour = $hour;
    }

    public function get_all(){
        $products = $this->db->query("SELECT * FROM orders ORDER BY id DESC;");
        return $products;
    }           
    
    public function get_one(){
        $product = $this->db->query("SELECT * FROM orders WHERE id = {$this->get_id()};");
        return $product->fetch_object();
    }

    public function get_one_by_user(){
        $sql = ("SELECT o.id, o.cost * FROM orders op
                -- INNER JOIN order_lines ol ON ol.order_id = o.id 
                WHERE o.user_id = {$this->get_user_id()} ORDER BY id DESC LIMIT 1;");        

        $order = $this->db->query($sql);
        return $order->fetch_object();
    }

    public function get_all_by_user(){
        $sql = ("SELECT o.*, o.cost * FROM orders o                
                WHERE o.user_id = {$this->get_user_id()} ORDER BY id DESC;");        

        $order = $this->db->query($sql);
        return $order;
    }

    public function get_products_by_order($id){
        // $sql = "SELECT * FROM products WHERE id IN(
        //         SELECT product_id FROM order_lines WHERE order_id={$id});";

        $sql = "SELECT p.*, ol.units FROM products p 
                INNER JOIN order_lines ol ON p.id = ol.product_id 
                WHERE ol.order_id={$id};";

        $products = $this->db->query($sql);
        return $products;        
    }

    public function save(){
        $result = false;
        
        $sql = "INSERT INTO orders VALUES(NULL, '{$this->get_user_id()}', '{$this->get_province()}', 
        '{$this->get_location()}', '{$this->get_address()}', {$this->get_cost()}, 'confirm', CURDATE(), CURTIME());";

        $save = $this->db->query($sql);
        if($save){
            $result = true;
        }

        return $result;  
    }

    public function save_line(){        
        $result = false;
        $sql = "SELECT LAST_INSERT_ID() as 'order';";
        $query =  $this->db->query($sql);
        $order_id = $query->fetch_object()->order;

        foreach($_SESSION['cart'] as $element){
            $product = $element['product'];

            $insert = "INSERT INTO order_lines VALUES (NULL,{$order_id}, {$product->id}, {$element['units']});";
            $save = $this->db->query($insert);
        }

        if($save){
            $result = true;
        }

        return $result;  
    }

    public function edit(){        
        $result = false;    
        
        $sql = "UPDATE orders SET status='{$this->get_status()}' 
                WHERE id={$this->get_id()};";

        $save = $this->db->query($sql);
        if($save){
            $result = true;
        }

        return $result;                             
    }
}

?>