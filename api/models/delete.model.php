<?php
    /****************************************
     *todo Delete Model.
     ****************************************/
        /****************************************
         *! Requerimientos.
        ****************************************/
            require_once "connection.php";
            require_once "get.model.php";
            require_once "put.model.php";
        /****************************************
         *? Class DELETE model.
         ****************************************/
            class DeleteModel{
                /******************************************
                 ** Petición DELETE para borrar datos.
                 ******************************************/
                    static public function deleteData($table,$data, $id, $nameId){
                        /************************************
                         *? Validación del ID
                         ************************************/
                            $response=GetModel::getDataFilter($table, $nameId,
                            $nameId, $id, null, null, null, null);
                            if(empty($response)){
                                return null;
                            }
                        /********************************************
                         *? Validando la data
                        ********************************************/
                            if(is_null($data)){
                                /********************************
                                 *? Borrar registro de la DB
                                ********************************/
                                /********************************
                                 *? Armando sentencia sql
                                ********************************/
                                    $sql = "DELETE FROM $table WHERE $nameId = :$nameId";
                                /********************************
                                 *? Contención con sql
                                ********************************/
                                    $link=Connection::connect();
                                    $stmt = $link->prepare($sql);
                                /********************************
                                 *? Armado los parámetros.
                                ********************************/
                                    $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_STR);
                                /********************************
                                 *? Ejecutar sentencia sql.
                                ********************************/
                                    if($stmt->execute()){
                                        $response = array(
                                            "comment" => "The process was successful"
                                        );
                                        return $response;
                                    }else{
                                        return $link->errorInfo();
                                    }
                            }else{
                                /***************************************************
                                 *? Actualiza el estado del registro de la DB
                                ***************************************************/
                                $response=PutModel::putData($table, $data, $id, $nameId);
                                if(empty($response)){
                                    return null;
                                }else{
                                    return $response;
                                }
                            }
                    }
            }

?>