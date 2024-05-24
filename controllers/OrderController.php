<?php
require_once 'models/orders.php';

class orderController{
    public function do(){
        
        require_once 'views/order/do.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : false;
            $province = isset($_POST['province']) ? $_POST['province'] : false;
            $location = isset($_POST['city']) ? $_POST['city'] : false;
            $address = isset($_POST['address']) ? $_POST['address'] : false;

            $stats = Utils::stats_cart();
            $cost = $stats['total'];

            if($user_id && $province && $location && $address){
                $order = new Order();
                $order->set_user_id($user_id);
                $order->set_province($province);
                $order->set_location($location);
                $order->set_address($address);
                $order->set_cost($cost);

                $save = $order->save();
                
                $save_line = $order->save_line();    

                if($save && $save_line){
                    $_SESSION['order'] = "completed";
                }else{
                    $_SESSION['order'] = "failed";
                }
            }else{
                $_SESSION['order'] = "failed";
            }

            header("Location:".base_url.'order/confirmed');

        }else{
            header("Location:".base_url);
        }
    }

    public function confirmed(){
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $order = new Order();
            $order->set_user_id($identity->id);
            $order = $order->get_one_by_user();

            $ordered_products = new Order();
            $products = $ordered_products->get_products_by_order($order->id);
        }

        require_once 'views/order/confirmed.php';
    }

    public function my_orders(){
        Utils::is_identify();
        $user_id = $_SESSION['identity']->id;
        $order = new Order();

        $order->set_user_id($user_id);
        $orders = $order->get_all_by_user();


        require_once 'views/order/my_orders.php';
    }

    public function detail(){
        Utils::is_identify();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $order = new Order();
            $order->set_id($id);
            $order = $order->get_one();

            $ordered_products = new Order();
            $products = $ordered_products->get_products_by_order($id);

            require_once 'views/order/details.php';
        }else{
            header('Location:'.base_url.'order/my_orders'); 
        }
    }

    public function management(){
        Utils::is_admin();        
        $management = true;

        $order = new Order();
        $orders = $order->get_all();

        require_once 'views/order/my_orders.php';      
    }

    public function status(){
        Utils::is_admin();
        if(isset($_POST['order_id']) && $_POST['status']){            
            $id = $_POST['order_id'];
            $status = $_POST['status'];

            $order = new Order();
            $order->set_id($id);
            $order->set_status($status);
            $order->edit();

            header("Location:".base_url.'order/detail&id='.$id);
        }else{
            header("Location:".base_url);
        }
    }
}

?>