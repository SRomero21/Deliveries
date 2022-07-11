<?php
  /************************
   *todo Petición GET.
   ************************/
    /************************
     *! Requerimientos.
     ***********************/
      require_once "controllers/get.controller.php";
    /***************************************
     *? Variables.
    ****************************************/
      $select=$_GET["select"]?? "*";
      $rel=$_GET["rel"]?? "*";
      $type=$_GET["type"]?? "*";
      $orderBy=$_GET["orderBy"]?? null;
      $orderMode=$_GET["orderMode"]?? null;
      $startAt=$_GET["startAt"]?? null;
      $endAt=$_GET["endAt"]?? null;
      $linkTo=$_GET["linkTo"]?? null;
      $inTo=$_GET["inTo"]?? null;
      $searchTo=$_GET["searchTo"]?? null;
      $equalTo=$_GET["equalTo"]?? null;
      $filterTo=$_GET["filterTo"]?? null;
      $betweenIn=$_GET["betweenIn"]?? null;
      $betweenOut=$_GET["betweenOut"]?? null;
      $response = new GetController();
    /****************************************
     ** 01) Con select.
     ****************************************/
      if ($table!="relations" && !isset($_GET["searchTo"])
        && !isset($_GET["equalTo"]) && !isset($_GET["betweenIn"])
        && !isset($_GET["betweenOut"])) {
        $response -> getData($table, $select, $orderBy,
            $orderMode, $startAt, $endAt);
      } else
    /****************************************************
     ** 02) Con select con filtro.
     ****************************************************/
      if($table!="relations" && isset($_GET["linkTo"])
        && isset($_GET["equalTo"]) && !isset($_GET["searchTo"])){
        $response -> getDataFilter($table, $select,
                      $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);
      }else
    /*****************************************************
     ** 03) Con select con buscador
     *****************************************************/
      if(!isset($_GET["rel"]) && !isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["searchTo"])
        && !isset($_GET["equalTo"])) {
        $response->getDataSearch($table, $select, $linkTo, $searchTo,
                    $orderBy, $orderMode, $startAt, $endAt);
      }else
    /*************************************************************
     ** 13) Con select con rangos
     *************************************************************/
      if ($table != "relations" && !isset($_GET["rel"]) && !isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["betweenIn"])
        && isset($_GET["betweenOut"])) {
        $response->getDataRange($table, $select, $linkTo, $betweenIn,
                  $betweenOut, $orderBy, $orderMode, $startAt,
                  $endAt, $filterTo, $inTo);
      }else
    /*************************************************************
     ** 04) Con select con tablas relacionadas.
     *************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])){
          $response -> getRelData($rel, $type, $select ,$orderBy,
                        $orderMode, $startAt, $endAt);
      }else
    /*************************************************************
     ** 05) Con select con tablas relacionadas con filtro.
     *************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["equalTo"])){
        $response -> getRelDataFilter($rel, $type, $select, $linkTo,
                      $equalTo, $orderBy, $orderMode, $startAt, $endAt);
      }else
    /***************************************************************
     ** 12) Con select con tablas relacionadas  con buscador.
     ***************************************************************/
      if ($table == "relations" && isset($_GET["rel"])
        && isset($_GET["type"]) && isset($_GET["linkTo"])
        && isset($_GET["searchTo"])) {
        $response->getRelDataSearch($rel, $type, $select, $linkTo,
                    $searchTo, $orderBy, $orderMode, $startAt, $endAt);
      }else
    /********************************************************************
     ** 14) Con select con tablas relacionadas con rangos .
     ********************************************************************/
      if ($table == "relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["betweenIn"])
        && isset($_GET["betweenOut"])){
        $response->getRelDataRange($rel, $type, $select, $linkTo,
                    $betweenIn, $betweenOut, $orderBy, $orderMode,
                    $startAt, $endAt, $filterTo, $inTo);
        }else{
          $json = array(
          "status" => 404,
            "detalle" => "not found...",
            "method" => "faltan Parámetros",
          );
          echo json_encode($json, http_response_code($json["status"]));
      }
?>