<?php

    class conexion {

        // Parametros de la clase
        private $server = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "apirest";
        private $port = "";
        private $conexion;
        private $listadatos;
        
        // constructor de la Clase
        function __construct(){
            try {
                /*$listadatos = $this->datosConexion();                     // Leo la configuracion al inicio y asigno a cada variable
                foreach ($listadatos as $value){
                    $this->server = $value['server'];
                    $this->user = $value['user'];
                    $this->password = $value['password'];
                    $this->database = $value['database'];
                    $this->port = $value['port'];
                } */
                $this->conexion = new PDO("mysql:host=$this->server;dbname=$this->database;", $this->user, $this->password);
                
            } catch (PDOException $e) {
                die('Connection Failed: ' . $e->getMessage());
            }
        }
        // Conexion con base da datos
        private function datosConexion(){
            $direccion = dirname(__FILE__);                                 // Asignando la direccion de este archivo a la variable 
            $jsondata = file_get_contents($direccion."/"."config" );        // Leyendo la configuracion desde el archivo config 
            return json_decode($jsondata, true);                            // Convirtiendo la data en un array
        }
        // Conversión a UTF8
        private function convertirUTF8($array){
            array_walk_recursive($array,function(&$item,$key){              // Si no encuentra un signo raro
                if(!mb_detect_encoding($item,'utf-8',true)){                // Detectando en el string signo o caracter raro
                    $item = utf8_encode($item);                             // Codifica a utf8
                }
            });
            return $array;                                                  // retorna el valor 
        }
        // Obtener Data
        public function obtenerDatos($sqlstr){
            $results = $this->conexion->query($sqlstr);
            $resultsArray = array();
            foreach ($results as $key) {
                $resultsArray[]= $key;
            }
            return $this->convertirUTF8($resultsArray);

        }
        // Insert y devuelve el numero de filas afectadas
        public function nonQuery($sqlstr){
            $results = $this->conexion->query($sqlstr);
            return $results->rowCount();
        }
        // Insert y devuelve el id afectado
        public function nonQueryId($sqlstr){
            $results = $this->conexion->query($sqlstr);
            $filas = $results->rowCount();
            if($filas >=1){
                return $this->conexion->lastInsertId();
            }
            else {
                return 0;
            }
        }
        // Encriptar Data
        protected function  encriptar($string){
            return md5($string);
        }
    }

?>