<?php
  /*******************************
   ** Crea el archivo de errores
  ********************************/
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', "C:/xampp/htdocs/Deliveries/api/api.error.log");
  /*******************************
  ** Requerimientos
  ********************************/
    require_once "controllers/router.controller.php";
  /*******************************
  ** Index
  ********************************/
    $index = new RouterController();
    $index->index();
?>