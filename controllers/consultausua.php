<?php

class ConsultaUsua extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }
    
    function render(){

       $usuarios = $this->view->datos = $this->model->get();
       $this->view->usuarios = $usuarios;
       $this->view->render('consultaUsua/index');
    }

   function verUsuario($param = null){
        $idUsuario = $param[0];
        $usuario = $this->model->getById($idUsuario);

        session_start();
        $_SESSION["id_verUsuario"] = $usuario->id;

        $this->view->usuario = $usuario;
        $this->view->render('ConsultaUsua/detalle');
    }
    
    function actualizarUsuario($param = null){
        session_start();
        
        $id = $_SESSION["id_verUsuario"];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        unset($_SESSION['id_verUsuario']);
        
        if($this->model->update( ['id' => $id, 'nombre' => $nombre, 'telefono' => $telefono,'email' => $email] ) ){
                $usuario = new Usuario();
                $usuario->nombre = $nombre;
                $usuario->telefono = $telefono;
                $usuario->email = $email;

                $this->view->usuario = $usuario;
                $this->view->mensaje = "Usuario actualizado correctamente";
            }else
            {
                $this->view->mensaje = "No se pudo actualizar a".$telefono;
            }
            
            $this->view->render('ConsultaUsua/detalle');
    } 


     function eliminarUsuario($param = null){
        $telefono = $param[0];

        if($this->model->delete($telefono)){
            $mensaje ="Alumno eliminado correctamente";
            //$this->view->mensaje = "Alumno eliminado correctamente";
        }else{
            $mensaje = "No se pudo eliminar al alumno";
            //$this->view->mensaje = "No se pudo eliminar al alumno";
        }

        //$this->render();

        echo $mensaje;
    }

    
}

?>