<?php
  require_once "models/get.model.php";
  class GetController{
    /*******************************
     ** Petición GET sin filtro
     ********************************/
    static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt){
      $response = GetModel::getData($table,$select, $orderBy,$orderMode, $startAt, $endAt);
      $return = new GetController();
      $return -> fncResponse($response);
    }
    /************************************************************
    ** Peticiones Get sin filtros entre tablas relacionadas.
    *************************************************************/
    static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt){
    $response = GetModel::getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt);
    $return = new GetController();
    $return->fncResponse($response);
    }
    /************************************************************
    ** Peticiones Get con filtros en tablas relacionadas.
    *************************************************************/
    static public function getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){
    $response = GetModel::getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);
    $return = new GetController();
    $return->fncResponse($response);
    }
    /*******************************
     ** Petición GET con filtro
     ********************************/
    static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){
      $response = GetModel::getDataFilter($table, $select, $linkTo,$equalTo, $orderBy, $orderMode, $startAt, $endAt);
      $return = new GetController();
      $return -> fncResponse($response);
    }
    /****************************************************
    ** Peticiones Get para buscadores sin relaciones
    *****************************************************/
    static public function getDataSearch($table, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt){
      $response = GetModel::getDataSearch($table, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt);
      $return = new GetController();
      $return->fncResponse($response);
    }
    /************************************************************
     ** Peticiones Get para buscadores en tablas relacionadas.
    *************************************************************/
    static public function getRelDataSearch($rel, $type, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt){
      $response = GetModel::getRelDataSearch($rel, $type, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt);
      $return = new GetController();
      $return->fncResponse($response);
    }
    /*******************************
    ** Respuesta del controlador
    *******************************/
    public function fncResponse($response){
      if(!empty($response)){
        $json = array(
          "status" => 200,
          "total" => count($response),
          "detalle" => $response
        );
      }else{
        $json = array(
          "status" => 404,
          "detalle" => "not found..."
        );
      }
      echo json_encode($json, http_response_code($json["status"]));
    }
  }
?>