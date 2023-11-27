<?php
require_once 'app/models/produc.model.php';
require_once 'app/views/produc.view.php';
class ProductosController{
    private $model;
    private $view;
    
    public function __construct(){
        $this->model = new ProductoModel();
        $this->view = new ProductoView();
    }

    public function showHome(){
        $this->view->verHome();
    }

    public function showProductos(){
        $productos = $this->model->getProductos();
        $this->view->verProducto($productos);
    }

    function agregarProducto(){
        $categoria = $_POST['categoria'];
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];


        $id = $this->model->insertProducto($categoria,$producto,$precio);
        if ($id) {
            header('Location: ' . BASE_URL .'lista');
        } else {
            $this->view->showError("Error al insertar la tarea");
        }
    
    } 
    
    function borrarProducto($id_productos){
        $this->model->deleteProducto($id_productos);
        header('Location: ' . BASE_URL . 'lista');
    }

    function editarProducto(){

        $categoria = $_POST['categoria'];
        $nombre = $_POST['producto'];
        $precio = $_POST['precio'];
        $id = $_POST['id'];

        $verifyId= $this->model->getProducto($id);

        if ($verifyId) {
            $this->model->updateProducto($id, $categoria, $nombre, $precio);
            header('Location: ' . BASE_URL . 'lista');
        }
         $this->view->showError('No se encontro el id para actualizar');
    }
}
