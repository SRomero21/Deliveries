<?php
    /************************
     *! Requerimientos.
     ************************/
        require_once "models/post.model.php";
    /******************************
     *todo Class Controller POST
     ******************************/
        class PostController{
            /********************************
             ** Petición Post con data.
             ********************************/
                static public function postData($table,$data){
                    $response = PostModel::postData($table,$data);
                    $return = new PostController();
                    $return -> fncResponse($response,"postData");
                }
            /*******************************
             ** Respuesta del controlador
            *******************************/
                public function fncResponse($response,$method){
                    if(!empty($response)){
                    $json = array(
                        "status" => 201,
                        "method" => "GET-".$method,
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