<?php
  /************************
   *! Requerimientos.
   ************************/
    require_once "models/get.model.php";
  /******************************
   *todo Class Controller GET
   ******************************/
    class GetController{
      /********************************
       ** Petición GET sin filtro
      ********************************/
        static public function getData($table, $select,
        $orderBy, $orderMode, $startAt, $endAt){
          $response = GetModel::getData($table, $select,
              $orderBy, $orderMode, $startAt, $endAt);
          $return = new GetController();
          $return -> fncResponse($response,"getData");
        }
      /********************************
       ** Petición GET con filtro
      ********************************/
        static public function getDataFilter($table, $select,
          $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){
          $response = GetModel::getDataFilter($table, $select,
            $linkTo,$equalTo, $orderBy, $orderMode, $startAt, $endAt);
          $return = new GetController();
          $return -> fncResponse($response,"getDataFilter");
        }
      /************************************************************
        ** Petición Get con tablas relacionadas.
      ************************************************************/
        static public function getRelData($rel, $type,
          $select, $orderBy, $orderMode, $startAt, $endAt){
          $response = GetModel::getRelData($rel, $type,
            $select, $orderBy, $orderMode, $startAt, $endAt);
          $return = new GetController();
          $return->fncResponse($response,"getRelData");
        }
      /*************************************************************
       ** Petición Get con tablas relacionadas con filtros .
      *************************************************************/
        static public function getRelDataFilter($rel, $type,
          $select, $linkTo, $equalTo, $orderBy, $orderMode,
          $startAt, $endAt){
          $response = GetModel::getRelDataFilter($rel, $type,
            $select, $linkTo, $equalTo, $orderBy, $orderMode,
            $startAt, $endAt);
          $return = new GetController();
          $return->fncResponse($response,"getRelDataFilter");
        }
      /****************************************************
      ** Petición Get para buscadores
      *****************************************************/
        static public function getDataSearch($table, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt){
          $response = GetModel::getDataSearch($table, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt);
          $return = new GetController();
          $return->fncResponse($response,"getDataSearch");
        }
      /*************************************************************
       ** Petición Get para buscadores con tablas relacionadas.
      *************************************************************/
        static public function getRelDataSearch($rel, $type, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt){
          $response = GetModel::getRelDataSearch($rel, $type, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt);
          $return = new GetController();
          $return->fncResponse($response,"getRelDataSearch");
        }
      /*************************************************************
       ** Petición Get con rangos.
      *************************************************************/
        static public function getDataRange($table, $select, $linkTo, $betweenIn, $betweenOut, $orderBy, $orderMode, $startAt,$endAt, $filterTo, $inTo){
          $response = GetModel::getDataRange($table, $select, $linkTo, $betweenIn, $betweenOut, $orderBy, $orderMode, $startAt,$endAt, $filterTo, $inTo);
          $return = new GetController();
          $return->fncResponse($response,"getRelDataRange");
        }
      /*************************************************************
       ** Petición Get con rangos con tablas relacionadas.
      *************************************************************/
        static public function getRelDataRange($rel, $type, $select, $linkTo, $betweenIn, $betweenOut, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo){
          $response = GetModel::getRelDataRange($rel, $type, $select, $linkTo, $betweenIn, $betweenOut, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);
          $return = new GetController();
          $return->fncResponse($response,"getRelDataRange");
        }
      /*******************************
      ** Respuesta del controlador
      *******************************/
        public function fncResponse($response,$method){
          if(!empty($response)){
            $json = array(
              "status" => 200,
              "method" => $method,
              "total" => count($response),
              "detalle" => $response
            );
          }else{
            $json = array(
              "status" => 404,
              "detalle" => "not found...",
              "method" => $method
            );
          }
          echo json_encode($json, http_response_code($json["status"]));
        }
    }
?>