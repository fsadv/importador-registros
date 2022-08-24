<?php
require_once('/var/www/html/test_crm/custom/modules/RUP_Unidad_Productiva_Relevada/koboImport/bd/ListadoMails.php');

class GeneradorMail{


public static function Enviar($body){

$mails = ListadoMails::Obtener();

require_once('include/SugarPHPMailer.php');
$emailObj = new Email();
$defaults = $emailObj->getSystemDefaultEmail();
$mail = new SugarPHPMailer();
$mail->setMailerForSystem();
$mail->From = $defaults['email'];
$mail->FromName = $defaults['name'];
$mail->Subject = 'Importador KOBO - CRM';
$mail->Body=$body;
$mail->prepForOutbound();
foreach($mails as $key=>$value){
$mail->AddAddress($value['Email']);
}
$mail->Send();


}


}

?>
