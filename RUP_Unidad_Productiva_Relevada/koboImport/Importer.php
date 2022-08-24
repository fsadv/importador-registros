<?php

function importadorKobo(){

//Incluimos los diccionarios de desplegables con mas de una opcion
include __DIR__ .'/dicts/Index.php';

//Incluimos funciones para mapeo de respuestas
include __DIR__ .'/helpers/Index.php';

//Incluimos los SP.
include '/var/www/html/test_crm/custom/modules/RUP_Unidad_Productiva_Relevada/koboImport/bd/InsertarUp.php';
include '/var/www/html/test_crm/custom/modules/RUP_Unidad_Productiva_Relevada/koboImport/bd/RegistrosImportados.php';
include '/var/www/html/test_crm/custom/modules/RUP_Unidad_Productiva_Relevada/koboImport/bd/VersionesForm.php';

try {

//Obtenemos la información de los registros desde la API de KOBO.

$response = file_get_contents('http://10.22.0.224:3001/api-mdhyh/KOBO');
//$response = file_get_contents('/var/www/html/test_crm/custom/modules/RUP_Unidad_Productiva_Relevada/koboImport/data.json');
$jsonResponse = json_decode($response, true);
//$registro = $jsonResponse["data"][29];
$data = $jsonResponse["data"];






foreach ($data as $registro){

//Condicionantes de registros: Si ya fue importado previamente - Si no releva.

$procesandoId = $registro['_id'];
$procesandoVersion = $registro['_version_'];

$registrosImportados = RegistrosImportados::ObtenerRegistros();
$fueImportado = in_array($procesandoId, $registrosImportados);


$versionesValidas = VersionesForm::ObtenerVersiones();
$esVersionValida = in_array($procesandoVersion, $versionesValidas);



if (!$esVersionValida) {
$body = 'Se modifico la version del formulario. Validar los campos';
GeneradorMail::Enviar($body);
break;
}
	

if ($fueImportado) {
    continue;
}


if ($registro['releva'] == 'no') {    
    InsertarUp::Registrar($registro['_id'], 0, 'No releva');
    continue;
}


//Tratamiento de las variables que tenemos que modificar para su inserción en el CRM.

$cuilCompleto = $registro['prefijo'] .$registro['documento'] .$registro['verificador'];


$rubros_bienes = explode(" ", $registro['rubros_prod_bienes']);
$rubros_bienes[0] = $dictRubros[$rubros_bienes[0]];
$rubros_bienes[1] = $dictRubros[$rubros_bienes[1]];
$rubros_bienes[2] = $dictRubros[$rubros_bienes[2]];

$rubros_reventa = explode(" ", $registro['rubros_reventa']);
$rubros_reventa[0] = $dictRubros[$rubros_reventa[0]];
$rubros_reventa[1] = $dictRubros[$rubros_reventa[1]];
$rubros_reventa[2] = $dictRubros[$rubros_reventa[2]];

$rubros_servicios = explode(" ", $registro['rubros_servicios']);
$rubros_servicios[0] = $dictRubros[$rubros_servicios[0]];
$rubros_servicios[1] = $dictRubros[$rubros_servicios[1]];
$rubros_servicios[2] = $dictRubros[$rubros_servicios[2]];

$problemas_produccion = explode(" ", $registro['problemas_producir_mejorar']);
$problemas_produccion[0] = $dictProblemasProd[$problemas_produccion[0]];
$problemas_produccion[1] = $dictProblemasProd[$problemas_produccion[1]];
$problemas_produccion[2] = $dictProblemasProd[$problemas_produccion[2]];

$lugar_comerc = explode(" ", $registro['donde_comercializan']);
$lugar_comerc[0] = $dictLugarComerc[$lugar_comerc[0]];
$lugar_comerc[1] = $dictLugarComerc[$lugar_comerc[1]];
$lugar_comerc[2] = $dictLugarComerc[$lugar_comerc[2]];


$medios_pago = explode(" ", $registro['medios_de_pago']);
$medios_pago[0] = $dictMediosPago[$medios_pago[0]];
$medios_pago[1] = $dictMediosPago[$medios_pago[1]];
$medios_pago[2] = $dictMediosPago[$medios_pago[2]];

$publico_objetivo = explode(" ", $registro['a_quienes_venden']);
$publico_objetivo[0] = $dictPublicoObjetivo[$publico_objetivo[0]];
$publico_objetivo[1] = $dictPublicoObjetivo[$publico_objetivo[1]];
$publico_objetivo[2] = $dictPublicoObjetivo[$publico_objetivo[2]];

$problemas_comerc = explode(" ", $registro['principales_problemas']);
$problemas_comerc[0] = $dictProblemasComerc[$problemas_comerc[0]];
$problemas_comerc[1] = $dictProblemasComerc[$problemas_comerc[1]];
$problemas_comerc[2] = $dictProblemasComerc[$problemas_comerc[2]];

$asist_financ = explode(" ", $registro['asistenc_econom_para_que']);
$asist_financ[0] = $dictAsistFinanc[$asist_financ[0]];
$asist_financ[1] = $dictAsistFinanc[$asist_financ[1]];
$asist_financ[2] = $dictAsistFinanc[$asist_financ[2]];

$red_social = explode(" ", $registro['herramientas_digitales']);

$modo_conoc = explode(" ", $registro['como_se_enteraron_rupepys']);
$modo_conoc[0] = $dictModoConoc[$modo_conoc[0]];

$capacitaciones = explode(" ", $registro['en_que_capacitarse']);
$capacitaciones[0] = $dictCapacitaciones[$capacitaciones[0]];
$capacitaciones[1] = $dictCapacitaciones[$capacitaciones[1]];
$capacitaciones[2] = $dictCapacitaciones[$capacitaciones[2]];



//Proceso de importacion

$bean = BeanFactory::newBean('RUP_Unidad_Productiva_Relevada');

//Etiqueta de duplicidad en CRM

if(existeBeanPorCUIT($cuilCompleto) || existeBeanPorDNI($registro['documento'])) {
$bean->es_duplicado_kobo_c = 1;
}


//Datos de identificacion y contacto

$bean->lugar_inscripcion_up_c = $registro["lugar_inscripcion"];
$bean->nombre_apellido_c = $registro["nombre_apellido"];
$bean->tipo_de_up_c = $registro["tipo_up"];
$bean->name_up_c = $registro["nombre_up_emprend_negocio"];
$bean->anio_comienzo_act_up_c = tratarFecha($registro["comienzo_activ_up"]);
$bean->up_adress_c = $registro["calle_up"];
$bean->adress_number_up_c= $registro["altura_up"];
$bean->description = $registro["dato_adic_ubicac_up"];


$bean->comuna_c = $registro["comuna"];
$bean->barrio_up_c = $registro["barrio"];
$bean->otro_barrio_popu_c = $registro["otro_barrio"];
$bean->sitio_web_c = $registro["red_social_up"];
$bean->phone_office = $registro["telefono"];


//Condicion frente a AFIP


$bean->cuit_cuil_up_c = (mb_strlen($cuilCompleto) < 4) ? $registro['cuil_cuit'] : $cuilCompleto;
$bean->dni_up_c = $registro["documento"];
$bean->prefijo_cuitcuil_c = $registro["prefijo"];
$bean->verificador_cuitcuil_c = $registro["verificador"];
$bean->inscripto_monotributo_c = respInscMonotributo($registro["esta_inscripto_monotrib"]);
$bean->categ_monot_up_c = $registro["que_categoria_monotrib"];



//Composicion de la UP

$bean->cant_int_up_c = $registro['cuantos_integran_up'];
$bean->cant_muj_up_c = $registro['cuantas_mujeres_up'];
$bean->cant_otro_gen_c = $registro['cuantas_ident_genero_up'];


//Produccion

$bean->act_principal_up_c = $registro['a_que_se_dedica_up'];


//Rubros (En produccion ocupar los 3 desplegables con las respuestas del array


$bean->rubros_bienes_c = $rubros_bienes[0];
$bean->rubros_servicios_c = $rubros_servicios[0];
$bean->rubro_reventa_c = $rubros_reventa[0];
$bean->prod_predominante_c = $registro['produc_es_predominante'];
$bean->bienes_serv_princip_c = $registro['bienes_serv_principales'];


//Escala de produccion


$bean->prod_semanal_c=$registro['cuanto_producir_semana'];
$bean->mayor_prod_c=$registro['podrian_producir_mas'];


//Principales problemas de produccion


$bean->princ_problemas_up_c = $problemas_produccion[0];
$bean->princ_problemas_up_1_c = $problemas_produccion[1];
$bean->princ_problemas_up_2_c = $problemas_produccion[2];



//Espacio de produccion


$bean->lugar_producc_up_c = $registro['donde_producen'];


//Espacio de comercializacion


$bean->lugar_comercializacion_c = $lugar_comerc[0];
$bean->lugar_comercializacion_2_c = $lugar_comerc[1];
$bean->lugar_comercializacion_3_c = $lugar_comerc[2];


//Resultados economicos


$bean->est_ventas_mensuales_c = $registro['prom_mensual_ingr_seis_meses'];
$bean->ventas_ult_anio_c = $registro['prom_ultimo_ano'];


//Habilidades digitales


$bean->hab_dig_posnet_c= usaRed('posnet', $red_social);
$bean->hab_dig_no_utilizo_c= usaRed('no_utilizo', $red_social);
$bean->hab_dig_facebook_c = usaRed('facebook', $red_social);
$bean->hab_dig_instagram_c = usaRed('instagram', $red_social);
$bean->hab_dig_whatsapp_c = usaRed('whatsapp', $red_social);
$bean->hab_dig_google_drive_c = usaRed('gogle_drive', $red_social);
$bean->hab_dig_gmail_c = usaRed('gmail', $red_social);
$bean->hab_dig_meet_zoom_c = usaRed('meet_zoom', $red_social);
$bean->hab_dig_youtube_c = usaRed('youtube', $red_social);
$bean->hab_dig_canva_c = usaRed('canva', $red_social);
$bean->hab_dig_adobe_c = usaRed('dobe_photoshop_ilustrator', $red_social);
$bean->hab_dig_wordpress_c = usaRed('wordpress', $red_social);
$bean->hab_dig_office_c = usaRed('microsoft_office', $red_social);
$bean->hab_dig_meli_c = usaRed('mercado_libre', $red_social);
$bean->hab_dig_marketplace_fb_c = usaRed('market_place', $red_social);
$bean->hab_dig_linkedin_c = usaRed('linkedin', $red_social);
$bean->hab_dig_web_propia_c = usaRed('pagina_web_del_emprendimiento', $red_social);



//Entrega de productos


$bean->metodo_entrega_up_c = $registro['como_entrega_prod_serv'];
$bean->medios_pago_2_c = $medios_pago[0];
$bean->medios_pago_c = $medios_pago[1];
$bean->medios_pago_3_c = $medios_pago[2];



//Demanda - Publico Objetivo


$bean->publico_objetivo_c = $publico_objetivo[0];
$bean->publico_objetivo_3_c = $publico_objetivo[1];
$bean->publico_objetivo_2_c = $publico_objetivo[2];



//Condicionantes de la comercializacion


$bean->princ_problemas_comerc_c = $problemas_comerc[0];
$bean->princ_problemas_comerc_2_c = $problemas_comerc[1];
$bean->princ_problemas_comerc_3_c = $problemas_comerc[2];


//Asistencia financiera


$bean->asist_financiera_c = $asist_financ[0];
$bean->asist_financiera_2_c = $asist_financ[1];



//Formacion y capacitacion


$bean->opciones_capacitacion_c = $capacitaciones[0];
$bean->interes_capac_c = $registro[claveCuantiCapac($capacitaciones[0])];
$bean->opciones_capacitacion_3_c = $capacitaciones[1];
$bean->interes_capac_3_c = $registro[claveCuantiCapac($capacitaciones[1])];
$bean->opciones_capacitacion_2_c = $capacitaciones[2];
$bean->interes_capac_2_c = $registro[claveCuantiCapac($capacitaciones[2])];


//Modo de contacto


$bean->modo_conoc_rupepys_c = $modo_conoc[0];
$bean->comentarios_finales_up_c = $registro['comentarios_finales'];
$bean->nom_ap_relev_up_c = $registro['nom_apel_relevo_up'];



$beanUPID = $bean->save();
$beanRegistrado = BeanFactory::getBean('RUP_Unidad_Productiva_Relevada', $beanUPID);
InsertarUp::Registrar($registro['_id'], 1, null);



if($registro['tipo_up'] == 'grupo_asociativo'){
crearGA($registro, $beanUPID);
}



}
        
    } catch (Exception $e) {

       echo $e->getMessage();
       var_dump($e); 
    }
}


?>

