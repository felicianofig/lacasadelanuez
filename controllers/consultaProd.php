<?php

class ConsultaProd extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    function render(){
        $productos = $this->view->datos = $this->model->get();
        $this->view->productos = $productos;
        $this->view->render('ConsultaProd/index');
    }

    function verProducto($param = null){
        $id_producto = $param[0];
        
        $producto = $this->model->getById($id_producto);
        
        session_start();
        $_SESSION["id_verProducto"] = $producto->id_producto;
        $this->view->producto = $producto;
        $this->view->render('ConsultaProd/detalle');
    }



    function actualizarProducto($param = null){
        session_start();
        $id_producto = $_SESSION['id_verProducto'];
        $codigo_producto = $_POST['codigo_producto'];
        $nombre_producto = $_POST['nombre_producto'];
        $modelo_producto = $_POST['modelo_producto'];


        unset($_SESSION['id_verProducto']);
        //echo "ES ACTUAL".$id_producto;
        if($this->model->update(['codigo_producto' => $codigo_producto, 'nombre_producto' => $nombre_producto, 'modelo_producto' => $modelo_producto, 'id_producto' => $id_producto])){
            $producto = new Producto();
            $producto->codigo_producto = $codigo_producto;
            $producto->nombre_producto = $nombre_producto;
            $producto->modelo_producto = $modelo_producto;
            $producto->id_producto     = $id_producto;

            $this->view->producto = $producto;
            $this->view->mensaje = "Producto actualizado correctamente";
        }else{
            $this->view->mensaje = "No se pudo actualizar el producto";
        }
        $this->view->render('ConsultaProd/detalle');
    }

}
?>