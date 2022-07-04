<?php
$arrayRouters = explode("/", $_SERVER['REQUEST_URI']);
if (count(array_filter($arrayRouters)) == 1) {
  /*******************************
   ** No hay Petición en la api
   *******************************/
  $json = array(
    "detalle" => "no hay oeticiones a ka api"
  );
  echo json_encode($json, true);
}
?>