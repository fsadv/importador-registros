<?php



function tratarFecha($fecha) {

    if(strlen(strstr($fecha, '-'))>0){
    
      return  tratarDate($fecha);

    } else {

        return tratarStringDate($fecha);
    }

}

function tratarDate($fecha) {
    
    $dia = date('y-m-d');
    $diaActual = new DateTime($dia);
    $fechaKobo = new DateTime($fecha);
    $intervalo = $diaActual->diff($fechaKobo);
    $intervaloDias = $intervalo->days;

    if($intervaloDias <= 365) {
        return 'menos_uno';
    } else if ($intervaloDias > 365 && $intervaloDias <= 730) {
        return 'entre_unodos';
    } else if ($intervaloDias > 730 && $intervaloDias <= 1095) {
        return 'entre_trescinco';
    } else {
        return 'mas_cinco';
    }


}

function tratarStringDate($fecha) { 
    
    switch ($fecha) {

        case 'menos_un_anio':
            return 'menos_uno';
            break;
        
        case 'entre_uno_dos_anios':
            return 'entre_unodos';
            break;

        case 'entre_tres_cinco_anios':
            return 'entre_trescinco';
            break;
            
        default:
            return 'mas_cinco';
            break;
    }

}




?>




