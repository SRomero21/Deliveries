<?php
  require_once "controllers/get.controller.php";
  $table= explode("?",$arrayRouters[2])[0];
  $select=$_GET["select"]?? "*";
  $orderBy=$_GET["orderBy"]?? null;
  $orderMode=$_GET["orderMode"]?? null;
  $startAt=$_GET["startAt"]?? null;
  $endAt=$_GET["endAt"]?? null;
  $response = new GetController();
  /*******************************
  ** Petición get con filtro
  ********************************/
  if(isset($_GET["linkTo"])&& isset($_GET["equalTo"]) && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])){
    $response -> getDataFilter($table, $select, $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);
  }else
  /************************************************************
  ** Peticiones Get sin filtros entre tablas relacionadas.
  *************************************************************/
  if(isset($_GET["rel"]) && isset($_GET["type"]) && $table=="relations" && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])){
    $response -> getRelData($_GET["rel"], $_GET["type"], $select, $orderBy, $orderMode, $startAt, $endAt);
  }else
  /************************************************************
  ** Peticiones Get con filtros entre tablas relacionadas.
  *************************************************************/
  if(isset($_GET["rel"]) && isset($_GET["type"]) && $table=="relations" && isset($_GET["linkTo"]) && isset($_GET["equalTo"])){
    $response -> getRelDataFilter($_GET["rel"], $_GET["type"], $select, $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);
  }else
  /****************************************************
  ** Peticiones Get para buscadores sin relaciones
  *****************************************************/
  if(!isset($_GET["rel"]) && !isset($_GET["type"]) && isset($_GET["linkTo"]) && isset($_GET["searchTo"])) {
    $response->getDataFilter($table, $select, $_GET["linkTo"], $_GET["searchTo"], $orderBy, $orderMode, $startAt, $endAt);
  }else
  /************************************************************
   ** Peticiones Get para buscadores entre tablas relacionadas.
   *************************************************************/
  if (isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["searchTo"])) {
    $response->getRelDataFilter($_GET["rel"], $_GET["type"], $select, $_GET["linkTo"], $_GET["searchTo"], $orderBy, $orderMode, $startAt, $endAt);
  }else{
  /*******************************
  ** Petición GET sin filtro
  ********************************/
    $response -> getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);
  }
?>