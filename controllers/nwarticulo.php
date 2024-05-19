<?php

class Nwarticulo extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        
    }

    function render(){
        $this->view->render('nwarticulo/index');
    }

    function crear(){
        
        if(isset($_FILES[archivoId])){

            $archivo = $_FILES["archivoId"]["name"];
            $carpeta = "fotos/"; 
            if (move_uploaded_file($_FILES["archivoId"]["tmp_name"], $carpeta.$archivo)) {
                $this->view->mensaje="Se subio ";
            }else{

                $this->view->mensaje="no Se subio ";
            }
            
        }    

    }


    function biencrear(){
        
        $imagen = $_POST['imagen'];
        $clave    = $_POST['clave'];
        $nombre  = $_POST['nombre'];
        if($this->model->insert(['nombre' => $nombre, 'clave' => $clave, 'imagen' => $imagen])){
            //header('location: '.constant('URL').'nuevo/alumnoCreado');
            $this->view->mensaje = "Articulo creado";
            $this->view->render('nwarticulo/index');
        }else{
            $this->view->mensaje = "Ya estaba registradi";
            $this->view->render('nwarticulo/index');
        }
    }
}    
    
?>