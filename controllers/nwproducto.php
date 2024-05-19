<?php

class Nwproducto extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        
    }

    function render(){
        $this->view->render('nwproducto/index');
    }

    function crearproducto(){
        
        $codigo_producto = $_POST['codigo'];
        $nombre_producto = $_POST['nombre'];
        $modelo_producto = $_POST['modelo'];

        if($this->model->insert(['codigo_producto' => $codigo_producto, 'nombre_producto' => $nombre_producto, 'modelo_producto' => $modelo_producto])){
            //header('location: '.constant('URL').'nuevo/alumnoCreado');
            $this->view->mensaje = "Producto creado correctamente";
            $this->view->render('nwproducto/index');
        }else{
            $this->view->mensaje = "El codigo ya está registrada";
            $this->view->render('nwproducto/index');
        }
    }

}


?>