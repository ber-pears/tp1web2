<?php require_once './app/models/ejemplo.model.php';?>
<?php require_once './app/views/ejemplo.view.php';?>

<?php 
    class ProductosController{
        private $view;
        private $model;

        function __construct(){
            $this->view = new ProductosViews();
            $this->model = new ListaProductos();
        }

       function verProductos(){
            $productos = $this->model->getProductos();
            $this->view->verProducto($productos);
        }
        
    }
    