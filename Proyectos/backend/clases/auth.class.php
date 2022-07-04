<?php
    
    require_once 'conexion/conexion.php';
    require_once 'respuestas.class.php';
    date_default_timezone_set('America/Santiago');

    class auth extends conexion {
        
        // Funcion de Ingreso
        public function login($json){
            $_respuestas = new respuestas;
            $datos = json_decode($json,true);
            if(!isset($datos['usuario']) || !isset($datos['password'])){
                // Error con los campos
                return $_respuestas->error_400();
            } else {
                // Todo esta bien
                $usuario = $datos['usuario'];
                $password = $datos['password'];
                $password = parent::encriptar($password);
                $datos = $this->obtenerDatosUsuario($usuario);
                if($datos){
                    // Si existe el usuario verificamos la contraseña
                    if($password == $datos[0]['Password']){
                        if($datos[0]['Estado'] == 'Activo'){
                            // Crear token
                            $verificar = $this->insertarToken($datos[0]['UsuarioId']);
                            if($verificar){
                                // Si se guardo
                                $result = $_respuestas->response;
                                $result["result"] = array(
                                    "token" => $verificar
                                );
                                return $result;
                            } else {
                                // Error
                                return $_respuestas->error_500("Error interno, no hemos podido guardar");
                            }
                        } else {
                            // Usuario Inactivo
                            return $_respuestas->error_200("El usuario esta inactivo");
                        }

                    } else {
                        // La contraseña no es correcta
                        return $_respuestas->error_200("El password es invalido");
                    }
                } else {
                    // Si no existe
                    return $_respuestas->error_200("El usuario $usuario no existe");
                }
            }
        }
        // Funcion de datos usuario
        private function obtenerDatosUsuario($correo){
            $query = "SELECT UsuarioId,Password,Estado FROM usuarios WHERE Usuario = '$correo'";
            $datos = parent::obtenerDatos($query);
            if(isset($datos[0]['UsuarioId'])){
                return $datos;
            } else {
                return 0;
            }
        }
        // Funcion de Token
        private function insertarToken($usuarioid){
            $val = true;
            // bin2hex - Devuelve una cadena ASCII que contiene la representación hexadecimal de str.
            // openssl_random_pseudo_bytes - Genera una cadena de bytes pseudo-aleatoria
            $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
            $date = date("Y-m-d H:i");
            $estado = "Activo";
            $query = "INSERT INTO usuarios_token (UsuarioID,Token,Estado,Fecha)VALUES('$usuarioid','$token','$estado','$date')";
            $verificar = parent::nonQuery($query);
            if($verificar){
                return $token;
            } else {
                return 0;
            }
        }       
    }

?>