<?php
$arrayRouters = explode("/", $_SERVER['REQUEST_URI']);
if (count(array_filter($arrayRouters)) == 1) {
  /*******************************
   ** No hay Petición en la api
   *******************************/
  $json = array(
    "status"=>200,
    "detalle" => "no hay peticiones a la api"
  );
  echo json_encode($json, true);
}
?>