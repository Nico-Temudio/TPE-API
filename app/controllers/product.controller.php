<?php
require_once "app/models/product.model.php";
require_once "app/models/category.model.php";
require_once "app/views/api.view.php";

class ProductController{
        private $model;
        private $modelCat;
        private $view;
        private $data;

    function __construct(){
        $this->model = new productModel();
        $this->modelCat = new categoryModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    function getData() {
        return json_decode($this->data);
    }

    function getProducts() {
        $params=$_GET;
        if((count($params)=='1')&&(empty($param))){
            $products = $this->model->getProducts();
            $this->view->response($products);
        }
        else{
            foreach($params as $param =>$key){
                switch ($param) {
                    case 'order':
                    if(!empty($key==="asc")){
                        $order=ucfirst($key); //paso el parametro a mayuscula para poder usarlo en MySQL
                        $products = $this->model->orderProducts($order);
                        $this->view->response("producto agregado con exito");
                        $this->view->response($products);
                        $this->view->response("producto agregado con exito");
                    }
                    else if (!empty($key==='desc')){
                        $order=ucfirst($key);
                        $products = $this->model->orderProducts($order);
                        $this->view->response($products);
                    }
                    else{
                        //sino devuelve todo desordenado
                        if(empty($key)){
                            $this->view->response("producto agregado con exito");
                        $products = $this->model->getProducts();
                        $this->view->response($products);
                        }
                    }
                        break;
                    default:
                        if(empty($key)){
                        $products = $this->model->getProducts();
                        $this->view->response($products); 
                        $this->view->response("producto agregado con exito");
                        }
                        break;
                    }
            }  
        } 
        
    }
    function getProduct($params = null) {
        $id = $params[':ID'];
        $product = $this->model->getProductById($id);
        if ($product)
            $this->view->response($product);
        else 
            $this->view->response("El producto con id=$id no existe", 404);
        
        $this->view->response($product);
    }
    function addProduct(){
        $product = $this->getData();

        if (empty($product->nombre) || empty($product->precio) || empty($product->descripcion)|| empty($product->categoria)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $this->model->save($product->nombre, $product->precio, $product->categoria,$product->descripcion, $product->imagen=null );
            $this->view->response("producto $product->nombre agregado con exito", 201);
        }
    }
    function deleteProduct($params = null){
        $id = $params[':ID'];
        $product = $this->model->getProductById($id);
        if ($product){
            $this->model->delete($id);
            $this->view->response("$product->nombre eliminado", 200);
        }
        else 
            $this->view->response("El producto con id=$id no existe", 404);
    }

}
