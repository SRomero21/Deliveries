<?php
  require_once "controllers/get.controller.php";
  $table= explode("?",$arrayRouters[2])[0];
  $select=$_GET["select"]?? "*";
  $orderBy=$_GET["orderBy"]?? null;
  $orderMode=$_GET["orderMode"]?? null;
  $startAt=$_GET["startAt"]?? null;
  $endAt=$_GET["endAt"]?? null;
  $filterTo=$_GET["filterTo"]?? null;
  $inTo=$_GET["inTo"]?? null;
  //$linkTo=$_GET["linkTo"]?? null;
  //$equalTo=$_GET["equalTo"]?? null;
  $response = new GetController();
  /***************************************
  *! Sin filtro
  ****************************************/
    /***************************************
    ** Petición GET
    ****************************************/
      if (!isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"]) ) {
        $response -> getData($table, $select, $orderBy,
            $orderMode, $startAt, $endAt);
      } else
    /***************************************
    ** Petición GET con orden
    ****************************************/
      if (isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])) {
        $response->getData($table, $select,$_GET["orderBy"],
            $_GET["orderMode"], $startAt, $endAt);
      }else
    /***************************************
     ** Petición GET con limites
    ****************************************/
      if (!isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])) {
        $response->getData($table, $select, $orderBy, $orderMode,
            $_GET["startAt"], $_GET["endAt"]);
      }else
    /***************************************
     ** Petición GET con orden con limites
    ****************************************/
      if (isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])) {
        $response->getData($table, $select, $_GET["orderBy"],
            $_GET["orderMode"], $_GET["startAt"], $_GET["endAt"]);
      }else
  /*******************************
  *! Con filtro
  ********************************/
    /***************************************************
    ** Petición GET con filtro.
    ****************************************************/
      if(isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && !isset ($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])){
        $response -> getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["equalTo"],
            $orderBy, $orderMode, $startAt, $endAt);
      }else
    /****************************************************
    ** Petición GET con filtro con orden.
    *****************************************************/
      if(isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])){
        $response -> getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["equalTo"],
            $_GET["orderBy"],$_GET["orderMode"],
            $startAt, $endAt);
      }else
    /****************************************************
    ** Petición GET con filtro con limites.
    *****************************************************/
      if(isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && !isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])){
        $response -> getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["equalTo"],
            $orderBy, $orderMode,
            $_GET["startAt"], $_GET["endAt"]);
      }else
    /******************************************************
     ** Petición GET con filtro con orden con limites.
    ******************************************************/
      if (isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])) {
        $response -> getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["equalTo"],
            $_GET["orderBy"], $_GET["orderMode"],
            $_GET["startAt"], $_GET["endAt"]);
      }else
  /************************************************************
  *! Con tablas relacionadas.
  *************************************************************/
    /************************************************************
    ** Petición GET sin filtros entre tablas relacionadas.
    *************************************************************/
      if(isset($_GET["rel"]) && isset($_GET["type"])
        && $table=="relations" && !isset($_GET["linkTo"])
        && !isset($_GET["equalTo"])){
        $response -> getRelData($_GET["rel"], $_GET["type"],
            $select, $orderBy, $orderMode, $startAt, $endAt);
      }else
    /************************************************************
    ** Petición GET con filtros entre tablas relacionadas.
    *************************************************************/
      if(isset($_GET["rel"]) && isset($_GET["type"])
        && $table=="relations" && isset($_GET["linkTo"])
        && isset($_GET["equalTo"])){
        $response -> getRelDataFilter($_GET["rel"], $_GET["type"],
          $select, $_GET["linkTo"], $_GET["equalTo"],
          $orderBy, $orderMode, $startAt, $endAt);
      }else
  /****************************************************
  *! Con buscadores
  *****************************************************/
    /****************************************************
    ** Peticiones Get para buscadores sin relaciones
    *****************************************************/
      if(!isset($_GET["rel"]) && !isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["searchTo"])) {
        $response->getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["searchTo"],
            $orderBy, $orderMode, $startAt, $endAt);
      }else
    /**************************************************************
    ** Peticiones Get para buscadores entre tablas relacionadas.
    ***************************************************************/
      if (isset($_GET["rel"]) && isset($_GET["type"])
        && $table == "relations" && isset($_GET["linkTo"])
        && isset($_GET["searchTo"])) {
        $response->getRelDataFilter($_GET["rel"], $_GET["type"],
            $select, $_GET["linkTo"], $_GET["searchTo"],
            $orderBy, $orderMode, $startAt, $endAt);
      }else
  /************************************************************
  *! Con rangos.
  *************************************************************/
    /************************************************************
    ** Peticiones Get para selección de rangos.
    *************************************************************/
      if (!isset($_GET["rel"]) && !isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["betweenIn"])
        && isset($_GET["betweenOut"])) {
        $response->getDataRange($table, $select,
            $_GET["linkTo"], $_GET["betweenIn"],
            $_GET["betweenOut"], $orderBy,
            $orderMode, $startAt, $endAt, $filterTo, $inTo);
      }else
    /****************************************************************
    ** Peticiones Get para selección de rangos con relaciones.
    *****************************************************************/
      if (isset($_GET["rel"]) && isset($_GET["type"])
        && $table == "relations" && isset($_GET["linkTo"])
        && isset($_GET["betweenIn"]) && isset($_GET["betweenOut"])) {
        $response->getRelDataRange($_GET["rel"],$_GET["type"],
            $select, $_GET["linkTo"], $_GET["betweenIn"],
            $_GET["betweenOut"], $orderBy, $orderMode,
            $startAt, $endAt, $filterTo, $inTo);
      }
?>