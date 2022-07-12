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
            //$data=array();
            $columns=array();
            $id=$_GET["id"]?? null;
            $nameId=$_GET["nameId"]?? null;
            $response = new DeleteController();
            $return = new DeleteController();
        /***************************************************************
         *? Validando variables de DELETE para actualizar el estado.
         ***************************************************************/
            // if(isset($_GET["id"]) && isset($_GET["nameId"])){
                /********************************************
                 *? Capturar los datos del formulario
                 ********************************************/
                //parse_str(file_get_contents('php://input'), $data);
                /********************************************
                 *? Validar la tabla y columnas
                    ********************************************/
                    // foreach(array_keys($data) as $key => $value){
                    //     array_push($columns,$value);
                    // }
                    // array_push($columns,$_GET["nameId"]);
                    // $columns=array_unique($columns);
                    // if (empty(Connection::getColumnsData($table, $columns))){
                    //     $return -> fncResponse(null,"deleteData");
                    // }else{
                    //     /***********************************************************************************
                    //      *? solicitud de repuestas del controlador para birlara datos en cualquier tabla
                    //     ***********************************************************************************/
                    //         //$response->deleteData($table, $data, $id, $nameId);
                    //         $response->deleteData($table, $id, $nameId);
                    // }
        /******************************************************
         *? Validando variables de DELETE para registro.
         ******************************************************/
            if(isset($_GET["id"]) && isset($_GET["nameId"])){
                /********************************************
                 *? Capturar los datos del formulario
                 ********************************************/
                //parse_str(file_get_contents('php://input'), $data);
                /********************************************
                 *? Validar la tabla y columnas
                    ********************************************/
                    $columns=array($_GET["nameId"]);
                    // foreach(array_keys($data) as $key => $value){
                    //     array_push($columns,$value);
                    // }
                    // array_push($columns,$_GET["nameId"]);
                    // $columns=array_unique($columns);
                    if (empty(Connection::getColumnsData($table, $columns))){
                        $return -> fncResponse(null,"deleteData");
                    }else{
                        /***********************************************************************************
                         *? solicitud de repuestas del controlador para birlara datos en cualquier tabla
                        ***********************************************************************************/
                            //$response->deleteData($table, $data, $id, $nameId);
                            $response->deleteData($table, $id, $nameId);
                    }
            }
?>