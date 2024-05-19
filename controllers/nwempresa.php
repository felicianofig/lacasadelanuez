<?php

class Nwempresa extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        
    }

    function render(){

        $this->view->render('nwempresa/index');
     }

    function crear(){
        
        $nombre = $_POST['nombre'];
        $contacto    = $_POST['contacto'];
        $telefono  = $_POST['telefono'];

        if($this->model->insert(['nombre' => $nombre, 'contacto' => $contacto, 'telefono' => $telefono])){
            //header('location: '.constant('URL').'nuevo/alumnoCreado');
            $this->view->mensaje = "Empresa creado correctamente";
            $this->view->render('nwempresa/index');
        }else{
            $this->view->mensaje = "La matrícula ya está registrada";
            $this->view->render('nwempresa/index');
        }
    } 
}
?>