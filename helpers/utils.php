<?php

class Utils{

    public static function delete_session($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name; 
    }

    public static function is_admin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function is_identify(){
        if(!isset($_SESSION['identify'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function show_categories(){
        require_once 'models/category.php';
        $category = new Category();
        $categories = $category->get_all();
        return $categories;
    }

    public static function stats_cart(){
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if(isset($_SESSION['cart'])){
            $stats['count'] = count($_SESSION['cart']);

            foreach($_SESSION['cart'] as $product){
                $stats['total'] += $product['price'] * $product['units'];
            }
        }

        return $stats;
    }

    public static function show_status($status){
        $value = 'Pending';
        if($status == 'pending'){
            $value = 'Pending';
        }elseif($status == 'preparation'){
            $value = 'On Preparation';
        }elseif($status == 'ready'){
            $value = 'Ready to Ship';
        }elseif($status == 'sent'){
            $value = 'Sent';
        }

        return $value;
    }
}

?>