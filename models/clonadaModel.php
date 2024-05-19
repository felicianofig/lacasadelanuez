<?php

require 'models/paciente.php';

class ClonadaModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    //pacientes
    public function datosp($id){
        $cadena="SELECT * FROM pacientes WHERE expediente LIKE '%".$id."%'";
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM pacientes WHERE expediente LIKE '%".$id."%'");

            while($row = $query->fetch()){
                $item = new Paciente(); 
                $item->idpaciente = $row['id'];   
                $item->expediente = $row['expediente'];
                $item->nombre    = $row['nombre'];
                $item->sexo  = $row['sexo'];
                $item->nacio  = $row['nacio'];
                $item->telefono  = $row['telefono'];
                
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return null;
        }
    }
    
    //referencias
    public function mostrar($id){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM referencias WHERE expediente LIKE '%".$id."%'");

            while($row = $query->fetch()){
                $item = new Paciente(); 
                $item->id = $row['id'];   
                $item->expediente = $row['expediente'];
                $item->nombre    = $row['nombre'];
                $item->sexo  = $row['sexo'];
                $item->servicio1  = $row['servicio1'];
                $item->motivo  = $row['motivo'];
                $item->medico  = $row['medico'];
                $item->nacio  = $row['nacio'];
                $item->telefono  = $row['telefono'];
                
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return null;
        }
    }

    public function getSufon($rfc){
        try{
            $surfc= $rfc;
            $query = $this->db->connect()->prepare('SELECT * FROM pacientes WHERE expediente LIKE :surfc');

            $query->execute(['surfc' => $surfc]);
        
                while($prow = $query->fetch()){
                    $telefono  = $prow['telefono'];
                }    
            return  $telefono;    
        }catch(PDOException $e){
            return null;
        }
    }    

    public function getById($id){
        $item = new paciente();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM referencias WHERE id = :id');

            $query->execute(['id' => $id]);
            
            while($row = $query->fetch()){
                
                $item->id = $row['id'];   
                $item->expediente = $row['expediente'];
                $item->nombre    = $row['nombre'];
                $item->sexo  = $row['sexo'];
                $item->telefono  = $this->getSufon($row['expediente']);
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
                
                $item->presenta1 = $row['presenta1'];
                $item->presenta2 = $row['presenta2'];
                $item->presenta3 = $row['presenta3'];
                $item->presenta4 = $row['presenta4'];
                $item->presenta5 = $row['presenta5'];
                $item->presenta6 = $row['presenta6'];
                $item->presenta7 = $row['presenta7'];
                $item->presenta8 = $row['presenta8'];
                
                
                $item->lafecha = date($row['lafecha']);
                $item->medico  = $row['medico'];
            }
                    
            return $item;
            
        }catch(PDOException $e){
            return null;
        }
    }

    
    public function getByRfc($id){
        $item = new paciente();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM pacientes WHERE id = :id');

            $query->execute(['id' => $id]);
            
            while($row = $query->fetch()){
                
                $item->idpaciente = $row['id'];   
                $item->expediente = $row['expediente'];
                $item->nombre    = $row['nombre'];
                $item->sexo  = $row['sexo'];
                $item->nacio  = $row['nacio'];
                $item->telefono  =$row['telefono'];
                
            }
                    
            return $item;
            
        }catch(PDOException $e){
            return null;
        }
    }





    //pacientes
    public function pacientemostrar($id){
        $cadena="SELECT * FROM pacientes WHERE expediente LIKE '%".$id."%'";
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM pacientes WHERE expediente LIKE '%".$id."%'");

            while($row = $query->fetch()){
                $item = new Paciente(); 
                $item->idpaciente = $row['id'];   
                $item->expediente = $row['expediente'];
                $item->nombre    = $row['nombre'];
                $item->sexo  = $row['sexo'];
                $item->medico  = $row['medico'];
                $item->nacio  = $row['nacio'];
                $item->telefono  = $row['telefono'];
                
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return null;
        }
    }

    
    public function insertaref($datos){
        
        $query = $this->db->connect()->prepare("INSERT INTO referencias (id,
        idpaciente,expediente, nombre,sexo,telefono,nacio,
        motivo,umreceptora,ciudad,areamedica,
        servicio1,situacion,fconsulta,conshora,
        servicio2,fconsultaDos,conshora2,
        presenta1,presenta2,presenta3,presenta4,
        presenta5,presenta6,presenta7,presenta8,estatus,medico) 
        VALUES('',:idpaciente,:expediente,:nombre,:sexo,:telefono, :nacio,
        :motivo,:umreceptora, :ciudad, :areamedica,:servicio1,:situacion,:fconsulta,:conshora,
        :servicio2,:fconsultaDos,:conshora2,:presenta1,:presenta2,:presenta3,:presenta4,
        :presenta5,:presenta6,:presenta7,:presenta8,:estatus,:medico)");
        try{
            $query->execute([
                'idpaciente' => $datos['idpaciente'],
                'expediente' => $datos['expediente'],
                'nombre' => $datos['nombre'],
                'sexo' => $datos['sexo'],
                'telefono' => $datos['telefono'],
                'nacio' => $datos['nacio'],
                'motivo' => $datos['motivo'],
                'umreceptora' => $datos['umreceptora'],
                'ciudad' => $datos['ciudad'],
                'areamedica' => $datos['areamedica'],
                'servicio1' => $datos['servicio1'],
                'situacion' => $datos['situacion'],
                'fconsulta' => $datos['fconsulta'],
                'conshora' => $datos['conshora'],
                'servicio2' => $datos['servicio2'],
                'fconsultaDos' => $datos['fconsultaDos'],
                'conshora2' => $datos['conshora2'],
                'presenta1' => $datos['presenta1'],
                'presenta2' => $datos['presenta2'],
                'presenta3' => $datos['presenta3'],
                'presenta4' => $datos['presenta4'],
                'presenta5' => $datos['presenta5'],
                'presenta6' => $datos['presenta6'],
                'presenta7' => $datos['presenta7'],
                'presenta8' => $datos['presenta8'],
                'estatus' => $datos['estatus'],
                'medico' => $datos['medico']                                
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }        


    
}
