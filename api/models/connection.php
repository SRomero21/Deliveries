<?php
  class Connection{
    /********************************
     ** Información de la DB.
     ********************************/
      static public function infoDatabase(){
        $infoDB = array(
          "database" => "deliveries",
          "user" => "root",
          "pass" => ""
        );
        return $infoDB;
      }
    /********************************
     ** Conexión a la DB.
     ********************************/
      static public function connect(){
        try {
          $link = new PDO("mysql:host=localhost;dbname=".Connection::infoDatabase()["database"], Connection::infoDatabase()["user"], Connection::infoDatabase()["pass"]);
          $link->exec("set names utf8");
        }catch (PDOException $e){
          die("Error: ".$e->getMessage());
        }
        return $link;
      }
    /*************************************************
     ** validar existencia de una tabla en la DB
     *************************************************/
      static public function getColumnsData($table, $columns){
        /*****************************************
        ** Traer nombre de la base de la DB
        ******************************************/
          $database= Connection::infoDatabase()["database"];
        /*****************************************
        ** traer el nombre la columnas de la DB
        ******************************************/
          $validate = Connection::Connect()
            ->query("SELECT COLUMN_NAME AS item
                    FROM information_schema.columns WHERE table_schema ='$database'
                    AND table_name = '$table'")
            ->fetchAll(PDO::FETCH_OBJ);
        /**********************************************
        ** Validación de la existencia de la tabla.
        ***********************************************/
          if(empty($validate)){
            return null;
          }else{
            /*******************************
             ** Validación select = *
             *******************************/
              if($columns[0] == "*"){
                array_shift($columns);
              }
            /***************************************************
             ** Validación de la existencia de las columnas.
             ***************************************************/
              $sum=0;
              foreach ($validate as $key => $value) {
                $sum+=in_array($value->item, $columns);
              }
            return $sum == count($columns) ? $validate : null;
          }
      }
  }
?>