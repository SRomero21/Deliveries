<?php
    /************************
     *! Requerimientos.
     ************************/
        require_once "models/put.model.php";
    /******************************
     *todo Class Controller PUT
     ******************************/
        class PutController{
            /********************************************
             ** Petición Put para editar datos.
             ********************************************/
                static public function putData($table, $data, $id, $nameId){
                    $response = PutModel::putData($table, $data, $id, $nameId);
                    $return = new PutController();
                    $return -> fncResponse($response,"putData");
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