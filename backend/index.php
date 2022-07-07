<?php
  /*******************************
   ** Mostrar errores
  ********************************/
  ini_set('display_errors', 1);
  ini_set('php_log_errors', 1);
  ini_set('php_error_log', "C:/xampp/htdocs/Deliveries/backend");
  /*******************************
  ** Requerimientos
  ********************************/
  require_once "controllers/router.controller.php";
  $index = new RouterController();
  $index->index();
?>