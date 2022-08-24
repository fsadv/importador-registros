<?php

require_once('Conexion.php');

class Logger{
    
    public static function Insertar($descripcion, $objeto, $tipolog){
        
        try{
        
        $conexion = new Conexion();
        $stc = $conexion->prepare('CALL SP_Insertar_Log(?,?,?)');
        $stc->bindParam(1, $descripcion, PDO::PARAM_STR, 250);
        $stc->bindParam(2, $objeto, PDO::PARAM_STR, 700);
	$stc->bindParam(3, $tipolog, PDO::PARAM_STR, 30);
        $stc->execute();
        
        } catch (Exception $e) {
            
            echo $e->getMessage();
        }    
    }
    
}



?>

