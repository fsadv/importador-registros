<?php


function existeBeanPorDNI($dni=0){

$beanUP= BeanFactory::getBean('RUP_Unidad_Productiva_Relevada');

if($dni==null || $dni=="" || $dni=0) {
  return false;
}

try{

$beanlist = $beanUP->get_list(  

  $order_by = "dni_up_c",
  $where = "dni_up_c = $dni",
  $row_offset = 0,
  $limit=-1,
  $max=-1,
  $show_deleted = 0);

  if($beanlist['row_count'] > 0) {
    return true;
  }  else {
    return false;
  }
} catch (Exception $e) {
  echo $e->getMessage();
  var_dump($dni);
}


}


function existeBeanPorCUIT($cuit=0){

$beanUP= BeanFactory::getBean('RUP_Unidad_Productiva_Relevada');

if($cuit==null || $cuit=="" || $cuit=0) {
  return false;
}

try{

$beanlist = $beanUP->get_list(
  $order_by = "cuit_cuil_up_c",
  $where = "cuit_cuil_up_c = $cuit",
  $row_offset = 0,
  $limit=-1,
  $max=-1,
  $show_deleted = 0);

  if($beanlist['row_count'] > 0) {
    return true;

  }  else {
    return false;
  }
} catch (Exception $e) {
  echo $e->getMessage();
  var_dump($cuit);
}


}




?>

