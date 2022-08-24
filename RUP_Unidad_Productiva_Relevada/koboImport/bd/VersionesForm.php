<?php

require_once('Conexion.php');

class VersionesForm{
    
    public static function ObtenerVersiones(){
        
  
        $listadoVersiones = array();

        try{
        
        $conexion = new Conexion();
        $stc = $conexion->prepare('CALL SP_Obtener_Versiones');
        $stc->execute();
        $versiones = $stc->fetchAll();

        foreach($versiones as $key=>$value){
            array_push($listadoVersiones, $value['NombreVersion']);
            }

        return $listadoVersiones;


        
        } catch (Exception $e) {
            
            echo $e->getMessage();
        }    
    }
    
}



?>



