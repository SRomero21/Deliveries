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
                    static public function postData($table,$data){
                        echo '<pre> t =';print_r($table);echo '</pre>';
                        echo '<pre> d =';print_r($data);echo '</pre>';
                    }
            }
?>