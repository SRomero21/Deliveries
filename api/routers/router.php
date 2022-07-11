<?php
  /*******************************
   ** Api Deliveries
  ********************************/
  $arrayRouters = explode("/", $_SERVER['REQUEST_URI']);
  $arrayRouters = array_filter($arrayRouters);
  /*******************************
   ** No hay Petición en la api
  ********************************/
  if (count($arrayRouters) == 1) {
    $json = array(
      "status"=>404,
      "detalle" => "not found..."
    );
    echo json_encode($json, http_response_code($json["status"]));
  }
  /*******************************
   ** Petición en la api
  ********************************/
  if (count($arrayRouters) == 2 && isset($_SERVER['REQUEST_METHOD'])){
    $table=explode("?",$arrayRouters[2])[0];
    /*******************************
    ** Petición GET
    ********************************/
    if ($_SERVER['REQUEST_METHOD']=='GET'){
      include "services/get.php";
    }
    /*******************************
     ** Petición POST
     ********************************/
    if ($_SERVER['REQUEST_METHOD']=='POST'){
      include "services/post.php";
    }
    /*******************************
    ** Petición PUT
    ********************************/
    if ($_SERVER['REQUEST_METHOD']=='PUT'){
        $json = array(
          "status" => 200,
          "detalle" => "Petición PUT"
        );
        echo json_encode($json, http_response_code($json["status"]));
    }
    /*******************************
    ** Petición DELETE
    ********************************/
    if ($_SERVER['REQUEST_METHOD']=='DELETE'){
      $json = array(
        "status" => 200,
        "detalle" => "Petición DELETE"
      );
      echo json_encode($json, http_response_code($json["status"]));
    }
  }
?>