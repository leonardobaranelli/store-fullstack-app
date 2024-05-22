<?php
require_once 'models/category.php';
require_once 'models/product.php';

class categoryController{
    public function index(){
        Utils::is_admin();
        $category = new Category();
        $categories = $category->get_all();
        
        return $categories;

        require_once "views/category/index.php";
    }

    public function see(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $category = new Category();
            $category->set_id($id);
            $category = $category->get_one();

            $product = new Product();
            $product->set_category_id($id);
            $products = $product->get_all_by_category($category);

            return $products;
        }

        require_once 'views/category/see.php';
    }

    public function create(){
        Utils::is_admin();
        require_once "views/category/create.php";
    }

    public function save(){
        Utils::is_admin();        
        if(isset($_POST['name'])){
            $category = new Category();
            $category->set_name($_POST['name']);
            $category->save();
        }

        header("Location:".base_url."category/index");
    }
}

?>