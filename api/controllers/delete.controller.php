<?php
    /************************
     *! Requerimientos.
     ************************/
        require_once "models/delete.model.php";
    /**************************************
     *todo Class Controller DELETE
     **************************************/
        class DeleteController{
            /*********************************************
             ** Petición Delete para borrar datos.
             *********************************************/
                static public function deleteData($table,$data){
                    $response = DeleteModel::deleteData($table,$data);
                    $return = new DeleteController();
                    $return -> fncResponse($response,"deleteData");
                }
            /*******************************
             ** Respuesta del controlador
            *******************************/
                public function fncResponse($response,$method){
                    if(!empty($response)){
                    $json = array(
                        "status" => 200,
                        "method" => "delete-".$method,
                        "total" => count($response),
                        "detalle" => $response
                    );
                    }else{
                    $json = array(
                        "status" => 404,
                        "detalle" => "not found...",
                        "method" => "GET-".$method
                    );
                    }
                    echo json_encode($json, http_response_code($json["status"]));
                }
        }
?>