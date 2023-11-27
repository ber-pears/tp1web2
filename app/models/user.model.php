<?php
    require_once 'database/model.php';
    class UserModel extends Model {
        function __construct()
        {
            parent:: __contruct();
        }
            public function getByUser($username){
                $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ? ');
                $query->execute([$username]);
                return $query->fetch(PDO::FETCH_OBJ);
            }
        }