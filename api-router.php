<?php
require_once './libs/Router.php';
require_once './app/controllers/category.controller.php';
require_once './app/controllers/product.controller.php';
require_once './app/controllers/api-comments.controller.php';
// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('productos', 'GET', 'ProductController', 'getProducts');
$router->addRoute('productos/:ID', 'GET', 'ProductController', 'getProduct');
$router->addRoute('productos/:ID', 'DELETE', 'ProductController', 'deleteProduct');
$router->addRoute('productos', 'POST', 'ProductController', 'addProduct');

$router->addRoute('categorias', 'GET', 'CatController', 'getCategories');
$router->addRoute('categorias/:ID', 'GET', 'CatController', 'getCategory');
$router->addRoute('categorias/:ID', 'DELETE', 'CatController', 'deleteCategory');
$router->addRoute('categorias', 'POST', 'CatController', 'addCategory');


$router->addRoute('product/:ID/comment', 'GET', 'ApiCommentController', 'getAll');
$router->addRoute('comment/:ID', 'DELETE', 'ApiCommentController', 'delete');
$router->addRoute('product/:ID/comment', 'POST', 'ApiCommentController', 'insert'); 


// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);