<?php
    /****************************************
     *todo Put Model.
     ****************************************/
        /****************************************
         *! Requerimientos.
        ****************************************/
            require_once "connection.php";
            require_once "get.model.php";
        /****************************************
         *? ClasS PUT model.
         ****************************************/
            class PutModel{
                /******************************************
                 ** Petición Put para editar datos.
                 ******************************************/
                    static public function putData($table, $data, $id, $nameId){
                        /************************************
                         *? Validación del ID
                         ************************************/
                            $response=GetModel::getDataFilter($table, $nameId,
                                                    $nameId, $id, null, null, null, null);
                            if(empty($response)){
                                return null;
                            }
                        /************************************
                         *? Armado de variables
                         ************************************/
                            $set="";
                        /************************************
                         *? Arando columnas y parámetros.
                         ************************************/
                            foreach($data as $key => $value){
                                $set.=" ".$key." = :".$key.",";
                            }
                            $set = substr($set, 0, -1);
                        /********************************
                         *? Armando sentencia sql
                         ********************************/
                            $sql = "UPDATE $table SET $set WHERE $nameId = :$nameId";
                        /********************************
                         *? Contención con sql
                         ********************************/
                            $link=Connection::connect();
                            $stmt = $link->prepare($sql);
                        /********************************
                         *? Armado los parámetros.
                        ********************************/
                            foreach ($data as $key => $value){
                                $stmt -> bindParam(":".$key, $data[$key], PDO::PARAM_STR);
                            }
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
                        }
            }
?>