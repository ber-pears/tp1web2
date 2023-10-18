<?php 

    class UserModel{
        private $db;
        function __construct(){
            $this->db = new PDO ('mysql:host=localhost;dbname=tpweb2;charset=utf8', 'root', '');
        } 
        function getByUser($usuario){
            $query = $this->db->prepare('SELECT * FROM usuarios');
            $query->execute();
            $usuario = $query->fetch(PDO::FETCH_OBJ);
            return $usuario;
            
    }
}
?>