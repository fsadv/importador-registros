<?php 

/* 
Modulo: NOTAS
Recibe: enlace de la imagen y registro del grupo asociativo para relacionar
*/


function crearGA($registro, $upId){

    $beanUP = BeanFactory::getBean('RUP_Unidad_Productiva_Relevada', $upId);


    $clavesArray = array_keys($registro);
    for ($i=1; $i <= 20; $i++) { 
    $contieneIntegrante = in_array('persona' .$i .'_nombre', $clavesArray);
    if($contieneIntegrante){
    $beanGA = BeanFactory::newBean('GA_Grupo_Asociativo');
    $beanGA->name = $registro['persona' .$i .'_nombre'];
    $beanGA->apellido = $registro['persona' .$i .'_apellido'];
    $beanGA->tipo_dni = $registro['persona' .$i .'_tipo_doc'];
    $beanGA->dni = $registro['persona' .$i .'_nro_doc'];
    $beanGA->calle = $registro['persona' .$i .'_calle'];
    $beanGA->altura = $registro['persona' .$i .'_altura'];
    $beanGA->rup_unidad_productiva_relevada_id_c = $beanUP->id_c;


    $beanGAsaved = $beanGA->save();

    $beanGA->load_relationship('ga_grupo_asociativo_rup_unidad_productiva_relevada');
    $beanGA->ga_grupo_asociativo_rup_unidad_productiva_relevada->add($beanUP);


    $enlacesImagenes = separarEnlaceDescarga($registro);

    foreach ($enlacesImagenes as $enlace) {
        crearNotaGA($enlace, $beanGAsaved);
    }

      }
    }

}


function crearNotaGA($url, $beanGA) { // tambien recibe BEAN GA , $beanGA 
    
    $grupoAsociativo = BeanFactory::getBean('GA_Grupo_Asociativo', $beanGA);
    $imagen = BeanFactory::newBean('Notes');
    $imagen->file_mime_type = 'image/jpeg';
    $imagen->filename = $grupoAsociativo->name .'.jpg'; 
    $imagen->name = 'Imagen de: ' .$grupoAsociativo->name;
    $imagen->parent_type = 'GA_Grupos_Asociativos';
    $imagen->parent_id = $beanGA;
    $imagen->assigned_user_id = 'd2c51f27-905c-95e7-44ca-61b2402884a1';
    $imagen->contact_id = '';
    $imagen->description = '';

    //El ID para usar con el metodo getbean y crear la relación. DEL GRUPO ASOCIATIVO
    //$imagen->rup_unidad_productiva_relevada_id_c = '10113bd8-bde1-19e2-96f9-623e187b6707';   
    $imagenID = $imagen->save();   
    $enlaceImagen = $url;
    


    urlToFile($enlaceImagen, $imagenID);

}

function urlToFile($url, $nombreImagen){

    $header = array(
        'Authorization: Token 8e15f53df2fa73145a3f25ea60d125279a89c1d9',
    );
    
    $ch_uno = curl_init();
    curl_setopt($ch_uno, CURLOPT_URL, $url);
    curl_setopt($ch_uno, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_uno, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch_uno, CURLOPT_HTTPHEADER, $header);
    
    $html = curl_exec($ch_uno);
    $redirectUrl = curl_getinfo($ch_uno, CURLINFO_EFFECTIVE_URL);



    $options_dos = array(
     CURLOPT_FILE    => fopen('/var/www/html/test_crm/upload/' .$nombreImagen, 'w'),
     CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
     CURLOPT_URL     => $redirectUrl,
     CURLOPT_HTTPHEADER => $header
    );
   
   
   
   $ch = curl_init();
   curl_setopt_array($ch, $options_dos);
   curl_exec($ch);
   curl_close($ch);
   
   }


   


function separarEnlaceDescarga($registro){

$arrayimg = array();

foreach ($registro['_attachments'] as $enlaces){
array_push($arrayimg, $enlaces);
}


$arrayEnlaces = array();

foreach ($arrayimg as $enlaceDescarga) {
array_push($arrayEnlaces, $enlaceDescarga["download_url"]);
}

return $arrayEnlaces;


}

?>
