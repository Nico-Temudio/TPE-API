<?php
require_once 'app/models/comment.model.php';
require_once 'app/models/product.model.php';
require_once 'app/views/api.view.php';

class ApiCommentController
{

    private $modelProduct;
    private $modelComment;
    private $view;

    function __construct()
    {
        $this->modelComment = new CommentModel();
        $this->modelProduct = new ProductModel();
        $this->view = new APIView();
        $this->data = file_get_contents("php://input");
    }

    function getData()
    {
        return json_decode($this->data);
    }

    public function getAll($params = null)
    {
        $idProduct = $params[':ID'];
        $check = $this->modelProduct->getProductById($idProduct);
        if ($check) {
            $comments = $this->modelComment->getAll($idProduct);
            $this->view->response($comments, 200);
        } else {
            $this->view->response("El producto con el id=$idProduct no existe", 404);
        }
    }

    public function delete($params = null)
    {
        $idComment = $params[':ID'];
        $success = $this->modelComment->remove($idComment);
        if ($success) {
            $this->view->response("El comentario con el id=$idComment se borro exitosamente", 200);
        } else {
            $this->view->response("La comentario con el id=$idComment no existe", 404);
        }
    }

    public function insert($params = null)
    {
        $body = $this->getData();
        $id_Producto = $params[':ID'];
        $check = $this->modelProduct->getProductById($id_Producto);
        if ($check) {
            if(empty($body->comentario)){
                $this->view->response("Agregue un comentario", 400);
            }
            else{
                $this->modelComment->insert($body->comentario, $id_Producto);
                $this->view->response("Comentario agregado", 201);
            }
        }
        else{
            $this->view->response("No se pudo insertar", 500);
        }
    }

    public function show404($params = null)
    {
        $this->view->response("El recurso solicitado no existe", 404);
    }
}
