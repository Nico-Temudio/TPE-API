<?php

class categoryModel{
    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_cafeteria;charset=utf8', 'root', '');
    }

    function getCategories(){
        $query = $this->db->prepare("SELECT * FROM categoria WHERE 1;");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
    }
    function getCategory($id){
        $query = $this->db->prepare("SELECT * FROM categoria WHERE id=?;");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
    }

    function addCategory($category)
    {
        $query = $this->db->prepare("INSERT INTO categoria (id, nombre) VALUES (NULL,?);");
        $query->execute(array($category));
    }

    function deleteCategory($id_category)
    {
        $query = $this->db->prepare("DELETE FROM categoria WHERE id=?");
        return $query->execute(array($id_category));
    }

    function editCategory($category,$id_category)
    {
        $query = $this->db->prepare("UPDATE categoria SET nombre=? WHERE id =?");
        $query->execute(array($category, $id_category));
    }
}