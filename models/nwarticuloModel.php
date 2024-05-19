<?php



class NwarticuloModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        $query = $this->db->connect()->prepare('INSERT INTO articulos (CLAVE, NOMBRE, IMAGEN) VALUES(:clave, :nombre, :imagen)');
        try{
            $query->execute([
                'clave' => $datos['clave'],
                'nombre' => $datos['nombre'],
                'imagen' => $datos['imagen']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        
        
    }
}



?>