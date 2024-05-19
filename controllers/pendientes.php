<?php

class Pendientes extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    
    function render(){
        $pacientes = $this->view->datos = $this->model->get();
        $this->view->pacientes = $pacientes;
        //echo var_dump($pacientes);
        $this->view->render('pendientes/index');
    }
    
    //llamada por views/pendientes/index    
    function verReferencia($param = null){
        $idReferencia = $param[0];
        $paciente = $this->model->getById($idReferencia);

        //session_start();
        //$_SESSION["id_verReferencia"] = $paciente->id;

        $this->view->paciente = $paciente;
        $this->view->render('pendientes/detalle');
    }

    function actualizarReferencia($param = null){
        //Datos paciente
        $id = $_POST['id'];
        $idpaciente = $_POST['idpaciente'];
        $expediente  = $_POST['Expediente'];
        $nombre = $_POST['Nombre'];
        $sexo = $_POST['Sexo'];
        $telefono  = $_POST['Telefono'];   
        $nacio  = $_POST['FechaNac'];   
         //Datos1 Referencia
        $motivo  = $_POST['MotivoRef'];
        $umreceptora  = $_POST['UmReceptora'];   
        $ciudad  = $_POST['Ciudad'];   
        $areamedica  = $_POST['Areamedica'];   
        //Datos2 Referencia
        $servicio1  = $_POST['servicio1'];   
        $situacion  = $_POST['Situacion'];   
        $fconsulta  = $_POST['Fconsulta'];   
        $conshora  = $_POST['Conshora'];   
        //Datos3 Referencia
        $servicio2  = $_POST['Servicio2'];   
        $fconsultaDos  = $_POST['FconsultaDos'];   
        $conshora2  = $_POST['Conshora2'];   
        $presenta1 = $_POST['presenta1'];   
        $presenta2 = $_POST['presenta2'];   
        $presenta3 = $_POST['presenta3'];   
        $presenta4 = $_POST['presenta4'];   
        $presenta5 = $_POST['presenta5'];   
        $presenta6 = $_POST['presenta6'];   
        $presenta7 = $_POST['presenta7'];   
        $presenta8 = $_POST['presenta8'];   
        //
        $estatus  = 2;   
        //$medico  = $_POST['medico'];   
        $medico  = " DR. GERARDO ALHAN CELAYA CELAYA";   
        
                 
        
        
        if($this->model->update(['id' => $id, 'idpaciente' => $idpaciente, 'expediente' => $expediente,
         'nombre' => $nombre, 'sexo' => $sexo, 'telefono' => $telefono, 'nacio' => $nacio,
         'motivo' => $motivo, 'umreceptora' => $umreceptora, 'ciudad' => $ciudad, 'areamedica' => $areamedica,
         'servicio1' => $servicio1,'situacion' => $situacion, 'fconsulta' => $fconsulta, 'conshora' => $conshora,
         'servicio2' => $servicio2, 'fconsultaDos' => $fconsultaDos, 'conshora2' => $conshora2,
         'presenta1' => $presenta1,'presenta2' => $presenta2,'presenta3' => $presenta3,'presenta4' => $presenta4,
         'presenta5' => $presenta5,'presenta6' => $presenta6,'presenta7' => $presenta7,'presenta8' => $presenta8,
         'estatus' => $estatus, 'medico' => $medico])){
        
            //lo mandamos a imprimir  
        
            if($this->imprime((['id' => $id, 'idpaciente' => $idpaciente, 'expediente' => $expediente,
            'nombre' => $nombre, 'sexo' => $sexo, 'telefono' => $telefono, 'nacio' => $nacio,
            'motivo' => $motivo, 'umreceptora' => $umreceptora, 'ciudad' => $ciudad, 'areamedica' => $areamedica,
            'servicio1' => $servicio1,'situacion' => $situacion, 'fconsulta' => $fconsulta, 'conshora' => $conshora,
            'servicio2' => $servicio2, 'fconsultaDos' => $fconsultaDos, 'conshora2' => $conshora2,
            'presenta1' => $presenta1,'presenta2' => $presenta2,'presenta3' => $presenta3,'presenta4' => $presenta4,
            'presenta5' => $presenta5,'presenta6' => $presenta6,'presenta7' => $presenta7,'presenta8' => $presenta8,
            'estatus' => $estatus, 'medico' => $medico]))){    
                $this->view->mensaje = "se actualizO referencia";
                $this->view->render('pendientes/aviso');
            }
        }else{
            $this->view->mensaje = "No se pudo actualizar referencia";
            $this->view->render('pendientes/aviso');
        }

    }

    function eliminarAlumno($param = null){
        $matricula = $param[0];

        if($this->model->delete($matricula)){
            $mensaje ="Alumno eliminado correctamente";
            //$this->view->mensaje = "Alumno eliminado correctamente";
        }else{
            $mensaje = "No se pudo eliminar al alumno";
            //$this->view->mensaje = "No se pudo eliminar al alumno";
        }

        //$this->render();

        echo $mensaje;
    }
    function imprime($item){        
        $masculino = ($item['sexo']=="Masculino") ? 'X' : ''; 
        $femenino = ($item['sexo']=="Femenino") ? 'X' : ''; 
        if($item['areamedica']=="Consulta Externa Espc"){$externa="X";}else{$externa="";}
        if($item['areamedica']=="Hospitalizacion"){$hospital="X";}else{$hospital="";}
        if($item['areamedica']=="Estudios Auxiliares de Diagnostico y Tratamiento"){$estudios="X";}else{$estudios="";}
        if($item['areamedica']=="Rehabilitacion Fisica"){$fisica="X";}else{$fisica="";}
        if($item['situacion']=="Primera Vez"){$SitPrim="X";}else{$SitPrim="";}
        if($item['situacion']=="Subsecuente"){$SitSub="X";}else{$SitSub="";}
        $cauntosanos=$this->calculaedad($item['nacio']);
        $lafecha=date('Y-m-d');
        $elano1=substr($lafecha,2,1);
        $elano2=substr($lafecha,3,1);
        $elmes1=substr($lafecha,5,1);
        $elmes2=substr($lafecha,6,1);
        $eldia1=substr($lafecha,8,1);
        $eldia2=substr($lafecha,9,1);
        
        
        $lahora1=substr(date("H"),0,1);
        $lahora2=substr(date("H"),1,1);
        $elminuto1=substr(date("i"),0,1);
        $elminuto2=substr(date("i"),1,1);
        
        $fano1=substr($item['fconsulta'],2,1);
        $fano2=substr($item['fconsulta'],3,1);
        $fmes1=substr($item['fconsulta'],5,1);
        $fmes2=substr($item['fconsulta'],6,1);
        $fdia1=substr($item['fconsulta'],8,1);
        $fdia2=substr($item['fconsulta'],9,1);
        $fhora1=substr($item['conshora'],1,1);
        $fhora2=substr($item['conshora'],2,1);
        $fmin1=substr($item['conshora'],4,1);
        $fmin2=substr($item['conshora'],5,1);
        $quita =2;    
            
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->Ln(8);    
        $this->pdf->SetFont('Times','',7);
       
        $this->pdf->Image('http://192.166.127.161/clon/myissste/public/imgs/logoissste3.jpg',6,15,26);
        
        $this->pdf->Text(29,22,"Instituto de Seguridad");
        $this->pdf->Text(29,25,"y Servicios Sociales");
        $this->pdf->Text(29,28,"de los Trabajadores");
        $this->pdf->Text(29,31,"del Estado");
                  
        
        $this->pdf->Text(156,17,"Folio");
        $this->pdf->Rect(164,14,38,4);
        $this->pdf->Text(178,21,"Fecha y Hora");
        $this->pdf->Text(166,23,"Dia      Mes     Ano          Hora   Min");
        $this->pdf->Rect(163,25,22,5);
        //DIA
        $this->pdf->Line(167,25,167,29);
        $this->pdf->Line(171,25,171,29);
        //mes
        $this->pdf->Line(175,25,175,29);
        $this->pdf->Line(178,25,178,29);
        //año
        $this->pdf->Line(182,25,182,29);
        $this->pdf->Rect(188,25,16,5);
        //Min
        $this->pdf->Line(192,25,192,29);
        $this->pdf->Line(196,25,196,29);
        //Seg
        $this->pdf->Line(200,25,200,29);
        $this->pdf->SetFont('Times','',10);
        $this->pdf->Text(164,28,$eldia1);
        $this->pdf->Text(168,28,$eldia2);
        $this->pdf->Text(172,28,$elmes1);
        $this->pdf->Text(176,28,$elmes2);
        $this->pdf->Text(179,28,$elano1);
        $this->pdf->Text(183,28,$elano2);
        $this->pdf->Text(189,28,$lahora1);
        $this->pdf->Text(193,28,$lahora2);
        $this->pdf->Text(197,28,$elminuto1);
        $this->pdf->Text(201,28,$elminuto2);

        $this->pdf->SetFont('Times','B',9);
        $this->pdf->Text(9,36,"Subdireccion General Medica                                                                                                                                                           Solicitud de Referencia");
        $this->pdf->SetLineWidth(0.1);
        $this->pdf->Line(9,37,205,37);
        
        //Subdireccion General Medico
        $this->pdf->SetFont('Times','',8);
        
        
        //unidad emisora
        $this->pdf->Text(10,41,"Unidad Medica Emisora:   H. CABORCA SONORA                            
                                    Clave:   02621501");
        $this->pdf->Line(9,42,205,42);

        //Motivo
        $this->pdf->Text(10,47,"Motivo de la Referencia:");
        $this->pdf->Text(42,47,$item['motivo']);
        $this->pdf->SetLineWidth(0.1);
        $this->pdf->Line(9,48,205,48);

        //Nombre
        $this->pdf->Text(10,54,"Nombre del Paciente:");
        $this->pdf->Text(37,54,$item['nombre']);
        $this->pdf->SetLineWidth(0.1);
        $this->pdf->Line(11,55,205,55);
        //Datos Paciente
        $this->pdf->SetFont('Times','',8);
        
        $this->pdf->Text(10,60,"Sexo:       Mas___    Fem___             Edad_____anos         
                  Expediente:______________________    Telefono:__________  ");
        $this->pdf->Text(27,60,$masculino);
        $this->pdf->Text(40,60,$femenino);
        $this->pdf->Text(59,60,$cauntosanos);
        $this->pdf->Text(108,60,$item['expediente']);
        $this->pdf->Text(152,60,$item['telefono']);
        
        //Receptora
        $this->pdf->Text(10,68,"Unidad Medica Receptora:                                                                                          Clave");
        $this->pdf->Text(52,68,$item['umreceptora']);
        $this->pdf->SetLineWidth(0.1);
        $this->pdf->Line(10,69,205,69);

        $this->pdf->Text(8,76,"El paciente se refiere a:");
        $this->pdf->SetLineWidth(0.1);
        $this->pdf->Text(36,76,$item['ciudad']);
        $this->pdf->Line(35,77,205,77);                
        
        
        $this->pdf->SetFont('Times','',7);
        
        $this->pdf->Text(12,81,"Consulta Externa Espec:___             Hospitalizacion___   
            Estudios Auxiliares de Diagnostico y Tratamiento:___        Rehabilitacion Fisica:___         No. de Traslados en el ano___");
        $this->pdf->Text(37,81,$externa);
        $this->pdf->Text(65,81,$hospital);
        $this->pdf->Text(131,81,$estudios);
        $this->pdf->Text(161,81,$fisica);
        $this->pdf->SetLineWidth(0.1);

        $this->pdf->SetFont('Times','',7);
        $this->pdf->Text(183,85,"Cita:");
        $this->pdf->Text(116,88,"Tipo de Traslado");
        $this->pdf->Text(165,87,"Dia      Mes      Ano           Hora    Min");
         
         //substr($item['conshora'],5,1); 
        
        $this->pdf->Rect(161,90,24,5);
        //dia
        $this->pdf->Line(165,90,165,95);
        $this->pdf->Line(169,90,169,95);
        //mes
        $this->pdf->Line(173,90,173,95);
        $this->pdf->Line(177,90,177,95);
        //año
        $this->pdf->Line(181,90,181,95);
        
        $this->pdf->Rect(187,90,16,5);
        $this->pdf->Line(191,90,191,95);
        $this->pdf->Line(195,90,195,95);
        $this->pdf->Line(199,90,199,95);
        
        $this->pdf->SetFont('Times','',10);
        $this->pdf->Text(8,94,"Servicio :____________________________________________ ");
        $this->pdf->Text(24,94,$item['servicio1']);
        $this->pdf->SetFont('Times','',7);
        $this->pdf->Text(110,94,"Primera Vez            Subsecuente");
        $this->pdf->Rect(124,90,4,4);
        $this->pdf->Rect(144,90,4,4);
        $this->pdf->Text(125,93,$SitPrim);
        $this->pdf->Text(146,93,$SitSub);
        $this->pdf->SetFont('Times','',12);
        $this->pdf->Text(162,94,$fdia1);
        $this->pdf->Text(166,94,$fdia2);
        $this->pdf->Text(170,94,$fmes1);
        $this->pdf->Text(174,94,$fmes2);
        $this->pdf->Text(178,94,$fano1);
        $this->pdf->Text(182,94,$fano2);
        $this->pdf->Text(188,94,substr($item['conshora'],0,1));
        $this->pdf->Text(192,94,substr($item['conshora'],1,1));
        $this->pdf->Text(196,94,substr($item['conshora'],3,1));
        $this->pdf->Text(200,94,substr($item['conshora'],4,1));
        
        //substr($item['conshora'],5,1);

        $this->pdf->Text(24,101,$item['servicio2']);
        //$this->pdf->Text(164,101,$lafecha2);
        IF(!EMPTY($item['servicio2'])){
            $this->pdf->Text(164,101,date("d-m-y", strtotime($item['fconsultaDos'])));
        //$this->pdf->Text(164,101,date("d",($item['fconsultaDos'])));
        
            $this->pdf->Text(190,101,$item['conshora2']);
        }
       
        
        $this->pdf->SetFont('Times','B',8);
        $this->pdf->Text(80,107,"PRESENTACION DEL CASO");            


        $this->pdf->SetFont('Times','',8);
        $this->pdf->Text(8,111
            ,"Motivo del envio, valoracion, diagnostico y terapeutica:");            
        $this->pdf->Line(8,112,205,112);
        $this->pdf->Line(8,117,205,117);
        $this->pdf->Text(11,116,$item['presenta1']);
        $this->pdf->Line(8,122,205,122);
        $this->pdf->Text(11,121,$item['presenta2']);
        $this->pdf->Line(8,127,205,127);
        $this->pdf->Text(11,126,$item['presenta3']);
        $this->pdf->Line(8,132,205,132);
        $this->pdf->Text(11,131,$item['presenta4']);
        $this->pdf->Line(8,137,205,137);
        $this->pdf->Text(11,136,$item['presenta5']);
        $this->pdf->Line(8,142,205,142);
        $this->pdf->Text(11,141,$item['presenta6']);
        $this->pdf->Line(8,147,205,147);
        $this->pdf->Text(11,146,$item['presenta7']);
        $this->pdf->Line(8,152,205,152);
        $this->pdf->Text(11,151,$item['presenta8']);
        $this->pdf->Line(8,157,205,157);
        $this->pdf->Line(8,162,205,162);
        $this->pdf->Line(8,167,205,167);
        $this->pdf->Text(10,171,"MOTIVO DE ENVIO:");            
        $this->pdf->Line(8,172,205,172);
        $this->pdf->Line(8,177,205,177);
        $this->pdf->Text(10,181,"Resultados de Laboratorio y Gabinete:");            
        $this->pdf->Line(8,182,205,182);
        $this->pdf->Line(8,187,205,187);
        $this->pdf->Line(8,192,205,192);
        
        $this->pdf->Text(57,202,"Dia     Mes      ano                                            Dia     Mes    ano                                    Problable Riesgo de          Riesgo de");            
        $this->pdf->Text(8,207,"Licencia Medica Ortorgada:          Desde                                                                Hasta                                                 Referencia por:          Trabajo                  Trabajo");
         $this->pdf->Rect(55,203,24,5);
        $this->pdf->Line(59,203,59,208);
        $this->pdf->Line(63,203,63,208);
        //mes
        $this->pdf->Line(67,203,67,208);
        $this->pdf->Line(71,203,71,208);
        //año
        $this->pdf->Line(75,203,75,208);


        $this->pdf->Rect(107,203,24,5);
        $this->pdf->Line(111,203,111,208);
        $this->pdf->Line(115,203,115,208);
        //mes
        $this->pdf->Line(119,203,119,208);
        $this->pdf->Line(123,203,123,208);
        //año
        $this->pdf->Line(127,203,127,208);

        $this->pdf->Rect(176,203,4,4);
        $this->pdf->Rect(197,203,4,4);

        $this->pdf->Rect(8,211,195,24);
        $this->pdf->Line(73,211,73,235);
        $this->pdf->Line(138,211,138,235);
        $this->pdf->Text(30,214,"Medico Tratante                                                                  Vo. Bo. Jefe Inmediato                                      Sello de la Unidad Medica Emisora");            
        
        $this->pdf->Text(14,230,"DR. CARLOS E. GARCIA ZARIÑANA");            
        $this->pdf->Line(10,231,71,231);
        $this->pdf->SetFont('Times','',7);
        $this->pdf->Text(32,234,"Nombre Clave y Firma");            
        $this->pdf->Line(75,231,136,231);
        $this->pdf->SetFont('Times','',7);
        $this->pdf->Text(95,234,"Nombre Clave y Firma");            
        $this->pdf->Text(95,238,"Datos de la autorizacion"); 
        $this->pdf->Text(75,244,"(para ser llenados exclusivamente por Director de la Unidad)");

        $this->pdf->Rect(8,245,195,24);  
        $this->pdf->Line(73,245,73,269);
        $this->pdf->Line(138,245,138,269);

        //A=     
        $this->pdf->Line(27,250,27,266);
        $this->pdf->Text(23,253,"A=");
        $this->pdf->Line(35,250,35,266);


        $this->pdf->Line(27,250,35  ,250);                    
        $this->pdf->Text(23,257,"B=");
        $this->pdf->Line(27,254,35  ,254);                    
        $this->pdf->Text(23,261,"C=");
        $this->pdf->Line(27,258,35  ,258);                    
        $this->pdf->Text(23,265,"D=");
        $this->pdf->Line(27,262,35  ,262);                    
        $this->pdf->Line(27,266,35  ,266);                    
        

        //0=   1=
        $this->pdf->Line(47,253,47,261);
        $this->pdf->Line(55,253,55,261);

        $this->pdf->Line(47,253,55  ,253);                    
        $this->pdf->Text(44,256,"0=");
        $this->pdf->Line(47,257,55  ,257);                    
        $this->pdf->Text(44,260,"1=");
        $this->pdf->Line(47,261,55  ,261);                    
        
        $this->pdf->Text(18,248,"                      Clave de Traslado                                                Director o Responsable de la Unidad Medica Emisora                                           Paciente y/o Familiar"); 

        $this->pdf->Line(73,265,203,265);                    
        $this->pdf->Text(85,264,"DRA. YESSICA P. ARBALLO CASTILLO");
        $this->pdf->Text(95,268,"Nombre Clave y Firma                                                                          Nombre y Firma");             
        $this->pdf->Text(8,273,"TODO PACIENTE DERECHOHABIENTE DEBERA PRESENTAR SU ULTIMO TALON DE PAGO");


        /*-----------------------------------------------------------------------------*/  
        




        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        
        $this->pdf->Ln(20);    
        $this->pdf->SetFont('Times','',7);
       
        
        $this->pdf->Image('http://192.166.127.160/DRGARCIA/public/imgs/logoissste3.jpg',2,16,26);
        
        $this->pdf->Text(25,23,"Instituto de Seguridad");
        $this->pdf->Text(25,26,"y Servicios Sociales");
        $this->pdf->Text(25,29,"de los Trabajadores");
        $this->pdf->Text(25,32,"del Estado");
                  
        
        $this->pdf->Text(160,21,"Folio");
        $this->pdf->Rect(166,18,40,4);
        $this->pdf->Text(178,25,"Fecha y Hora");
        $this->pdf->Text(166,28,"Dia      Mes     Ano          Hora   Min");
        $this->pdf->Rect(164,29,24,4);
        //DIA
        $this->pdf->Line(168,29,168,33);
        $this->pdf->Line(172,29,172,33);
        //mes
        $this->pdf->Line(176,29,176,33);
        $this->pdf->Line(180,29,180,33);
        //año
        $this->pdf->Line(184,29,184,33);
        
        $this->pdf->Rect(189,29,16,4);
        //Min
        $this->pdf->Line(193,29,193,33);
        $this->pdf->Line(197,29,197,33);
        //Seg
        $this->pdf->Line(201,29,201,33);
        
        $this->pdf->SetFont('Times','B',9);
        $this->pdf->Text(7,37,"Subdireccion General Medica                                                                                                                                                Solicitud de Contrarreferencia");
        $this->pdf->SetLineWidth(0.1);
        $this->pdf->Line(7,38,205,38);
        
        
        $this->pdf->SetFont('Times','B',8);
        //unidad que contrarefiere
        $this->pdf->Text(8,48,"Datos de la Unidad Medica que contrarefiere ");
        $this->pdf->Text(8,54,"Unidad Medica:                                                               Clave:");
        $this->pdf->SetLineWidth(0.1);
        $this->pdf->Line(7,55,205,55);
        $this->pdf->Text(8,60,"Motivo de la Contrarreferencia:");
        
        $this->pdf->SetLineWidth(0.1);
        $this->pdf->Line(7,61,205,61);

        $this->pdf->Text(8,68,"Total de Interconsultas:______________          Total de consultas otorgadas:__________     Diagnosticos de Referencia:______________________________________");
        $this->pdf->Text(8,85,"Diagnosticos de Contrarreferencia:____________________________________________________________  Congruencia entre Dx y Contrarreferencia        SI  NO");

        $this->pdf->Text(80,98,"Informe del Medico Especialista Tratante");
/*Aqeio voy yo*/

         $this->pdf->SetFont('Times','',8);
        $this->pdf->Text(8,111
            ,"Motivo del envio, valoracion, diagnostico y terapeutica:");            
        $this->pdf->Line(8,112,205,112);
        $this->pdf->Line(8,117,205,117);
        $this->pdf->Line(8,122,205,122);
        $this->pdf->Line(8,127,205,127);
        $this->pdf->Line(8,132,205,132);
        $this->pdf->Line(8,137,205,137);
        $this->pdf->Line(8,142,205,142);
        $this->pdf->Line(8,147,205,147);
        $this->pdf->Line(8,152,205,152);
        $this->pdf->Line(8,157,205,157);
        $this->pdf->Line(8,162,205,162);
        $this->pdf->Line(8,167,205,167);
        $this->pdf->Line(8,172,205,172);
        $this->pdf->Line(8,177,205,177);
         $this->pdf->Text(8,186,"Inidcaciones a seguir:");            
        $this->pdf->Line(8,187,205,187);
        $this->pdf->Line(8,192,205,192);
        $this->pdf->Line(8,197,205,197);
        $this->pdf->Line(8,202,205,202);
        $this->pdf->Line(8,207,205,207);
        $this->pdf->Line(8,212,205,212);
        $this->pdf->Line(8,217,205,217);
        $this->pdf->Line(8,222,205,222);
        $this->pdf->Line(8,227,205,227);
        
        $this->pdf->Text(95,238,"Datos de la autorizacion"); 
        $this->pdf->Text(75,244,"(para ser llenados exclusivamente por Director de la Unidad)");

        $this->pdf->Rect(8,245,195,24);  
        $this->pdf->Line(73,245,73,269);
        $this->pdf->Line(138,245,138,269);
 
        $this->pdf->Text(18,248,"       Medico Especialista Tratante                            Director o Responsable de la Unidad Medica Emisora                          Paciente y/o Familiar"); 

        $this->pdf->Line(8,265,138,265);                    
   
        $this->pdf->Text(15,268,"            Nombre Clave y Firma                                                                          Nombre y Firma");             
       
        $this->pdf->Output();      
        $this->view->mensaje = "Se Actualizo Referencia";
    }

    function calculaedad($fechanacimiento){
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        /*if ($dia_diferencia < 0 || $mes_diferencia < 0)
          $ano_diferencia=$ano_diferencia-1;*/
        return $ano_diferencia;
      }
    
}

?>