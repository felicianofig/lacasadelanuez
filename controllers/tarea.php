<?php

/**
 * 
 */


class Tarea extends Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
        $this->view->mensaje = "Catalogo de Pacientes";
    }

	 function render(){
        $this->view->render('tarea/index');
    }
    
    function mostrart(){
         //$this->model->tareashow();
         if (isset($_POST['search'])){
            $loqbusca = strtoupper($_POST['search']);
            $this->model->tareasget($loqbusca);  
         }else{
            $loqbusca = "";
            //$this->model->tareashow();
            $this->model->lahoja();
            
         }
 
     }
 




    function PRUEBAgrabar(){
        if (isset($_POST['expediente'])){
            echo "Grabandi";}
    }
    function PRUEBAactualizarte(){
        if (isset($_POST['expediente'])){
           echo "Actualizate";}
    }


     function grabar(){
       
        if (isset($_POST['expediente'])){
            //$expediente = $_POST['expediente'];
            $eltipo = $_POST['eltipo'];
            $nombre = $_POST['nombre'];
            $nacio = $_POST['nacio']; 
            $sexo = $_POST['sexo'];
            $telefono = $_POST['telefono'];
            $colonia = $_POST['colonia'];
            $depende = $_POST['depende'];
            $expediente = substr($_POST['expediente'],0,10).$eltipo;
            
            if($this->model->insert(['expediente' => $expediente, 'eltipo' => $eltipo, 'nombre' => $nombre, 'nacio' => $nacio, 'sexo' => $sexo, 'telefono' => $telefono , 'colonia' => $colonia, 'depende' => $depende])){
                $this->view->mensaje = "Nuevo Pacient Creado";
                //$this->view->render('tareas/index');
                echo "Paciente Creado";
            
            }else{
                //$this->view->mensaje = "La tarea no se pudo crear";
                //$this->view->render('tareas/index');
                echo "No se inserto el paciente";
            }

        }
        
    }
    




     function actualizarte(){
         
        
        if (isset($_POST['expediente'])){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $eltipo = $_POST['eltipo'];
            $nacio = $_POST['nacio'];
            $telefono = $_POST['telefono'];
            $sexo = $_POST['sexo'];
            $colonia = $_POST['colonia'];
            $depende = $_POST['depende'];
            $expediente = substr($_POST['expediente'],0,10).$eltipo;
            //echo "es ".$depende;
            
            if($this->model->tareaUpdate(['id' => $id,'expediente' => $expediente,'eltipo' => $eltipo, 'nombre' => $nombre , 'sexo' => $sexo, 'nacio' => $nacio, 'telefono' => $telefono, 'colonia' => $colonia, 'depende' => $depende])){
                echo "Tarea Creada";
                //$this->view->render('tareas/index');
                //echo "Se modifico correctamente";
            
            }else{
                echo "La tarea no se pudo crear";
                //$this->view->render('tareas/index');
                //echo "No se modifico la tarea";
            }
        }
    }


    function cambiarte(){
       if (isset($_POST['id'])){
            $id = $_POST['id'];
            $this->model->tareacambiar($id);
            /*if ($this->model->tareacambiar($id)){
            echo "Se modifico Exitosamente";
            } else{
             echo "No se modifico lamentablemente";
            } */
        }
       
    }

    function borrarte(){
        
         
        if (isset($_POST['id'])){

            $idp=$_POST['id'];
            $fconsul=$_POST['fcons'];
            $xturno=$_POST['turno'];
            $arrayp=array();

            $arrayp=$this->model->getById($idp,$fconsul);

            if ($this->model->Anotar($arrayp,$fconsul,$xturno)){
                echo "Paciente Anotado correctamente";
            }
            else {
                
                extract($arrayp);
                $idpaciente = $suid;
                $expediente = $suexp;
                echo "No se anoto".$expediente;
        
            }    
            
        }
    }    
    


    

    function responder(){
        if (isset($_POST['search'])){
            $loqbusca =strtoupper($_POST['search']);
        }else{
            $loqbusca = "";
        }
        $this->model->tareasget($loqbusca);
        
        //echo "lo que busca es ".$loqbusca;
    }

   
    function crear(){
        
        $expediente = strtoupper($_POST['expediente']);
        $nombre    = strtoupper($_POST['nombre']);
        $sexo  = $_POST['sexo'];
        
        if($this->model->insert(['expediente' => $expediente, 'nombre' => $nombre, 'sexo' => $sexo])){
            $this->view->mensaje = "Paciente creado correctamente";
            $this->view->render('nuevo/index');
        }else{
            $this->view->mensaje = "El paciente ya estaba registrado";
            $this->view->render('nuevo/index');
        }
    }


     function verPaciente($param = null){
       /* $idPaciente = $param[0];
        $paciente = $this->model->getById($idPaciente);
        if ($this->model->Anotar($paciente))
        {
            $this->view->mensaje = "Paciente Anotado correctamente";
        }    
        $this->view->pacientes = $paciente;
        $this->render();*/
    }
}

?>