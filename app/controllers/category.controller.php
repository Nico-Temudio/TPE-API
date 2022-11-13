<?php
require_once "app/models/category.model.php";
require_once "app/views/api.view.php";
class CatController{
    private $modelCat;
    private $view;
    private $data;

    function __construct(){
        $this->modelCat = new categoryModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    function getData() {
        return json_decode($this->data);
    }

    function getCategories(){
        $categories = $this->modelCat->getCategories();
        $this->view->response($categories);
    }

    function getCategory($params = null) {
        $id = $params[':ID'];
        $category = $this->modelCat->getCategory($id);
        if ($category)
            $this->view->response($category);
        else 
            $this->view->response("La categoria con id=$id no existe", 404);
    }
    function addCategory(){
        $category = $this->getData();

        if (empty($category->nombre)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $this->modelCat->addCategory($category->nombre);
            $this->view->response(" $category->nombre agregado a categorias ", 201);
        }
    }
    function deleteCategory($params = null){
        $id = $params[':ID'];
        $category = $this->modelCat->getCategory($id);
        if ($category){
            $this->modelCat->deleteCategory($id);
            $this->view->response("$category->nombre eliminado de categorias", 200);
        }
        else 
            $this->view->response("La categoria con id=$id no existe", 404);
    }
}



