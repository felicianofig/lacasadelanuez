<?php

require 'models/usuario.php';

class ConsultaUsuaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];
       
        try{
            $query = $this->db->connect()->query('SELECT * FROM usuarios');
          
            while($row = $query->fetch()){
                $item = new Usuario();
                $item->id = $row['id'];
                $item->nombre = $row['nombre'];
                $item->telefono = $row['telefono'];
                $item->email = $row['email'];

                array_push($items, $item);
            }
            
            return $items;
        }catch(PDOException $e){

            return [];
        }
    }

    public function getById($id){
        $item = new Usuario();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM usuarios WHERE id = :id');

            $query->execute(['id' => $id]);
            
            while($row = $query->fetch()){
                
                $item->id = $row['id'];
                $item->nombre = $row['nombre'];
                $item->telefono = $row['telefono'];
                $item->email = $row['email'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        echo 'id . .'.$item['id'];

        $query = $this->db->connect()->prepare('UPDATE usuarios SET nombre = :nombre, telefono = :telefono, email = :email WHERE id = :id');
        try{
            $query->execute([
                'id' => $item['id'],
                'nombre' => $item['nombre'],
                'email' => $item['email'],
                'telefono' => $item['telefono']]);
            return true;
        }catch(PDOException $e){
        
            return false;
        }

    }

   

    public function delete($id){
        $query = $this->db->connect()->prepare('DELETE FROM usuarios WHERE id = :id');
        try{
            $query->execute([
                'id' => $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>