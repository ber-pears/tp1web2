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
    public function showProductos(){
        $productos = $this->model->getProductos();
        $this->view->verProducto($productos);
    }
}