<?php


require_once 'models/latarea.php';

class TareaModel extends Model{

    public function __construct(){
        parent::__construct();
        
    }
    

    public function lahoja()
    {
        $dia = date("Y-m-d");
        $lahora = date('H');
        $losminut = date('i');

        
        if ($lahora>=12) 
        {
            if ($lahora==12 AND $losminut<=45) 
            {
                $hora_min = $dia . ' 00:00:00';
                $hora_max = $dia . ' 12:45:59' ;    
                //echo "es".$losminut;
            }else
            {
                $hora_min = $dia . ' 12:46:00';
                $hora_max = $dia . ' 23:59:59' ;
                //echo "en la tarde".$lahora;
            }

        }    
        else
        {
            
            $hora_min = $dia . ' 00:00:00';
            $hora_max = $dia . ' 12:44:59' ;    
            
        }   
        //$hora_min = $dia . ' 00:00:00';
        //    $hora_max = $dia . ' 23:59:59' ; 
        $items = [];
        $sulugar=0;
        try{
            $query = $this->db->connect()->query("SELECT * FROM consultas WHERE (fdosconsulta BETWEEN '$hora_min' AND '$hora_max') ORDER BY `consultas`.`id` DESC");
            $json = array();
            while($row = $query->fetch()){
                $sulugar=$sulugar+1;
                $json[] = array(
                'id' => $row['id'],
                'idpaciente' => $row['idpaciente'],
                'expediente'  => $row['expediente'],
                'nombre'  => $row['nombre'],
                'nacio'  => $row['nacio'],
                'telefono'  => $row['telefono'],
                'colonia'  => $row['colonia'],
                'depende'  => $row['depende'],
                'sulugar'  => $sulugar

                );                
            }
            //echo $sulugar."soy la ficha azul".$lahora;
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }catch(PDOException $e){
            echo "soy la ficha roja";
            //return "hay errores";
        }   
    }


    public function tareasget($letras){
        try{
                $query = $this->db->connect()->query("SELECT * FROM pacientes WHERE nombre LIKE '%$letras%'");
                $json = array();
                while($row = $query->fetch()){
                    $json[] = array(
                    'id' => $row['id'],
                    'expediente'  => $row['expediente'],
                    'eltipo'  => $row['eltipo'],
                    'nacio'  => $row['nacio'],
                    'sexo'  => $row['sexo'],
                    'telefono'  => $row['telefono'],
                    'colonia'  => $row['colonia'],
                    'depende'  => $row['depende'],
                    'nombre'  => $row['nombre']
                    );                
                }
                //vardump($json);
                $jsonstring = json_encode($json);
                echo $jsonstring;
                
                }catch(PDOException $e){
                    echo $json;
                    //return [];
            }

    }





    public function tareaUpdate($item){
        $query = $this->db->connect()->prepare('UPDATE pacientes SET expediente = :expediente, eltipo = :eltipo, nombre = :nombre , nacio = :nacio , sexo = :sexo , telefono = :telefono , colonia = :colonia , depende = :depende WHERE id = :id');
        try{
            $query->execute([
                'id' => $item['id'],
                'expediente' => $item['expediente'],
                'eltipo' => $item['eltipo'],
                'nacio' => $item['nacio'],
                'sexo' => $item['sexo'],
                'nombre' => $item['nombre'],
                'telefono' => $item['telefono'],
                'colonia' => $item['colonia'],
                'depende' => $item['depende']

            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

   
    public function tareacambiar($item){
        try{
            $query = $this->db->connect()->query("SELECT * FROM pacientes WHERE id = $item");
            $json = array();
            while($row = $query->fetch())
            {
                $json[] = array(
                'id' => $row['id'],
                'expediente'  => $row['expediente'],
                'eltipo'  => $row['eltipo'],
                'nacio'  => $row['nacio'],
                'sexo'  => $row['sexo'],
                'colonia'  => $row['colonia'],
                'telefono'  => $row['telefono'],
                'depende'  => $row['depende'],
                'nombre'  => $row['nombre']);         
            }
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }catch(PDOException $e){
            return "hay errores";
        }   
    }







    public function tareaborrar($id){
        $query = $this->db->connect()->prepare('DELETE FROM estudios WHERE id = :id');
        try{
            $query->execute([
                'id' => $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }


    /*public function insert($datos){
       
        $query = $this->db->connect()->prepare('INSERT INTO pacientes (EXPEDIENTE, ELTIPO, NOMBRE, NACIO, TELEFONO, COLONIA, DEPENDE) VALUES(:expediente,  :eltipo, :nombre, :nacio,  :telefono, :colonia, :depende)');
        try{
            $query->execute([
                'expediente' => $datos['expediente'],
                'eltipo' => $datos['eltipo'],
                'nombre' => $datos['nombre'],
                'nacio' => $datos['nacio'],
                'telefono' => $datos['telefono'],
                'colonia' => $datos['colonia'],
                'depende' => $datos['depende']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        
        
    }*/

    public function insert($datos){
       
        $query = $this->db->connect()->prepare('INSERT INTO pacientes (EXPEDIENTE, ELTIPO, NOMBRE, NACIO, SEXO, TELEFONO, COLONIA,DEPENDE) VALUES(:expediente,  :eltipo, :nombre, :nacio , :sexo , :telefono, :colonia, :depende)');
        try{
            $query->execute([
                'expediente' => $datos['expediente'],
                'eltipo' => $datos['eltipo'],
                'nombre' => $datos['nombre'],
                'nacio' => $datos['nacio'],
                'sexo' => $datos['sexo'],
                'telefono' => $datos['telefono'],
                'colonia' => $datos['colonia'],
                'depende' => $datos['depende']

            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        
        
    }



    
  

    public function tareashow(){
     try{
            $query = $this->db->connect()->query("SELECT * FROM pacientes ORDER BY id DESC LIMIT 10");
            $json = array();
            while($row = $query->fetch()){
                $json[] = array(
                'id' => $row['id'],
                'expediente'  => $row['expediente'],
                'eltipo'  => $row['eltipo'],
                'nacio'  => $row['nacio'],
                'sexo'  => $row['sexo'],
                'telefono'  => $row['telefono'],
                'colonia'  => $row['colonia'],
                'depende'  => $row['depende'],
                'nombre'  => $row['nombre']
                );                
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }catch(PDOException $e){
            return "hay errores";
        }   
    }

    




    public function Anotar($arrayp,$sufec,$xturno){
            //$pacdatos=$this->datospaciente($pasuid);
            extract($arrayp);
            $idpaciente = $suid;
            $expediente = strtoupper($suexp);
            $nombre = strtoupper($sunom);
            $nacio =$sunac;
            $telefono =$sutel;
            $colonia =strtoupper($sucol);
            $depende =$sudep;
            $medico ="PENDIENTE";
            $lafecha =$sufec;
            $turno =$xturno; 

            $query = $this->db->connect()->prepare('INSERT INTO consultas (IDPACIENTE,EXPEDIENTE,NOMBRE,NACIO,TELEFONO,COLONIA,DEPENDE,LAFECHA,MEDICO,TURNO) VALUES(:idpaciente,:expediente,:nombre,:nacio,:telefono,:colonia,:depende,:lafecha,:medico,:turno)');
            try{
                $query->execute([
                    'idpaciente' => $idpaciente,
                    'expediente' => $expediente,
                    'nombre' => $nombre,
                    'nacio' => $nacio,
                    'telefono' => $telefono,
                    'colonia' => $colonia,
                    'depende' => $depende,
                    'lafecha' => $lafecha,
                    'medico' => $medico,
                    'turno' => $turno

                ]);
                return true;
            }catch(PDOException $e){
                return false;
            }
    }

    public function getById($id,$fconsul){
        $item = array();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM pacientes WHERE id = :id');

            $query->execute(['id' => $id]);
            
            while($row = $query->fetch()){
                $item = [
                'suid' => $row['id'],
                'suexp'    => $row['expediente'],
                'sunom'   => $row['nombre'],
                'sunac'   => $row['nacio'],
                'sutel'   => $row['telefono'],
                'sucol'   => $row['colonia'],
                'sudep'   => $row['depende']
                
                ];

            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }
        
        /*
        $idpaciente = $pacdatos->idpaciente;
        $expediente = $pacdatos->expediente;
        $nombre    = $pacdatos->nombre;
        $sexo  = $pacdatos->sexo;
        $motivo = $pacdatos->motivo;
        $nacio = $pacdatos->nacio;
        $telefono  = $pacdatos->telefono;
        $colonia = $pacdatos->colonia;
        $depende = $pacdatos->depende;

        

        $lafecha = date('Y-m-d');
        $laruta  = "CONSULTA";
        $lahora = date('H');
        $estatus = 1;
        if ($lahora>12){
           $medico="CELAYA";
        }else{
            $medico="SALAZAR";
        }    
        if($this->insert(['idpaciente' => $idpaciente,'expediente' => $expediente, 'nombre' => $nombre, 'sexo' => $sexo,'lafecha' => $lafecha,'laruta' => $laruta,'motivo' => $motivo,'medico' => $medico,'estatus' => $estatus,'nacio' => $nacio,'telefono' => $telefono,'colonia' => $colonia,'depende' => $depende])){
            //header('location: '.constant('URL').'nuevo/alumnoCreado');
            //$this->view->mensaje = "Paciente creado correctamente";
            //$this->view->render('consulta/index');
            return true;
        }else{
            
            //$this->view->mensaje = "Solo una consulta por dia";
            //$this->view->render('consulta/index');
            return false;
        }
        */
    

 }   

?>