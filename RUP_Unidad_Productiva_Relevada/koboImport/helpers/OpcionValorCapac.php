<?php



function claveCuantiCapac($capac){   


switch ($capac) {
    case "mejora_proc_trabajo":
        return 'en_que_capacitarse_001';
        break;
    
    case "gestion_adm":
        return 'en_que_capacitarse_002';
        break;
        
    case "armado_presup":
        return 'en_que_capacitarse_003';
        break;
        
    case "estrateg_logistica":
        return 'en_que_capacitarse_004';
        break;
        
    case "redes_soc":
        return 'en_que_capacitarse_005';
        break;
        
    case "esp_roles":
        return 'en_que_capacitarse_006';
        break;
        
    case "const_catalogo":
        return 'en_que_capacitarse_007';
        break;
        
    case "packaging_prod":
        return 'en_que_capacitarse_008';
        break;
        
    case "comercializacion":
        return 'en_que_capacitarse_009';
        break;
        
    case "seg_e_hig":
        return 'en_que_capacitarse_010';
        break;
    
    default:
        return null;
        break;
}

}


?>
