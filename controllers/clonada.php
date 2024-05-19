<?php

class Clonada extends Controller{
  
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";  }

    function render(){
        $this->view->render('clonada/index'); }

    //la manda llamar views/clonada/index
    function grabaDatos($param = null){
        //Datos paciente
        $idpaciente =  $_POST['idpaciente'];
        $expediente =  $_POST['Expediente'];
        $nombre =  $_POST['Nombre'];
        $sexo =  $_POST['Sexo'];
        $telefono =  $_POST['Telefono'];
        $nacio =  $_POST['FechaNac'];
                
        //Datos Referencia
        $motivo =  $_POST['MotivoRef'];
        $umreceptora =  $_POST['UmReceptora'];
        $ciudad =  $_POST['Ciudad'];
        $areamedica =  $_POST['Areamedica'];
        $servicio1 =  $_POST['servicio1'];
        $situacion =  $_POST['Situacion'];
        $fconsulta =  $_POST['Fconsulta'];
        $conshora =  $_POST['Conshora'];
        $servicio2 =  $_POST['Servicio2'];
        $fconsultaDos =  $_POST['FconsultaDos'];
        $conshora2 =  $_POST['Conshora2'];

        $presenta1 = $_POST['presenta1'];   
        $presenta2 = $_POST['presenta2'];   
        $presenta3 = $_POST['presenta3'];   
        $presenta4 = $_POST['presenta4'];   
        $presenta5 = $_POST['presenta5'];   
        $presenta6 = $_POST['presenta6'];   
        $presenta7 = $_POST['presenta7'];   
        $presenta8 = $_POST['presenta8'];   
        //
        $estatus  = 1;   
        
        $medico  = " DR. GERARDO ALHAN CELAYA CELAYA";   
        
        
        if($this->model->insertaref([
            'idpaciente' => $idpaciente,'nombre' => $nombre,'expediente' => $expediente,
            'sexo' => $sexo, 'telefono' => $telefono,'nacio' => $nacio,'motivo' => $motivo,
            'umreceptora' => $umreceptora,'ciudad' => $ciudad,'areamedica' => $areamedica,
            'servicio1' => $servicio1,'situacion' => $situacion,'fconsulta' => $fconsulta,
            'conshora'=>$conshora,'servicio2'=>$servicio2,'fconsultaDos'=>$fconsultaDos,'conshora2'=>$conshora2,
            'presenta1' => $presenta1,'presenta2' => $presenta2,'presenta3' => $presenta3,'presenta4' => $presenta4,
            'presenta5' => $presenta5,'presenta6' => $presenta6,'presenta7' => $presenta7,'presenta8' => $presenta8,
            'estatus' => $estatus, 'medico' => $medico])){
            $this->view->mensaje = "Articulo creado";

            $this->view->render('referencia/aviso');
        }else{
            $this->view->mensaje = "Ya estaba registradi";
            $this->view->render('referencia/aviso');
        }

    }   
    
    //llamada por views/clonada/detalleref trae datos de referencia previa  
    function verreferencia($param = null){
        $idRefe = $param[0];
        $paciente = $this->model->getById($idRefe);
        $this->view->paciente = $paciente;
        $this->view->render('clonada/index'); 
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