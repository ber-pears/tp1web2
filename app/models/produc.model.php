<?php
class ProductoModel{
    private $db;

    function __construct(){
        $this->db = new PDO ('mysql:host=localhost;dbname=tpweb2;charset=utf8', 'root', '');
    }
    function getProductos() {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }
    function getProducto($id) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_productos = ?');
        $query->execute([$id]);

        $producto = $query->fetch(PDO::FETCH_OBJ);

        return $producto;
    }

    function deleteProducto($id_productos) {
        $query = $this->db->prepare('DELETE FROM productos WHERE id_productos = ?');
        $query->execute([$id_productos]);
    }

    function insertProducto($categoria,$producto,$precio){    
        $query = $this->db->prepare('INSERT INTO productos (Categoria, Producto, Precio) VALUES (?,?,?)');
        $query->execute([$categoria,$producto,$precio]);

        return $this->db->lastInsertId(); 
    }

    function updateProducto($id, $categoria, $nombre, $precio){
        $query = $this->db->prepare('UPDATE productos SET Categoria = ?, Producto = ?, Precio = ? WHERE id_productos = ?');
        $query->execute([$categoria,$nombre,$precio,$id]);
    }
}