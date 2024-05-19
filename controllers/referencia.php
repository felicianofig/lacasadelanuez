<?php

class Referencia extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        
    }

    function render(){
        $this->view->render('referencia/index');
    }

    function muestraPaci($param = null){
        //lo envia el header en la barra de buscar
        //recibe lo que se escribe en sears en el headers
        $idPaciente =  $_POST['sears'];

        if(strlen($idPaciente)<12) //si se capturo parte del rfc
        {   //busca si tiene referencias anteriores para copiarla
            $paciente = $this->model->mostrar($idPaciente);
            
            if ($paciente==NULL){ //Si el paciente no tiene referencia previa
                //lista paciente coincidentes con sears, se hara nueva referencia
                $paciente = $this->model->datosp($idPaciente);
                $this->view->pacientes = $paciente;
                $this->view->render('referencia/detallepac');    
                
            }else {//el paciente si tiene
                $this->view->pacientes = $paciente;
                $this->view->render('clonada/detalleref');    
            }
        }
    }
      
    //llamada por views/referencia/detallepac para que traiga los datos del paciente  
    function verpaciente($param = null){
        $idRefe = $param[0];
        $paciente = $this->model->getByRfc($idRefe);
        $this->view->paciente = $paciente;
        $this->view->render('referencia/index'); 
    }    

    //la manda llamar views/referencia/index
    function grabaDatos($param = null){
        //Datos paciente
        $idpaciente =  $_POST['idpaciente'];
        $expediente =  $_POST['Expediente'];
        $nombre =  $_POST['Nombre'];
        $sexo =  $_POST['Sexo'];
        $telefono =  $_POST['Telefono'];
        $nacio =  $_POST['FechaNac'];
        //Datos1 Referencia
        $motivo =  $_POST['MotivoRef'];
        $umreceptora =  $_POST['UmReceptora'];
        $ciudad =  $_POST['Ciudad'];
        $areamedica =  $_POST['Areamedica'];
        //Datos2 Referencia
        $servicio1 =  $_POST['servicio1'];
        $situacion =  $_POST['Situacion'];
        $fconsulta =  $_POST['Fconsulta'];
        $conshora =  $_POST['Conshora'];
        //Datos3 Referencia
        $servicio2 =  $_POST['Servicio2'];
        $fconsultaDos =  $_POST['FconsultaDos'];
        $conshora2 =  $_POST['Conshora2'];
        $idestatus=1;
        $medico = "DR. GERARDO ALHAN CELAYA CELAYA";
        
        if($this->model->insertaref([
            'idpaciente' => $idpaciente,'expediente' => $expediente,'nombre' => $nombre,'sexo' => $sexo, 'telefono' => $telefono,'nacio' => $nacio,
            'motivo' => $motivo,'umreceptora' => $umreceptora,'ciudad' => $ciudad,'areamedica' => $areamedica,
            'servicio1' => $servicio1,'situacion' => $situacion,'fconsulta' => $fconsulta,'conshora' => $conshora,
            'servicio2' => $servicio2,'fconsultaDos' => $fconsultaDos,'conshora2' => $conshora2,
            'estatus' => $idestatus,'medico' => $medico])){
            $this->view->mensaje = "Se ha creado un Nueva Referencia";

            $this->view->render('referencia/aviso');
        }else{
            $this->view->mensaje = "Ya estaba registradi";
            $this->view->render('referencia/aviso');
        }

    }   
    
    

     function calculaedad($fechanacimiento){
              list($ano,$mes,$dia) = explode("-",$fechanacimiento);
              $ano_diferencia  = date("Y") - $ano;
              $mes_diferencia = date("m") - $mes;
              $dia_diferencia   = date("d") - $dia;
              if ($dia_diferencia < 0 || $mes_diferencia < 0)
                $ano_diferencia--;
              return $ano_diferencia;
            }

  
 


}

?>