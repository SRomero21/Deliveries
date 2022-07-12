<?php
    /****************************************
     *todo Post Model.
     ****************************************/
        /****************************************
         *! Requerimientos.
        ****************************************/
            require_once "connection.php";
        /****************************************
         *? ClasS POST model.
         ****************************************/
            class PostModel{
                /********************************
                 ** Petición Post con data.
                 ********************************/
                    static public function postData($table, $data){
                        /************************************
                         *? Armado de variables
                         ************************************/
                            $columns="";
                            $params="";
                        /************************************
                         *? Arando columnas y parámetros.
                         ************************************/
                            foreach($data as $key => $value){
                                $columns.=" ".$key.",";
                                $params.= " :".$key.",";
                            }
                            $columns = substr($columns, 0, -1);
                            $params = substr($params, 0, -1);
                        /********************************
                         *? Armando sentencia sql
                         ********************************/
                            $sql = "INSERT INTO $table ($columns) VALUES ($params)";
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
                        /********************************
                         *? Ejecutar sentencia sql.
                        ********************************/
                            if($stmt->execute()){
                                $json = array(
                                                "lastId" => $link->lastInsertId(),
                                                "comment"=>"The process was successful"
                                            );
                                return $json;
                            }else{
                                return $link->errorInfo();
                            }
                        }
            }
?>