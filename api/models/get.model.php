<?php
  /****************************************
   *todo GET Modelo.
   ****************************************/
    /****************************************
     *! Requerimientos.
    ****************************************/
      require_once "connection.php";
    /****************************************
     *? Class GET model.
     ****************************************/
      class GetModel{
        /********************************
         ** Petición Get.
         ********************************/
          static public function getData($table, $select,
            $orderBy,$orderMode, $startAt, $endAt){
            /***********************************************
             *? Validar exigencia de la tabla y columnas
            ***********************************************/
              $selectArray = explode(",", $select);
              if (empty(Connection::getColumnsData($table, $selectArray))) {
                return null;
              }
            /********************************
             *? con select
            ********************************/
              $sql= "SELECT $select FROM $table";
            /**********************************
             *? Con select con orden
            **********************************/
              if($orderBy!=null && $orderMode!=null
                && $startAt==null && $endAt==null){
                $sql = "SELECT $select FROM $table
                        ORDER BY $orderBy $orderMode";
              }
            /**********************************
             *? Con select con limites
            **********************************/
              if ($orderBy==null && $orderMode==null
                && $startAt!=null && $endAt!=null) {
                $sql = "SELECT $select FROM $table
                        LIMIT $startAt, $endAt";
              }
            /***************************************
             *? Con select con orden con limites
            ***************************************/
              if ($orderBy!=null && $orderMode!=null
                && $startAt!=null && $endAt!=null) {
                $sql = "SELECT $select FROM $table
                        ORDER BY $orderBy $orderMode
                        LIMIT $startAt, $endAt";
              }
            /********************************
             *? Contención con sql
            ********************************/
              $stmt = Connection::connect()->prepare($sql);
            /********************************
             *? Ejecutar sentencia sql.
            ********************************/
              try {
                $stmt->execute();
              } catch (PDOException $Exception) {
                return null;
              }
            /********************************
             *? Retorno del getData.
            ********************************/
              return $stmt->fetchAll(PDO::FETCH_CLASS);
          }
        /********************************
         ** Petición Get con filtro.
         ********************************/
          static public function getDataFilter($table, $select,
            $linkTo, $equalTo, $orderBy, $orderMode,
            $startAt, $endAt){
            /************************************
             *? Armado de variables
            ************************************/
              $selectArray = explode(",", $select);
              $linkToArray = explode(",",$linkTo);
              $equalToArray = explode("_",$equalTo);
              $linkToText="";
            /************************************
             *? validar exigencia de la tabla
            ************************************/
              foreach($linkToArray as $key => $value){
                array_push($selectArray, $value);
              }
              $selectArray=array_unique($selectArray);
              if (empty(Connection::getColumnsData($table, $selectArray))){
                return null;
              }
            /************************************
             *? Armado del multi filtro
            ************************************/
              if(count($linkToArray)>1){
                foreach ($linkToArray as $key => $value) {
                  if($key >0){
                    $linkToText.="AND ".$value." = :".$value." ";
                  }
                }
              }
            /***************************************
             *? Con filtro
            ***************************************/
              if ($orderBy==null && $orderMode==null
                && $startAt==null && $endAt==null){
                  $sql="SELECT $select FROM $table
                        WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";
                }
            /****************************************
             *? Con filtro con orden
            ****************************************/
              if ($orderBy!=null && $orderMode!=null
                && $startAt==null && $endAt==null){
                $sql="SELECT $select FROM $table
                      WHERE $linkToArray[0] = :$linkToArray[0] $linkToText
                      ORDER BY $orderBy $orderMode";
              }
            /*******************************************
             *? Con filtro con limites
            *******************************************/
              if ($orderBy==null && $orderMode==null
                && $startAt!=null && $endAt!=null) {
                $sql="SELECT $select FROM $table
                      WHERE $linkToArray[0] = :$linkToArray[0] $linkToText
                      LIMIT $startAt, $endAt";
              }
            /*******************************************
             *? Con filtro con orden con limites
            *******************************************/
              if ($orderBy!=null && $orderMode!=null
                && $startAt!=null && $endAt!=null) {
                $sql="SELECT $select FROM $table
                      WHERE $linkToArray[0]=:$linkToArray[0] $linkToText
                      ORDER BY $orderBy $orderMode
                      LIMIT $startAt, $endAt";
              }
            /********************************
             *? Contención con sql
            ********************************/
              $stmt = Connection::connect()->prepare($sql);
            /********************************
             *? Armado los parámetros.
            ********************************/
              foreach ($linkToArray as $key => $value){
                $stmt -> bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR);
              }
            /********************************
             *? Ejecutar sentencia sql.
            ********************************/
              try{
                $stmt->execute();
              }catch(PDOException $Exception){
                return null;
              }
            /*********************************
             *? Retorno del getDataFilter.
            *********************************/
              return $stmt->fetchAll(PDO::FETCH_CLASS);
          }
        /*******************************************************
         ** Peticiones Get para buscadores.
         *******************************************************/
          static public function getDataSearch($table, $select, $linkTo,
            $searchTo, $orderBy, $orderMode, $startAt, $endAt){
            /********************************
             *? Armado de variables.
            ********************************/
              $selectArray=explode(",", $select);
              $linkToArray = explode(",", $linkTo);
              $searchToArray = explode("_", $searchTo);
              $searchToText = "";
            /************************************
             *? validar exigencia de la tabla
            ************************************/
              foreach($linkToArray as $key => $value){
                array_push($selectArray, $value);
              }
              $selectArray=array_unique($selectArray);
              if (empty(Connection::getColumnsData($table, $selectArray))){
                return null;
              }
            /************************************
             *? validar exigencia de la tabla
            ************************************/
              foreach($linkToArray as $key => $value){
                array_push($selectArray, $value);
              }
              $selectArray=array_unique($selectArray);
              if (empty(Connection::getColumnsData($table, $selectArray))){
                return null;
              }
            /************************************
             *? Armado del multi filtro
            ************************************/
              if (count($linkToArray) > 1) {
                foreach ($linkToArray as $key => $value) {
                  if ($key > 0) {
                    $searchToText .= "AND " . $value . "=:" . $value . " ";
                  }
                }
              }
            /********************************
             *? Con buscadores
            ********************************/
              $sql = "SELECT $select FROM $table
                      WHERE $linkToArray[0]
                      LIKE '%$searchToArray[0]%' $searchToText";
            /*********************************
             *? Con buscadores Con Ordena
            **********************************/
              if ($orderBy != null && $orderMode != null
                && $startAt == null && $endAt == null) {
                $sql = "SELECT $select FROM $table
                        WHERE $linkToArray[0]
                        LIKE '%$searchToArray[0]%' $searchToText
                        ORDER BY $orderBy $orderMode";
              }
            /********************************
             *? Con buscadores Con limites
            ********************************/
              if ($orderBy == null && $orderMode == null
                && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $table
                        WHERE $linkToArray[0]
                        LIKE '%$searchToArray[0]%' $searchToText
                        LIMIT $startAt, $endAt";
              }
            /***********************************************
             *? Con buscadores Con Orden con limites
            ***********************************************/
              if ($orderBy != null && $orderMode != null
                && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $table
                        WHERE $linkToArray[0]
                        LIKE '%$searchToArray[0]%' $searchToText
                        ORDER BY $orderBy $orderMode
                        LIMIT $startAt, $endAt";
              }
            /********************************
              *? Contención con sql
            ********************************/
              $stmt = Connection::connect()->prepare($sql);
            /********************************
             *? Armado los parámetros.
            ********************************/
              foreach ($linkToArray as $key => $value) {
                if($key>0){
                  $stmt->bindParam(":".$value, $searchToArray[$key], PDO::PARAM_STR);
                }
              }
            /********************************
             *? Ejecutar sentencia sql.
            ********************************/
              try {
                $stmt->execute();
              } catch (PDOException $Exception) {
                return null;
              }
            /*********************************
              *? Retorno del getRelData.
            *********************************/
              return $stmt->fetchAll(PDO::FETCH_CLASS);
          }
        /************************************************************
         ** Peticiones Get con rangos.
         *************************************************************/
          static public function getDataRange($table, $select, $linkTo, $betweenIn,
            $betweenOut, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo){
            /********************************
             *? Armado de variables.
            ********************************/
              $linkToArray = explode(",", $linkTo);
              $selectArray=explode(",", $select);
              $filToText="";
            /************************************
             *? validar exigencia de la tabla
            ************************************/
              foreach($linkToArray as $key => $value){
                array_push($selectArray, $value);
              }
              $selectArray=array_unique($selectArray);
              if (empty(Connection::getColumnsData($table, $selectArray))){
                return null;
              }
            /***********************************
             *? Armado filtro
            ************************************/
              if($filterTo!=null && $inTo!=null){
                $filToText='AND '.$filterTo.' IN ('.$inTo.')';
              }
            /*******************************
            *? Con rangos.
            ********************************/
              $sql = "SELECT $select FROM $table
                      WHERE $linkTo
                      BETWEEN '$betweenIn'
                      AND '$betweenOut' $filToText";
            /*********************************
            *? Con rango con orden.
            **********************************/
              if ($orderBy != null && $orderMode != null
                && $startAt == null && $endAt == null) {
                $sql = "SELECT $select FROM $table
                        WHERE $linkTo
                        BETWEEN '$betweenIn'
                        AND '$betweenOut' $filToText
                        ORDER BY $orderBy $orderMode";
              }
            /*******************************
            *? Con rango con limites.
            ********************************/
              if ($orderBy == null && $orderMode == null
                && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $table
                        WHERE $linkTo
                        BETWEEN '$betweenIn'
                        AND '$betweenOut' $filToText
                        LIMIT $startAt, $endAt";
              }
            /****************************************
            *? Con rango con orden con limites.
            ****************************************|*/
              if ($orderBy != null && $orderMode != null
                && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $table
                        WHERE $linkTo
                        BETWEEN '$betweenIn'
                        AND '$betweenOut' $filToText
                        ORDER BY $orderBy $orderMode
                        LIMIT $startAt, $endAt";
              }
            /********************************
             *? Contención con sql
             ********************************/
              $stmt = Connection::connect()->prepare($sql);
            /********************************
             *? Ejecutar sentencia sql.
             ********************************/
              try {
                $stmt->execute();
              } catch (PDOException $Exception) {
                return null;
              }
            /*********************************
             *? Retorno del getRelData.
             *********************************/
              return $stmt->fetchAll(PDO::FETCH_CLASS);
          }
        /************************************************************
         ** Peticiones Get con tablas relacionadas.
         *************************************************************/
          static public function getRelData($rel, $type,$select, $orderBy,
            $orderMode, $startAt, $endAt){
            /********************************
             *? Armado de variables.
            ********************************/
              $relToArray = explode(",", $rel);
              $typeToArray = explode(",", $type);
              $innerJoinToText="";
            /***********************************
             *? Validar si mas una tablas.
            ***********************************/
              if (count($relToArray) > 1) {
                /********************************
                 *? Armado del Inner Join.
                ********************************/
                  foreach ($relToArray as $key => $value) {
                    if ($key > 0) {
                      $innerJoinToText.="INNER JOIN ".$value." ON "
                                      .$relToArray[0].".id_".$typeToArray[$key]."_".$typeToArray[0]
                                      ." = ".$value.".id_".$typeToArray[$key]." ";
                    }
                  }
                /***********************************
                 *? Con tablas relacionadas.
                ***********************************/
                    $sql="SELECT $select FROM $relToArray[0] $innerJoinToText";
                /****************************************
                 *? Con tablas relacionas con orden
                ****************************************/
                  if($orderBy!=null && $orderMode!=null
                    && $startAt==null && $endAt==null){
                    $sql="SELECT $select FROM $relToArray[0] $innerJoinToText
                          ORDER BY $orderBy $orderMode";
                  }
                /****************************************
                 *? Con tablas relacionas con limites
                ****************************************/
                  if ($orderBy==null && $orderMode==null
                    && $startAt!=null && $endAt!=null) {
                    $sql="SELECT $select FROM $relToArray[0] $innerJoinToText
                          LIMIT $startAt, $endAt";
                  }
                /***************************************************
                 *? Con tablas relacionas con orden con limites
                ***************************************************/
                  if ($orderBy!=null && $orderMode!=null
                    && $startAt!=null && $endAt!=null){
                    $sql="SELECT $select FROM $relToArray[0] $innerJoinToText
                          ORDER BY $orderBy $orderMode
                          LIMIT $startAt, $endAt";
                  }
                /********************************
                 *? Contención con sql
                ********************************/
                  $stmt = Connection::connect()->prepare($sql);
                /********************************
                 *? Ejecutar sentencia sql.
                ********************************/
                  try{
                    $stmt->execute();
                  }catch(PDOException $Exception) {
                    return null;
                  }
                /********************************
                 *? Retorno del getRelData.
                ********************************/
                  return $stmt->fetchAll(PDO::FETCH_CLASS);
              }else{
                /*********************************************
                 *? Retorno null si solo hay una tabla.
                *********************************************/
                  return null;
              }
          }
        /************************************************************
         ** Peticiones Get con tablas relacionadas con filtros.
         *************************************************************/
          static public function getRelDataFilter($rel, $type, $select,
            $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){
            /********************************
             *? Armado de variables.
            ********************************/
              $relToArray = explode(",", $rel);
              $typeToArray = explode(",", $type);
              $innerJoinToText="";
              $linkToArray = explode(",", $linkTo);
              $equalToArray = explode("_", $equalTo);
              $filterToText = "";
            /***********************************
             *? Validar si mas una tablas.
            ***********************************/
              if (count($relToArray) > 1){
                /********************************
                 *? Armado del Inner Join.
                ********************************/
                  foreach ($relToArray as $key => $value) {
                    if ($key > 0) {
                      $innerJoinToText.="INNER JOIN ".$value." ON "
                                          .$relToArray[0].".id_".$typeToArray[$key]."_".$typeToArray[0]
                                          ." = ".$value.".id_".$typeToArray[$key]." ";
                    }
                  }
                /*******************************
                 *? Organización de filtros
                ********************************/
                  if (count($linkToArray) > 1) {
                    foreach ($linkToArray as $key => $value) {
                      if ($key > 0) {
                        $filterToText.="AND ".$value."=:".$value." ";
                      }
                    }
                  }
                /********************************************
                 *? Con tablas relacionadas con filtro.
                ********************************************/
                  $sql="SELECT $select FROM $relToArray[0] $innerJoinToText
                        WHERE $linkToArray[0]=:$linkToArray[0] $filterToText";
                /*******************************************************
                 *? Con tablas relacionadas con filtro con orden.
                *******************************************************/
                  if($orderBy!=null && $orderMode!=null && $startAt==null && $endAt==null){
                    $sql="SELECT $select FROM $relToArray[0] $innerJoinToText
                          WHERE $linkToArray[0]=:$linkToArray[0] $filterToText
                          ORDER BY $orderBy $orderMode";
                  }
                /************************************************************
                 *? Con tablas relacionadas con filtro con limites.
                 ************************************************************/
                  if ($orderBy==null && $orderMode==null && $startAt!=null && $endAt!=null) {
                    $sql="SELECT $select FROM $relToArray[0] $innerJoinToText
                          WHERE $linkToArray[0]=:$linkToArray[0] $filterToText
                          LIMIT $startAt, $endAt";
                  }
                /************************************************************************
                 *? Con tablas relacionadas con filtro con orden con limites
                 ************************************************************************/
                  if ($orderBy!=null && $orderMode!=null && $startAt!=null && $endAt!=null) {
                    $sql="SELECT $select FROM $relToArray[0] $innerJoinToText
                          WHERE $linkToArray[0]=:$linkToArray[0] $filterToText
                          ORDER BY $orderBy $orderMode
                          LIMIT $startAt, $endAt";
                  }
                /********************************
                 *? Contención con sql
                 ********************************/
                  $stmt = Connection::connect()->prepare($sql);
                /********************************
                 *? Armado los parámetros.
                 ********************************/
                  foreach ($linkToArray as $key => $value){
                    $stmt->bindParam(":".$value,$equalToArray[$key],PDO::PARAM_STR);
                  }
                /********************************
                 *? Ejecutar sentencia sql.
                 ********************************/
                  try {
                    $stmt->execute();
                  } catch (PDOException $Exception) {
                    return null;
                  }
                /********************************
                 *? Retorno del getRelData.
                 ********************************/
                  return $stmt->fetchAll(PDO::FETCH_CLASS);
              }else{
                /*********************************************
                 *? Retorno null si solo hay una tabla.
                *********************************************/
                  return null;
              }
          }
        /***************************************************************
         ** Peticiones Get con tablas relacionadas con buscadores.
         ***************************************************************/
          static public function getRelDataSearch($rel, $type, $select, $linkTo,
            $searchTo, $orderBy, $orderMode, $startAt, $endAt){
            /********************************
             *? Armado de variables.
             ********************************/
              $relToArray = explode(",", $rel);
              $typeToArray = explode(",", $type);
              $linkToArray = explode(",", $linkTo);
              $searchToArray = explode("_", $searchTo);
              $innerJoinToText = "";
              $searchToText = "";
            /***********************************
             *? Validar si mas una tablas.
             ***********************************/
              if (count($linkToArray) > 1) {
              /********************************
               *? Organización de relaciones
              ********************************/
                if (count($relToArray) > 1) {
                  foreach ($relToArray as $key => $value) {
                    if ($key > 0) {
                      $innerJoinToText .= "INNER JOIN ".$value." ON ".$relToArray[0]
                                        .".id_".$typeToArray[$key]."_".$typeToArray[0]." = "
                                        .$value.".id_".$typeToArray[$key]." ";
                    }
                  }
                  /*******************************
                  *? Organización de búsqueda
                  ********************************/
                    foreach ($linkToArray as $key => $value) {
                      if ($key > 0) {
                        $searchToText.="AND ".$value."=:".$value." ";
                      }
                    }
                  /***********************************
                   *? Con buscador
                  **********************************/
                    $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText
                            WHERE $linkToArray[0]
                            LIKE '%$searchToArray[0]%' $searchToText";
                  /*********************************
                   *? Con buscador con orden
                  **********************************/
                    if ($orderBy != null && $orderMode != null
                      && $startAt == null && $endAt == null) {
                      $sql="SELECT $select FROM $relToArray[0] $innerJoinToText
                            WHERE $linkToArray[0]
                            LIKE '%$searchToArray[0]%' $searchToText
                            ORDER BY $orderBy $orderMode";
                    }
                  /********************************
                   *? limitar datos sin ordenar
                  ********************************/
                    if ($orderBy == null && $orderMode == null
                      && $startAt != null && $endAt != null) {
                      $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText
                              WHERE $linkToArray[0]
                              LIKE '%$searchToArray[0]%' $searchToText
                              LIMIT $startAt, $endAt";
                    }
                  /*********************************
                   *? Con buscador con limites
                  **********************************/
                    if ($orderBy != null && $orderMode != null
                      && $startAt != null && $endAt != null) {
                      $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText
                              WHERE $linkToArray[0]
                              LIKE '%$searchToArray[0]%' $searchToText
                              ORDER BY $orderBy $orderMode
                              LIMIT $startAt, $endAt";
                    }
                  /********************************
                   *? Contención con sql
                  ********************************/
                    $stmt = Connection::connect()->prepare($sql);
                  /********************************
                   *? Armado los parámetros.
                  ********************************/
                    foreach ($linkToArray as $key => $value) {
                      if($key>0){
                        $stmt->bindParam(":".$value, $searchToArray[$key], PDO::PARAM_STR);
                      }
                    }
                  /********************************
                   *? Ejecutar sentencia sql.
                  ********************************/
                    try {
                      $stmt->execute();
                    } catch (PDOException $Exception) {
                      return null;
                    }
                  /*********************************
                    *? Retorno del getRelData.
                  *********************************/
                    return $stmt->fetchAll(PDO::FETCH_CLASS);
                } else {
                  /*********************************************
                   *? Retorno null si solo hay una tabla.
                  *********************************************/
                    return null;
                }
              }
          }
        /************************************************************
        ** Peticiones Get con tablas relacionadas con rangos.
        *************************************************************/
          static public function getRelDataRange($rel, $type, $select, $linkTo,
            $betweenIn, $betweenOut, $orderBy, $orderMode, $startAt, $endAt,
            $filterTo, $inTo){
            /********************************
             *? Armado de variables.
             ********************************/
              $relToArray = explode(",", $rel);
              $typeToArray = explode(",", $type);
              $innerJoinToText = "";
              $filToText = "";
            /***********************************
             *? Validar si mas una tablas.
             ***********************************/
              if (count($relToArray) > 1) {
                /********************************
                 *? Organización de relaciones.
                 ********************************/
                  foreach ($relToArray as $key => $value) {
                    if ($key > 0) {
                      $innerJoinToText.="INNER JOIN ".$value." ON "
                                      .$relToArray[0].".id_".$typeToArray[$key]."_".$typeToArray[0]
                                      ." = ".$value.".id_".$typeToArray[$key]." ";
                    }
                  }
                /********************************
                 *? Armado el filtro Between.
                 ********************************/
                  if ($filterTo != null && $inTo != null) {
                    $filToText = 'AND ' . $filterTo . ' IN (' . $inTo . ')';
                  }
                /********************************
                 *? Con rango.
                 ********************************/
                  $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText
                          WHERE $linkTo
                          BETWEEN '$betweenIn'
                          AND '$betweenOut' $filToText";
                /**********************************
                 *? Con rango con orden.
                 **********************************/
                  if ($orderBy != null && $orderMode != null
                    && $startAt == null && $endAt == null) {
                    $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText
                            WHERE $linkTo
                            BETWEEN '$betweenIn'
                            AND '$betweenOut' $filToText
                            ORDER BY $orderBy $orderMode";
                  }
                /********************************
                 *? Con rango con limites.
                 ********************************/
                  if ($orderBy == null && $orderMode == null
                    && $startAt != null && $endAt != null) {
                    $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText
                            WHERE $linkTo
                            BETWEEN '$betweenIn'
                            AND '$betweenOut' $filToText
                            LIMIT $startAt, $endAt";
                  }
                /**************************************
                *? Con rango con orden con limites
                ***************************************/
                  if ($orderBy != null && $orderMode != null
                    && $startAt != null && $endAt != null) {
                    $sql = "SELECT $select FROM $relToArray[0] $innerJoinToText
                            WHERE $linkTo
                            BETWEEN '$betweenIn'
                            AND '$betweenOut' $filToText
                            ORDER BY $orderBy $orderMode
                            LIMIT $startAt, $endAt";
                  }
                /********************************
                 *? Contención con sql
                ********************************/
                $stmt = Connection::connect()->prepare($sql);
                /********************************
                 *? Ejecutar sentencia sql.
                ********************************/
                  try {
                    $stmt->execute();
                  } catch (PDOException $Exception) {
                    return null;
                  }
                /*********************************
                  *? Retorno del getRelData.
                *********************************/
                  return $stmt->fetchAll(PDO::FETCH_CLASS);
              } else {
                  /*********************************************
                   *? Retorno null si solo hay una tabla.
                  *********************************************/
                    return null;
              }
          }
        }
  ?>