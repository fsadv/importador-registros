<?php

require_once('Conexion.php');

class InsertarUp{


    public static function Registrar($idKobo, $fueImportada, $comentarios){
        
        try{
        
        $conexion = new Conexion();
        $stc = $conexion->prepare('CALL SP_Insertar_Registro_UP(?,?,?)');
        $stc->bindParam(1, $idKobo, PDO::PARAM_INT);
        $stc->bindParam(2, $fueImportada, PDO::PARAM_INT);
        $stc->bindParam(3, $comentarios, PDO::PARAM_STR, 50);
        $stc->execute();
        
        } catch (Exception $e) {

            echo $e->getMessage();
        }    
    }
    
}



?>


