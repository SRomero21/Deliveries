<?php
  /****************************************
   * Petición GET.
   ****************************************/
    /****************************************
     *! Requerimientos.
    ****************************************/
      require_once "controllers/get.controller.php";
    /****************************************
     *? Variables.
    ****************************************/
      $table=explode("?",$arrayRouters[2])[0];
      $select=$_GET["select"]?? "*";
      $orderBy=$_GET["orderBy"]?? null;
      $orderMode=$_GET["orderMode"]?? null;
      $startAt=$_GET["startAt"]?? null;
      $endAt=$_GET["endAt"]?? null;
      $linkTo=$_GET["linkTo"]?? null;
      $inTo=$_GET["inTo"]?? null;
      $equalTo=$_GET["equalTo"]?? null;
      $filterTo=$_GET["filterTo"]?? null;
      $betweenIn=$_GET["betweenIn"]?? null;
      $betweenOut=$_GET["betweenOut"]?? null;
      $response = new GetController();
    /****************************************
     ** 01) Con select
     ****************************************/
      if ($table!="relations" && !isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])) {
        $response -> getData($table, $select, $orderBy,
            $orderMode, $startAt, $endAt);
      } else
    /********************************************
     ** 02) Con select con orden
     ********************************************/
      if ($table!="relations" && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])) {
        $response->getData($table, $select,$_GET["orderBy"],
            $_GET["orderMode"], $startAt, $endAt);
      }else
    /********************************************
     ** 03) Con select con limites
     ********************************************/
      if ($table!="relations" && !isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])) {
        $response->getData($table, $select, $orderBy, $orderMode,
            $_GET["startAt"], $_GET["endAt"]);
      }else
    /*******************************************
     ** 04) Con select con orden con limites
     ********************************************/
        if ($table!="relations" && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
          && isset($_GET["startAt"]) && isset($_GET["endAt"])
          && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])) {
          $response->getData($table, $select, $_GET["orderBy"],
              $_GET["orderMode"], $_GET["startAt"], $_GET["endAt"]);
        }else
    /****************************************************
     ** 05) Con select con filtro.
     ****************************************************/
      if($table!="relations" && isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && !isset ($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])){
        $response -> getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["equalTo"],
            $orderBy, $orderMode, $startAt, $endAt);
      }else
    /*****************************************************
     ** 06) Con select con filtro con orden.
     *****************************************************/
      if($table!="relations" && isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])){
        $response -> getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["equalTo"],
            $_GET["orderBy"],$_GET["orderMode"],
            $startAt, $endAt);
      }else
    /*****************************************************
     ** 07) Con select con filtro con limites.
     *****************************************************/
      if($table!="relations" && isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && !isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])){
        $response -> getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["equalTo"],
            $orderBy, $orderMode,
            $_GET["startAt"], $_GET["endAt"]);
      }else
    /*******************************************************
     ** 08) Con select con filtro con orden con limites.
     *******************************************************/
      if ($table!="relations" && isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])) {
        $response -> getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["equalTo"],
            $_GET["orderBy"], $_GET["orderMode"],
            $_GET["startAt"], $_GET["endAt"]);
      }else
    /*************************************************************
     ** 09) Con select con tablas relacionadas.
     *************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])
        && !isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])){
          $response -> getRelData($_GET["rel"], $_GET["type"],
          $select ,$orderBy, $orderMode, $startAt, $endAt);
      }else
    /*************************************************************
     ** 10) Con select con tablas relacionadas con orden.
     *************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])
        && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])){
          $response -> getRelData($_GET["rel"], $_GET["type"],
          $select, $_GET["orderBy"], $_GET["orderMode"], $startAt, $endAt);
      }else
    /*************************************************************
     ** 11) Con select con tablas relacionadas con limites.
     *************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])
        && !isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])){
          $response -> getRelData($_GET["rel"], $_GET["type"],
          $select, $orderBy, $orderMode,
          $_GET["startAt"], $_GET["endAt"]);
      }else
    /**********************************************************************
     ** 12) Con select con tablas relacionadas con ornen con limites.
     **********************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])
        && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])){
          $response -> getRelData($_GET["rel"], $_GET["type"],
          $select,$_GET["orderBy"], $_GET["orderMode"],
          $_GET["startAt"], $_GET["endAt"]);
      }else
    /*************************************************************
     ** 13) Con select con tablas relacionadas con filtro.
     *************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && !isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])){
        $response -> getRelDataFilter($_GET["rel"], $_GET["type"],
          $select, $_GET["linkTo"], $_GET["equalTo"],
          $orderBy, $orderMode, $startAt, $endAt);
      }else
    /**************************************************************************
     ** 14) Con select con tablas relacionadas con filtro con orden.
     **************************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && !isset($_GET["startAt"]) && !isset($_GET["endAt"])){
        $response -> getRelDataFilter($_GET["rel"], $_GET["type"],
          $select, $_GET["linkTo"], $_GET["equalTo"],
          $_GET["orderBy"], $_GET["orderMode"], $startAt, $endAt);
      }else
    /**************************************************************************
     ** 15) Con select con tablas relacionadas con filtro con limites.
     **************************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && !isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])){
        $response -> getRelDataFilter($_GET["rel"], $_GET["type"],
          $select, $_GET["linkTo"], $_GET["equalTo"],
          $orderBy, $orderMode, $_GET["startAt"], $_GET["endAt"]);
      }else
    /*************************************************************************************
     ** 16) Con select con tablas relacionadas con orden con filtro con limites.
     *************************************************************************************/
      if($table=="relations" && isset($_GET["rel"]) && isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["equalTo"])
        && isset($_GET["orderBy"]) && isset($_GET["orderMode"])
        && isset($_GET["startAt"]) && isset($_GET["endAt"])){
        $response -> getRelDataFilter($_GET["rel"], $_GET["type"],
          $select, $_GET["linkTo"], $_GET["equalTo"],
          $_GET["orderBy"], $_GET["orderMode"],
          $_GET["startAt"], $_GET["endAt"]);
      }else
    /*****************************************************
     ** 17) Con select con buscador
     *****************************************************/
      if(!isset($_GET["rel"]) && !isset($_GET["type"])
        && isset($_GET["linkTo"]) && isset($_GET["searchTo"])) {
          $response->getDataFilter($table, $select,
            $_GET["linkTo"], $_GET["searchTo"],
            $orderBy, $orderMode, $startAt, $endAt);
      }else
    /***************************************************************
     ** 12) Con select con buscador con tablas relacionadas.
     ***************************************************************/
      // if ($table == "relations" && isset($_GET["rel"]) && isset($_GET["type"])
      //   && isset($_GET["linkTo"]) && isset($_GET["searchTo"])
      //   && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])
      //   && !isset($_GET["orderBy"]) && !isset($_GET["orderMode"])
      //   && !isset($_GET["startTo"]) && !isset($_GET["endTo"])) {
      //   $response->getRelDataFilter($_GET["rel"], $_GET["type"],
      //       $select, $_GET["linkTo"], $_GET["searchTo"],
      //       $orderBy, $orderMode, $startAt, $endAt);
      // }else
    /*************************************************************
     ** 13) Con select con rangos.
     *************************************************************/
      // if ($table != "relations" && !isset($_GET["rel"]) && !isset($_GET["type"])
      //   && isset($_GET["linkTo"]) && isset($_GET["betweenIn"])
      //   && isset($_GET["betweenOut"])) {
      //   $response->getDataRange($table, $select,
      //       $_GET["linkTo"], $_GET["betweenIn"],
      //       $_GET["betweenOut"], $orderBy,
      //       $orderMode, $startAt, $endAt, $filterTo, $inTo);
      // }else
    /********************************************************************
     ** 14) Con select con rangos con tablas relacionadas.
     ********************************************************************/
      // if ($table == "relations" && isset($_GET["rel"]) && isset($_GET["type"])
      //   && isset($_GET["linkTo"]) && isset($_GET["betweenIn"]) && isset($_GET["betweenOut"])){
      //   $response->getRelDataRange($_GET["rel"],$_GET["type"],
      //       $select, $_GET["linkTo"], $_GET["betweenIn"],
      //       $_GET["betweenOut"], $orderBy, $orderMode,
      //       $startAt, $endAt, $filterTo, $inTo);
      // }
?>