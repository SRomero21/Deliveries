<?php
    /************************
     *! Requerimientos.
     ************************/
        require_once "models/delete.model.php";
    /******************************
     *todo Class Controller delete
     ******************************/
        class DeleteController{
            /********************************************
             ** Petición DELETE.
             ********************************************/
                static public function deleteData($table, $data, $id, $nameId){
                    $response = DeleteModel::deleteData($table, $data, $id, $nameId);
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
                        "method" => $method,
                        "total" => count($response),
                        "detalle" => $response
                    );
                    }else{
                    $json = array(
                        "status" => 404,
                        "detalle" => "not found...",
                        "method" => $method
                    );
                    }
                    echo json_encode($json, http_response_code($json["status"]));
                }
        }
?>