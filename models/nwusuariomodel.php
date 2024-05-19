<?php

class NwusuarioModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
    
        $query = $this->db->connect()->prepare('INSERT INTO usuarios (nombre, telefono,email) VALUES(:nombre, :telefono, :email)');
        try{
            $query->execute([
                'nombre' => $datos['nombre'],
                'telefono' => $datos['telefono'],
                'email' => $datos['email']
            ]);
           
            return true;
        }catch(PDOException $e){
            return false;
        }
        
        
    }
}
        