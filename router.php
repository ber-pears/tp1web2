<?php
//incluyo las funciones de un archivo
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/produc.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}
// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case'home':
        $homecontroller = new ProductosController();
        $homecontroller->showHome();
    case'lista':
        $homecontroller = new ProductosController();
        $homecontroller->showProductos();
    case 'login':
        $AuthController = new AuthController();
        $AuthController->showLogin();
        break;
    case 'auth':
        $AuthController = new AuthController();
        $AuthController->auth();
        break;
    case 'logout':
        $AuthController = new AuthController();
        $AuthController->logout();
        break;
    case 'agregar':
        $controller = new ProductosController();
        $controller->agregarProducto();
        break;
    case 'eliminar':
        $controller = new ProductosController();
        $controller->borrarProducto($params[1]);
        break;
    case 'editar':
        $controller = new ProductosController();
        $controller->editarProducto();
        default:
        echo "404 Page Not Found";
        break;
    


}
?>