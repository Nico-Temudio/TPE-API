<?php



class CommentModel
{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_cafeteria;charset=utf8', 'root', '');
    }

    function get($id) {
        $query = $this->db->prepare('SELECT id, comentario, id_producto FROM comentarios WHERE id = ?');
        $query->execute([$id]);
        $msj = $query->fetch(PDO::FETCH_OBJ);
        return $msj;
    }

    function getAll($id_product)
    {
        $query = $this->db->prepare("SELECT c.id, c.comentario as comentario, c.id_producto FROM producto p INNER JOIN comentarios c ON c.id_producto = p.id WHERE p.id=?");
        $query->execute(array($id_product));
        $msjs = $query->fetchAll(PDO::FETCH_OBJ); 
        return $msjs;
    }

    function remove($id) {  
        $query = $this->db->prepare('DELETE FROM comentarios WHERE id = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }

    function insert($comentario, $id_product) {
        $query = $this->db->prepare("INSERT INTO comentarios (comentario, id_producto) VALUES (?,?)");
        $query->execute(array($comentario, $id_product));
        return $this->db->lastInsertId();
    }
}
