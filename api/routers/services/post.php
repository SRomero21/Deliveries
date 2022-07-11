<?php
    /****************************************
     *todo Petición POST.
    ****************************************/
        /********************************************
         *! Requerimientos.
        ********************************************/
            require_once "models/connection.php";
            require_once "controllers/post.controller.php";
        /********************************************
         *? Variables
        ********************************************/
            $columns=array();
            $response = new PostController();
        /********************************************
         *? Validar la tabla y columnas
         ********************************************/
            if(isset($_POST)){
                foreach(array_keys($_POST) as $key => $value){
                    array_push($columns, $value);
                }
            }
            if (empty(Connection::getColumnsData($table, $columns))){
                $json = array(
                    "status" => 400,
                    "detalle" => "Error: Fields in the form not match the database",
                    "method" => "POST",
                );
                echo json_encode($json, http_response_code($json["status"]));
                return;
            }else{
                /***********************************************************************************
                 *? solicitud de repuestas del controlador para crear datos en cualquier tabla
                 ***********************************************************************************/
                    $response->postData($table, $_POST);
            }

?>