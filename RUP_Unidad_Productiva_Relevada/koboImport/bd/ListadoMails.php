<?php

require_once('Conexion.php');

class ListadoMails
{
private $id;
private $nombre;
private $mail;



    public function getId() {
       return $this->id;
    }
    public function getNombre() {
       return $this->nombre;
    }
    public function getMail() {
       return $this->mail;
    }
    
  


    public function __construct($nombre, $mail, $id=null) {
	
	$this->nombre = $nombre;
	$this->mail = $mail;
 	$this->id = $id;
	
	}

	
    public static function Obtener(){
	
	$conexion = new Conexion();
	$consulta = $conexion->prepare("CALL SP_Obtener_Mails");
	$consulta->execute();
	$registros = $consulta->fetchAll();
	return $registros;

    }



}


?>
