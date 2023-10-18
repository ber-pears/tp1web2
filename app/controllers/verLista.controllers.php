<?php require_once './app/models/lista.model.php';?>
<?php require_once './app/views/lista.view.php';?>

<?php
class VerLista{
    private $view;
    private $model;

    function __construct(){
        $this->view = new ListaViews();
        $this->model = new ListaModel();
    }

    function lista(){
        $productos = $this->model->getLista();
        $this->view->lista($productos);
    }
}

?>