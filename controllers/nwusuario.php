<?php

class NwUsuario extends Controller{


    function __construct(){
        parent::__construct();
        $this->view->mensaje="";
        
    }

    function render(){
        $this->view->render('nwusuario/index');
    }

    function crear(){
        
        $telefono = $_POST['telefono'];
        $email    = $_POST['email'];
        $nombre  = $_POST['nombre'];
        
        if($this->model->insert(['nombre' => $nombre, 'telefono' => $telefono, 'email' => $email])){
            //header('location: '.constant('URL').'nuevo/alumnoCreado');
            $this->view->mensaje = "Usuario creado";
            $this->view->render('nwusuario/index');
        }else{
            $this->view->mensaje = "Ya estaba registrado";
            $this->view->render('nwusuario/index');
        }
    }
}    

?>