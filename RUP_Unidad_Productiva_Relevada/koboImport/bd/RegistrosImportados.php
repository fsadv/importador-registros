<?php

require_once('Conexion.php');

class RegistrosImportados{
    
    public static function ObtenerRegistros(){
        

  
        $listadoRegistros = array();

        try{
        
        $conexion = new Conexion();
        $stc = $conexion->prepare('CALL SP_Obtener_Registros');
        $stc->execute();
        $registros = $stc->fetchAll();

        foreach($registros as $key=>$value){
            array_push($listadoRegistros, $value['IdKobo']);
            }

        return $listadoRegistros;


        
        } catch (Exception $e) {
            
            echo $e->getMessage();
        }    
    }
    
}



?>


