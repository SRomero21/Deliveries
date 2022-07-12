<?php
    /****************************************
     *todo Petición DELETE.
    ****************************************/
        /********************************************
         *! Requerimientos.
        ********************************************/
            require_once "models/connection.php";
            require_once "controllers/delete.controller.php";
        /********************************************
         *? Variables
        ********************************************/
            $data=array();
            $columns=array();
            $id=$_GET["id"]?? null;
            $nameId=$_GET["nameId"]?? null;
            $active_product=$_GET["active_product"]?? null;
            $response = new DeleteController();
            $return = new DeleteController();
        /***************************************************************
         *? Validando variables de DELETE
         ***************************************************************/
            if(isset($_GET["id"]) && isset($_GET["nameId"])){
                /********************************************
                 *? Capturar los datos del formulario
                 ********************************************/
                    parse_str(file_get_contents('php://input'), $data);
                /********************************************
                 *? Validando la data
                 ********************************************/
                    if(!empty($data)){
                        /********************************************
                         *? Armando columnas
                        ********************************************/
                        foreach(array_keys($data) as $key => $value){
                            array_push($columns,$value);
                        }
                        array_push($columns,$_GET["nameId"]);
                        $columns=array_unique($columns);
                    }else{
                        $columns = array($_GET["nameId"]);
                        $data=null;
                    }
                /********************************************
                 *? Validar la tabla y columnas
                ********************************************/
                    if (empty(Connection::getColumnsData($table, $columns))){
                        $return -> fncResponse(null,"deleteData");
                    }else{
                        /***********************************************************************************
                         *? solicitud de repuestas del controlador para borrar datos en cualquier tabla
                        ***********************************************************************************/
                            $response->deleteData($table, $data, $id, $nameId);
                    }
            }
?>