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

        }

    }

}