<?php
require_once 'models/product.php';

class productController{
    public function index(){
        $product = new Product();
        $products = $product->get_random(6);
        
        require_once 'views/product/featured.php';
    }

    public function see(){
        if(isset($_GET['id'])){
            
            $_product = new Product();
            $_product->set_id($_GET['id']);
            
            $product = $_product->get_one();

        }
        require_once 'views/product/see.php';
    }

    public function management(){
        Utils::is_admin();
        $product = new Product();
        $products = $product->get_all();
        require_once 'views/product/management.php';
    }

    public function create(){
        Utils::is_admin();
        require_once 'views/product/create.php';
    }

    public function save(){
        Utils::is_admin(); 
        if(isset($_POST)){
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $description = isset($_POST['description']) ? $_POST['description'] : false;
            $price = isset($_POST['price']) ? $_POST['price'] : false;
            $stock = isset($_POST['stock']) ? $_POST['price'] : false;            
            $category = isset($_POST['category']) ? $_POST['category'] : false;                      

            if($name && $description && $price && $stock && $category){
                $product = new Product();
                $product->set_name($name);
                $product->set_description($description);
                $product->set_price($price);
                $product->set_stock($stock);
                $product->set_category_id($category);

                if(isset($_FILES['image'])){
                    $file = $_FILES['image'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];
    
                    if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }
    
                        $product->set_image($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                    }
                }               

                if(isset($_GET['id'])){
                    $product->set_id($_GET['id']);
                    $save = $product->edit();
                }else{
                    $save = $product->save();
                }

                $save = $product->save();
                if($save){
                    $_SESSION['product'] = "completed";
                }else{
                    $_SESSION['product'] = "failed";
                }
            }else{
                $_SESSION['product'] = "failed";
            }
        }else{
            $_SESSION['product'] = "failed";
        }
        header("Location:".base_url.'product/management');
    }

    public function edit(){
        Utils::is_admin();
        if(isset($_GET['id'])){
            $edit = true;

            $_product = new Product();
            $_product->set_id($_GET['id']);
            $product = $_product->get_one();

            require_once 'views/product/create.php';
        }else{
            header('Location:'.base_url.'product/management');
        }   
    }

    public function delete(){
        Utils::is_admin();

        if(isset($_GET['id'])){
            $product = new Product();
            $product->set_id($_GET['id']);

            $delete = $product->delete();
            if($delete){
                $_SESSION['delete'] = 'completed';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }

        header('Location:'.base_url.'product/management');
    }
}

?>