<?php
  require_once "connection.php";
  class GetModel{
    /*******************************
    ** Petición Get sin filtro
    ********************************/
    static public function getData($table,$select, $orderBy,$orderMode, $startAt, $endAt){
      /*******************************
      *? Sin limitar ni ordenar datos
      ********************************/
      $sql= "SELECT $select FROM $table";
      /*********************************
      *? Ordenar datos sin limitar
      **********************************/
      if($orderBy!=null && $orderMode!=null && $startAt==null && $endAt==null){
        $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode";
      }
      /*********************************
      *? Ordenar y limitar datos
      **********************************/
      if ($orderBy!=null && $orderMode!=null && $startAt!=null && $endAt!=null) {
        $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
      }
      /*******************************
      *? limitar datos sin ordenar
      ********************************/
      if ($orderBy==null && $orderMode==null && $startAt!=null && $endAt!=null) {
        $sql = "SELECT $select FROM $table LIMIT $startAt, $endAt";
      }
      $stmt = Connection::connect()->prepare($sql);
      $stmt -> execute();
      return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    /*******************************
    ** Petición Get con filtro
    ********************************/
    static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){
      $linkToArray = explode(",", $linkTo);
      $equalToArray = explode("_", $equalTo);
      $linkToText="";
      if(count($linkToArray)>1){
        foreach ($linkToArray as $key => $value) {
          if($key >0){
            $linkToText.="AND ".$value."=:".$value." ";
          }
        }
      }
      /***********************************
      *?  Sin limitar ni ordenar datos
      **********************************/
      $sql="SELECT $select FROM $table WHERE $linkToArray[0]=:$linkToArray[0] $linkToText";
      /*********************************
      *? Ordenar datos sin limitar
      **********************************/
      if ($orderBy!=null && $orderMode!=null && $startAt==null && $endAt==null){
        $sql="SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode";
      }
      /*********************************
       *? Ordenar y limitar datos
      **********************************/
      if ($orderBy!=null && $orderMode!=null && $startAt!=null && $endAt!=null) {
        $sql="SELECT $select FROM $table WHERE $linkToArray[0]=:$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
      }
      /*******************************
       *? limitar datos sin ordenar
      ********************************/
      if ($orderBy==null && $orderMode==null && $startAt!=null && $endAt!=null) {
        $sql="SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText LIMIT $startAt, $endAt";
      }
      $stmt = Connection::connect()->prepare($sql);
      foreach ($linkToArray as $key => $value) {
        $stmt -> bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR);
      }
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    /************************************************************
     ** Peticiones Get sin filtros entre tablas relacionadas.
    *************************************************************/
    static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt){
      $relToArray = explode(",", $rel);
      $typeToArray = explode(",", $type);
      $innerJoinToText="";
      if (count($relToArray) > 1) {
        foreach ($relToArray as $key => $value) {
          if ($key > 0) {
            $innerJoinToText.="INNER JOIN ".$value." ON ".$relToArray[0].".id_".$typeToArray[$key]."_".$typeToArray[0]." = ".$value.".id_".$typeToArray[$key]." ";
          }
        }
        /***********************************
        *? Sin limitar ni ordenar datos
        **********************************/
        $sql="SELECT $select FROM $relToArray[0] $innerJoinToText";
        /*********************************
        *? Ordenar datos sin limitar
        **********************************/
        if($orderBy!=null && $orderMode!=null && $startAt==null && $endAt==null){
          $sql="SELECT $select FROM $relToArray[0] $innerJoinToText ORDER BY $orderBy $orderMode";
        }
        /*********************************
        *? Ordenar y limitar datos
        **********************************/
        if ($orderBy!=null && $orderMode!=null && $startAt!=null && $endAt!=null) {
          $sql="SELECT $select FROM $relToArray[0] $innerJoinToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }
        /*******************************
        *? limitar datos sin ordenar
        ********************************/
        if ($orderBy==null && $orderMode==null && $startAt!=null && $endAt!=null) {
          $sql="SELECT $select FROM $relToArray[0] $innerJoinToText LIMIT $startAt, $endAt";
        }
        $stmt = Connection::connect()->prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
      }else{
        return null;
      }
    }
    /************************************************************
     ** Peticiones Get con filtros en tablas relacionadas.
    *************************************************************/
    static public function getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){
      /*******************************
      *? Organización de relaciones
      ********************************/
      $relToArray = explode(",", $rel);
      $typeToArray = explode(",", $type);
      $innerJoinToText="";
      if (count($relToArray) > 1) {
        foreach ($relToArray as $key => $value) {
          if ($key > 0) {
            $innerJoinToText.="INNER JOIN ".$value." ON ".$relToArray[0].".id_".$typeToArray[$key]."_".$typeToArray[0]." = ".$value.".id_".$typeToArray[$key]." ";
          }
        }
        /*******************************
        *? Organización de filtros
        ********************************/
        $linkToArray = explode(",", $linkTo);
        $equalToArray = explode("_", $equalTo);
        $filterToText = "";
        if (count($linkToArray) > 1) {
          foreach ($linkToArray as $key => $value) {
            if ($key > 0) {
              $filterToText.="AND ".$value."=:".$value." ";
            }
          }
        }
        /***********************************
        *? Sin limitar ni ordenar datos
        **********************************/
        $sql="SELECT $select FROM $relToArray[0] $innerJoinToText WHERE $linkToArray[0]=:$linkToArray[0] $filterToText";
        /*********************************
        *? Ordenar datos sin limitar
        **********************************/
        if($orderBy!=null && $orderMode!=null && $startAt==null && $endAt==null){
          $sql="SELECT $select FROM $relToArray[0] $innerJoinToText WHERE $linkToArray[0]=:$linkToArray[0] $filterToText ORDER BY $orderBy $orderMode";
        }
        /*********************************
        *? Ordenar y limitar datos
        **********************************/
        if ($orderBy!=null && $orderMode!=null && $startAt!=null && $endAt!=null) {
          $sql="SELECT $select FROM $relToArray[0] $innerJoinToText WHERE $linkToArray[0]=:$linkToArray[0] $filterToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }
        /*******************************
        *? limitar datos sin ordenar
        ********************************/
        if ($orderBy==null && $orderMode==null && $startAt!=null && $endAt!=null) {
          $sql="SELECT $select FROM $relToArray[0] $innerJoinToText WHERE $linkToArray[0]=:$linkToArray[0] $filterToText LIMIT $startAt, $endAt";
        }
        $stmt = Connection::connect()->prepare($sql);
        foreach ($linkToArray as $key => $value){
          $stmt->bindParam(":".$value,$equalToArray[$key],PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
      }else{
        return null;
      }
    }
    /*******************************************************
    ** Peticiones Get para buscadores sin relaciones
    ********************************************************/
    static public function getDataSearch($table, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt){
      $linkToArray = explode(",", $linkTo);
      $searchToArray = explode("_", $searchTo);
      $searchToText = "";
      if (count($linkToArray) > 1) {
        foreach ($linkToArray as $key => $value) {
          if ($key > 0) {
            $searchToText .= "AND " . $value . "=:" . $value . " ";
          }
        }
      }
      /*******************************
       *? Sin limitar ni ordenar datos
        ********************************/
      $sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $searchToText";
      /*********************************
       *? Ordenar datos sin limitar
        **********************************/
      if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
        $sql = "SELECT $select FROM $table  WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $searchToText ORDER BY $orderBy $orderMode";
      }
      /*********************************
       *? Ordenar y limitar datos
        **********************************/
      if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
        $sql = "SELECT $select FROM $table  WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $searchToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
      }
      /*******************************
       *? limitar datos sin ordenar
        ********************************/
      if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
        $sql = "SELECT $select FROM $table  WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $searchToText LIMIT $startAt, $endAt";
      }
      $stmt = Connection::connect()->prepare($sql);
      foreach ($linkToArray as $key => $value) {
        if($key>0){
          $stmt->bindParam(":".$value, $searchToArray[$key], PDO::PARAM_STR);
        }
      }
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    /************************************************************
     ** Peticiones Get para buscadores en tablas relacionadas.
    *************************************************************/
    static public function getRelDataSearch($rel, $type, $select, $linkTo, $searchTo, $orderBy, $orderMode, $startAt, $endAt){
      /*******************************
      *? Organización de relaciones
      ********************************/
      $relToArray = explode(",", $rel);
      $typeToArray = explode(",", $type);
      $innerJoinToText = "";
      if (count($relToArray) > 1) {
        foreach ($relToArray as $key => $value) {
          if ($key > 0) {
            $innerJoinToText .= "INNER JOIN ".$value." ON ".$relToArray[0].".id_".$typeToArray[$key]."_".$typeToArray[0]." = ".$value.".id_".$typeToArray[$key]." ";
          }
        }
        /*******************************
        *? Organización de búsqueda
        ********************************/
        $linkToArray = explode(",", $linkTo);
        $searchToArray = explode("_", $searchTo);
        $searchToText = "";
        if (count($linkToArray) > 1) {
          foreach ($linkToArray as $key => $value) {
            if ($key > 0) {
              $searchToText.="AND ".$value."=:".$value." ";
            }
          }
        }
        /***********************************
         *? Sin limitar ni ordenar datos
        **********************************/
        $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $searchToText";
        /*********************************
         *? Ordenar datos sin limitar
        **********************************/
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
          $sql="SELECT $select FROM $relToArray[0] $innerJoinToText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $searchToText ORDER BY $orderBy $orderMode";
        }
        /*********************************
         *? Ordenar y limitar datos
        **********************************/
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
          $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $searchToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }
        /*******************************
         *? limitar datos sin ordenar
        ********************************/
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
          $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $searchToText LIMIT $startAt, $endAt";
        }
        $stmt = Connection::connect()->prepare($sql);
        foreach ($linkToArray as $key => $value) {
          if($key>0){
            $stmt->bindParam(":".$value, $searchToArray[$key], PDO::PARAM_STR);
          }
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
      } else {
        return null;
      }
    }
  }
?>