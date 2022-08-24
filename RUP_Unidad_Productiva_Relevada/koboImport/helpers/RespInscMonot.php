<?php


function respInscMonotributo($string){
    
    switch ($string) {
        case 'si':
            return 'yes';
            break;
        case 'no':
            return 'no';
        default:
            return null;
            break;
    }
    
}

?>

