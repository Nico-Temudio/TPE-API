<?php

class productModel{
    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_cafeteria;charset=utf8', 'root', '');
    }

    function getProducts(){
        $query = $this->db->prepare("SELECT p.nombre as nombre, p.precio as precio, p.descripcion as descripcion, p.id as id, c.nombre as nombre_categoria FROM producto p INNER JOIN categoria c ON p.id_categoria= c.id;");
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ); 
        
        return $productos;
    }

    function orderProducts($order){
        $query = $this->db->prepare("SELECT p.nombre as nombre, p.precio as precio, p.descripcion as descripcion, p.id as id, c.nombre as nombre_categoria FROM producto p INNER JOIN categoria c ON p.id_categoria= c.id  ORDER BY nombre $order");
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getProductsByCategory($params){
        $query = $this->db->prepare("SELECT p.nombre as nombre, p.precio as precio, p.id as id, p.imagen as imagen, c.nombre as nombre_categoria FROM producto p INNER JOIN categoria c ON p.id_categoria= c.id AND c.id=?;");
        $query->execute(array($params));
        $productos = $query->fetchAll(PDO::FETCH_OBJ); 
        
        return $productos;
    }


    function getProductById($params){
        $query = $this->db->prepare("SELECT p.nombre as nombre, p.precio as precio, p.descripcion as descripcion , p.id as id, c.nombre as nombre_categoria FROM producto p INNER JOIN categoria c ON p.id_categoria= c.id where p.id=?;");
        $query->execute(array($params));
        $product = $query->fetch(PDO::FETCH_OBJ);
        
        return $product;

    }


    function save($nombre, $precio, $categoria, $descripcion, $imagen = null) {
        $pathImg = "";
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);

        $query = $this->db->prepare('INSERT INTO producto(id, nombre, precio, descripcion, imagen, id_categoria) VALUES(null,?,?,?,?,?)');
        $query->execute([$nombre, $precio, $descripcion, $pathImg, $categoria]);

    }



    function edit($nombre, $precio, $categoria, $id,$descripcion,$imagen = null) {
        $pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);
        $query = $this->db->prepare("UPDATE producto SET nombre = ?, precio = ?, descripcion = ?, imagen = ?, id_categoria = ? WHERE producto.id = ?");
        $query->execute([$nombre, $precio, $descripcion, $pathImg, $categoria, $id]);
    }


        
    private function uploadImage($image){
        $pathImg = 'images/' . uniqid() . '.jpg';
        move_uploaded_file($image, $pathImg);
        return $pathImg;
    }
    
    function delete($idProducto,) {
        $query = $this->db->prepare('DELETE FROM producto WHERE id = ?');
        $query->execute([$idProducto]); 
    }






}