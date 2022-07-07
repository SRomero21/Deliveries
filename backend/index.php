<?php
  /*******************************
   ** Mostrar errores
  ********************************/
  ini_set('display_errors', 1);
  ini_set('log_errors', 1);
  ini_set('error_log', "C:/xampp/htdocs/Deliveries/backend");
  /*******************************
  ** Requerimientos
  ********************************/
  require_once "controllers/router.controller.php";
  $index = new RouterController();
  $index->index();
?>