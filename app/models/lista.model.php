<?php 

    class ListaModel{
        private $db;
        function __construct(){
            $this->db = new PDO ('mysql:host=localhost;dbname=tpweb2;charset=utf8', 'root', '');
        } 
        function getLista(){
            $query = $this->db->prepare('SELECT * FROM productos');
            $query->execute();
            $productos = $query->fetchAll(PDO::FETCH_OBJ);
            return $productos;
    }
}
?>