<?php

require 'models/paciente.php';

	
class PendientesModel extends Model{

    public function __construct(){
        parent::__construct();
    }


    
    public function get(){
        $items = [];
       
        try{
            $query = $this->db->connect()->query('SELECT * FROM referencias WHERE estatus LIKE 1');
          
            while($row = $query->fetch()){
                $item = new Paciente();

                $item->id = $row['id'];   
                $item->idpaciente = $row['idpaciente'];
                $item->expediente = $row['expediente'];
                $item->nombre    = $row['nombre'];
                $item->sexo  = $row['sexo'];
                $item->telefono  = $row['telefono'];
                $item->nacio  = $row['nacio'];

                $item->motivo  = $row['motivo'];
                $item->umreceptora = $row['umreceptora'];
                $item->ciudad = $row['ciudad'];
                $item->areamedica = $row['areamedica'];

                $item->servicio1  = $row['servicio1'];
                $item->situacion = $row['situacion'];
                $item->fconsulta = $row['fconsulta'];
                $item->conshora = $row['conshora'];

                $item->servicio2 = $row['servicio2'];
                $item->fconsultaDos = $row['fconsultaDos'];
                $item->conshora2 = $row['conshora2'];
                $item->medico  = $row['medico'];
                $item->lafecha = date($row['lafecha']);
                
                $item->presenta1 = $row['presenta1'];
                $item->presenta2 = $row['presenta2'];
                $item->presenta3 = $row['presenta3'];
                $item->presenta4 = $row['presenta4'];
                $item->presenta5 = $row['presenta5'];
                $item->presenta6 = $row['presenta6'];
                $item->presenta7 = $row['presenta7'];
                $item->presenta8 = $row['presenta8'];
                
                
                
                array_push($items, $item);
            }
            
            return $items;
        }catch(PDOException $e){

            return [];
        }
    }

    public function getById($id){
        $item = new Paciente();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM referencias WHERE id = :id');

            $query->execute(['id' => $id]);
            
            while($row = $query->fetch()){
                $item->id = $row['id'];   
                $item->idpaciente = $row['idpaciente'];
                $item->expediente = $row['expediente'];
                $item->nombre    = $row['nombre'];
                $item->sexo  = $row['sexo'];
                $item->telefono  = $row['telefono'];
                $item->nacio  = $row['nacio'];

                $item->motivo  = $row['motivo'];
                $item->umreceptora = $row['umreceptora'];
                $item->ciudad = $row['ciudad'];
                $item->areamedica = $row['areamedica'];

                $item->servicio1  = $row['servicio1'];
                $item->situacion = $row['situacion'];
                $item->fconsulta = $row['fconsulta'];
                $item->conshora = $row['conshora'];

                $item->servicio2 = $row['servicio2'];
                $item->fconsultaDos = $row['fconsultaDos'];
                $item->conshora2 = $row['conshora2'];
                $item->medico  = $row['medico'];
                $item->lafecha = date($row['lafecha']);

                $item->presenta1 = $row['presenta1'];
                $item->presenta2 = $row['presenta2'];
                $item->presenta3 = $row['presenta3'];
                $item->presenta4 = $row['presenta4'];
                $item->presenta5 = $row['presenta5'];
                $item->presenta6 = $row['presenta6'];
                $item->presenta7 = $row['presenta7'];
                $item->presenta8 = $row['presenta8'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE referencias SET idpaciente = :idpaciente, expediente = :expediente,
        nombre = :nombre, sexo = :sexo, telefono = :telefono, nacio = :nacio,
        motivo = :motivo, umreceptora = :umreceptora, ciudad = :ciudad, areamedica = :areamedica,
        servicio1 = :servicio1, situacion = :situacion, fconsulta = :fconsulta, conshora = :conshora,
        presenta1 = :presenta1, presenta2 = :presenta2, presenta3 = :presenta3, presenta4 = :presenta4,
        presenta5 = :presenta5, presenta6 = :presenta6, presenta7 = :presenta7, presenta8 = :presenta8,
        servicio2 = :servicio2, fconsultaDos = :fconsultaDos, conshora2 = :conshora2, estatus = :estatus,
        medico = :medico WHERE id = :id');
        try{
            $query->execute([
                'id' => $item['id'],
                'idpaciente' => $item['idpaciente'],
                'expediente' => $item['expediente'],
                'nombre' => $item['nombre'],
                'sexo' => $item['sexo'],
                'telefono' => $item['telefono'],
                'nacio' => $item['nacio'],
                'motivo' => $item['motivo'],
                'umreceptora' => $item['umreceptora'],
                'ciudad' => $item['ciudad'],
                'areamedica' => $item['areamedica'],
                'servicio1' => $item['servicio1'],
                'situacion' => $item['situacion'],
                'fconsulta' => $item['fconsulta'],
                'conshora' => $item['conshora'],
                'servicio2' => $item['servicio2'],
                'fconsultaDos' => $item['fconsultaDos'],
                'conshora2' => $item['conshora2'],
                'presenta1' => $item['presenta1'],
                'presenta2' => $item['presenta2'],
                'presenta3' => $item['presenta3'],
                'presenta4' => $item['presenta4'],
                'presenta5' => $item['presenta5'],
                'presenta6' => $item['presenta6'],
                'presenta7' => $item['presenta7'],
                'presenta8' => $item['presenta8'],
                'estatus' => $item['estatus'],
                'medico' => $item['medico']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = $this->db->connect()->prepare('DELETE FROM alumnos WHERE matricula = :matricula');
        try{
            $query->execute([
                'matricula' => $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>