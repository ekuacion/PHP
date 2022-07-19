<?php

    require_once "conexion/conexion.php";
    require_once "respuestas.class.php";

    class pacientes extends conexion {

        // Parametros tabla
        private $table = "pacientes";
        private $table2 = "usuarios_token";
        // Parametros paciente
        private $pacienteid = "";
        private $dni = "";
        private $nombre = "";
        private $direccion = "";
        private $codigoPostal = "";
        private $genero = "";
        private $telefono = "";
        private $fechaNacimiento = "0000-00-00";
        private $correo = "";
        private $token = "";
        private $imagen = "";
      
        // Lista de pacientes
        public function listaPacientes($pagina = 0){
            $inicio = 0;
            $cantidad = 50;
            if($pagina > 1){
                $inicio = ($cantidad*($pagina-1)) + 1;
                $cantidad = $cantidad*$pagina;
            }
            $query = "SELECT PacienteId,Nombre,DNI,Telefono,Correo FROM " . $this->table . " limit $inicio,$cantidad";
            $datos = parent::obtenerDatos($query);
            return ($datos);
        }
        // Obtener paciente por id
        public function obtenerPaciente($id){
            $query = "SELECT * FROM " . $this->table . " WHERE PacienteId = '$id'";
            return parent::obtenerDatos($query);
        }
        // Metodo Post
        public function post($json){
            $_respuestas = new respuestas;
            $datos = json_decode($json,true);
            if(!isset($datos['token'])){
                return $_respuestas->error_401();
            } else {
                $this->token = $datos['token'];
                $arrayToken = $this->buscarToken();
                if($arrayToken){
                    if(!isset($datos['nombre']) || !isset($datos['dni']) || !isset($datos['correo'])){
                        return $_respuestas->error_400();
                    } else {
                        $this->nombre = $datos['nombre'];
                        $this->dni = $datos['dni'];
                        $this->correo = $datos['correo'];
                        if(isset($datos['direccion'])){ $this->direccion = $datos['direccion']; }
                        if(isset($datos['codigoPostal'])){ $this->codigoPostal = $datos['codigoPostal']; }
                        if(isset($datos['genero'])){ $this->genero = $datos['genero']; }
                        if(isset($datos['telefono'])){ $this->telefono = $datos['telefono']; }
                        if(isset($datos['fechaNacimiento'])){ $this->fechaNacimiento = $datos['fechaNacimiento']; }
                        if(isset($datos['imagen'])){ 
                            $resp = $this->procesarimagen($datos['imagen']);
                            $this->imagen = $resp;
                        }
                        $resp = $this->insertPaciente();
                        if ($resp){
                            $respuesta = $_respuestas->response;
                            $respuesta["result"] = array(
                                "pacienteId" => $resp
                            );
                            return $respuesta;
                        } else {
                            return $_respuestas->error_500();
                        }
                    }
                } else {
                    return $_respuestas->error_401("El token que envio es invalido o esta caducado");
                }
            }            
        }
        // Imagenes
        private function procesarImagen($img){
            $direccion = dirname(__DIR__) . "\public\imagenes\\";
            $partes = explode(";base64,",$img);
            $extencion = explode('/',mime_content_type($img))[1];   // Obtener la extension de la imagen
            $imagen_base64 = base64_decode($partes[1]);
            $file = $direccion . uniqid() . "." . $extencion;
            file_put_contents($file,$imagen_base64);
            $nuevadireccion = str_replace('\\','/',$file);

            return $nuevadireccion;

        }
        // Incertando Paciente
        private function insertPaciente(){
            $query = "INSERT INTO " . $this->table . "(DNI,Nombre,Direccion,CodigoPostal,Telefono,Genero,FechaNacimiento,Correo,Imagen)
            values
            ('" . $this->dni . "','" . $this->nombre . "','" . $this->direccion . "','" . $this->codigoPostal . "','" . $this->telefono . "','" . $this->genero . "','" . $this->fechaNacimiento . "','" . $this->correo . "','" . $this->imagen . "')";
            //print_r($query);
            $resp = parent::nonQueryId($query);
            if($resp){
                return $resp;
            } else {
                return 0;
            }
        }
        // Editando un paciente
        public function put($json){
            $_respuestas = new respuestas;
            $datos = json_decode($json,true);

            if(!isset($datos['token'])){
                return $_respuestas->error_401();
            } else {
                $this->token = $datos['token'];
                $arrayToken = $this->buscarToken();
                if($arrayToken){
                    if(!isset($datos['pacienteId'])){
                        return $_respuestas->error_400();
                    } else {
                        $this->pacienteid = $datos['pacienteId'];
                        if(isset($datos['nombre'])){ $this->nombre = $datos['nombre']; }
                        if(isset($datos['dni'])){ $this->dni = $datos['dni']; }
                        if(isset($datos['correo'])){ $this->correo = $datos['correo']; }
                        if(isset($datos['direccion'])){ $this->direccion = $datos['direccion']; }
                        if(isset($datos['codigoPostal'])){ $this->codigoPostal = $datos['codigoPostal']; }
                        if(isset($datos['genero'])){ $this->genero = $datos['genero']; }
                        if(isset($datos['telefono'])){ $this->telefono = $datos['telefono']; }
                        if(isset($datos['fechaNacimiento'])){ $this->fechaNacimiento = $datos['fechaNacimiento']; }
                        $resp = $this->modificarPaciente();
                        // print_r($resp);
                        if ($resp ){
                            $respuesta = $_respuestas->response;
                            $respuesta["result"] = array(
                                "pacienteId" => $this->pacienteid
                            );
                            return $respuesta;
                        } else {
                            return $_respuestas->error_200("No se cambiado ningun dato");
                        }
                    }
                } else {
                    return $_respuestas->error_401("El token que envio es invalido o esta caducado");
                }
            }            
        }
        // Incertando Paciente
        private function modificarPaciente(){
            $query = "UPDATE " . $this->table . " SET Nombre = '" . $this->nombre 
                                              . "',Direccion = '" . $this->direccion 
                                              . "',DNI = '" . $this->dni 
                                              . "',CodigoPostal = '" . $this->codigoPostal 
                                              . "',Telefono = '" . $this->telefono 
                                              . "',Genero = '" . $this->genero 
                                              . "',FechaNacimiento = '" . $this->fechaNacimiento 
                                              . "',Correo = '" . $this->correo 
                                              . "'WHERE PacienteId = '" . $this->pacienteid . "'";
            //print_r($query);
            $resp = parent::nonQuery($query);
            // print_r($resp);
            if($resp >= 1){
                return $resp;
            } else {
                return 0;
            }
        }
        // Borrando
        public function delete($json){
            $_respuestas = new respuestas;
            $datos = json_decode($json,true);

            if(!isset($datos['token'])){
                return $_respuestas->error_401();
            } else {
                $this->token = $datos['token'];
                $arrayToken = $this->buscarToken();
                if($arrayToken){
                    if(!isset($datos['pacienteId'])){
                        return $_respuestas->error_400();
                    } else {
                        $this->pacienteid = $datos['pacienteId'];
                        $resp = $this->eliminarPaciente();
                        //print_r($resp);
                        if ($resp ){
                            $respuesta = $_respuestas->response;
                            $respuesta["result"] = array(
                                "pacienteId" => $this->pacienteid
                            );
                            return $respuesta;
                        } else {
                            return $_respuestas->error_200("No se cambiado ningun dato");
                        }
                    }
                } else {
                    return $_respuestas->error_401("El token que envio es invalido o esta caducado");
                }
            }            
        }
        // Eliminar paciente 
        private function eliminarPaciente(){
            $query = "DELETE FROM " . $this->table . " WHERE PacienteId = '" . $this->pacienteid ."'";
            // print_r($query);
            $resp = parent::nonQuery($query);
            if($resp >= 1){
                return $resp;
            } else {
                return false;
            }
        } 
        // Buscar Token
        private function buscarToken(){
            $query = "SELECT TokenId,UsuarioId,Estado from " . $this->table2 . " WHERE Token = '" . $this->token . "' AND Estado = 'Activo'";
            $resp = parent::obtenerDatos($query);
            if($resp){
                return $resp;
            } else {
                return 0;
            }
        }
        // Actualizar Token
        private function actualizarToken($tokenid){
            $date = date("Y-m-d H:i");
            $query = "UPDATE usuarios_token SET Fecha = '$date' WHERE TokenId = '$tokenid' ";
            $resp = parent::nonQuery($query);
            if($resp >= 1){
                return $resp;
            } else {
                return 0;
            }
        }

    }
    
?>