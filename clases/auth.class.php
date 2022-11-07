<?php 

require_once 'coneccion/conexion.php';
require_once 'respuestas.class.php';

class auth extends conexion{

    public function login($json){
        
        $_respuesta = new respuestas;
        $datos = json_decode($json,true);
 
        if (!isset($datos['usuario']) || !isset($datos['password'])) {
            # error 400
            return $_respuesta->error_400();
        }else{

            $usuario = $datos['usuario'];
            $password = $datos['password'];
            $password =  parent::encriptar($password);
            $datos = $this->obtenerDatosUsuario($usuario);
            if ($datos) {
                // verificar si la contrasenia existe
                if ($password == $datos[0]['Password']) {
                    
                    if ($datos[0]['Estado'] == "Activo") {
                        // crear token
                        $verificar = $this->insertarToken($datos[0]['UsuarioId']);
                        if ($verificar) {
                            // si se guardo
                            $result = $_respuesta->response;
                            $result['result'] = array(
                                "token" => $verificar
                            );
                            return $result;

                        }else {
                            // sino se guardo
                            return $_respuesta->error_500("Error iinterno del servidor, no se a guardado");
                        }
                    }else{
                        return $_respuesta->error_200("El usuario no esta activo");
                    }

                }else{
                    // la contrasenia no es igual
                    return $_respuesta->error_200("El password no es correcto");
                }

            }else{
                // si no existe
                return $_respuesta->error_200("El usuario $usuario no existe");
            }
        }

    }

    private function obtenerDatosUsuario($correo){
        $query = "SELECT UsuarioId,Password,Estado FROM usuarios WHERE Usuario = '$correo'";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]['UsuarioId'])) {
            return $datos;
        }else{
            return 0;
        }
    }

    private function insertarToken($usuarioid){
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
        $date = date("Y-m-d H:i");
        $estado = "Activo";
        $query = "INSERT INTO usuarios_token (UsuarioId, Token, Estado, Fecha)VALUES('$usuarioid', '$token', '$estado', '$date')";
        $verifica = parent::nonQuery($query);
        if ($verifica) {
            return $token;
        }else{
            return 0;
        }
    }

}