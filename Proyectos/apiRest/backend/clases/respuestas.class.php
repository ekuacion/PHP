<?php

    class respuestas{

        // Parametros
        public $response = [
            'ok' => true,
            'result' => array()
        ];
        // Error numero 405
        public function error_405(){
            $this->response['status'] = "error";
            $this->response['result'] = array(
                "error_id" => "405",
                "error_msg" => "Metodo no permitido"
            );
            return $this->response;
        }
        // Error numero 200
        public function error_200($valor = "Datos incorrectos"){
            $this->response['status'] = "error";
            $this->response['result'] = array(
                "error_id" => "200",
                "error_msg" => $valor
            );
            return $this->response;
        }
        // Error numero 400
        public function error_400(){
            $this->response['status'] = "error";
            $this->response['result'] = array(
                "error_id" => "400",
                "error_msg" => "Datos enviados incompletos o con formato incorrecto"
            );
            return $this->response;
        }
        // Error numero 401
        public function error_401($valor = "No autorizado, Token invalido"){
            $this->response['status'] = "error";
            $this->response['result'] = array(
                "error_id" => "401",
                "error_msg" => $valor
            );
            return $this->response;
        }
        // Error numero 500
        public function error_500($valor = "Error interno del servidor"){
            $this->response['status'] = "error";
            $this->response['result'] = array(
                "error_id" => "500",
                "error_msg" => $valor
            );
            return $this->response;
        }

    }

?>