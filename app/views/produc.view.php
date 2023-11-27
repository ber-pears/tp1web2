<?php
class ProductoView{ 
    function verHome(){
        require './templates/home.phtml';
    }
    function verProducto($productos){
        require './templates/listaProducto.phtml';
    }
    function showError($error) {
        require './templates/error.phtml';
    }
    function agregarProducto($error) {
        require './templates/agregarProducto.phtml';
    }
}
