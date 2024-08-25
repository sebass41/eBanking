<?php

require_once "../conexion.php";
require_once "res/Respuesta.php";

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

ini_set('log_errors', 1);
ini_set('error_log', '../log/php_errors.log');

class Usuario{
    function mostrar(){
        $connection = conection();
        $sql = "SELECT * FROM usuario";
        $respuesta = $connection->query($sql);
        $users = $respuesta->fetch_all(MYSQLI_ASSOC);
        
        if ($respuesta) {
            $msj = "Datos obtenidos correctamente";
            return new Respuesta(true, $msj, $users);
        }else {
            $msj = "No se pudieron obtener los datos";
            return new Respuesta(false, $msj, []);
        }
    }

    function insertar($ci, $mail, $pass, $name, $sname){
        try{
            $connection = conection();
            $sql = "INSERT INTO usuario(`Cedula`, `Email`, `Password`, `Nombre`, `Apellido`) VALUES ($ci, '$mail', '$pass', '$name', '$sname')";
            $respuesta = $connection->query($sql);
            
            $msj = "Inserción exitosa";
            return new Respuesta(true, $msj, $respuesta);

        }catch (Exception $e){
            $msj = "Error: $e";
            return new Respuesta(false, $msj, []);
        }
    }

    function login($ci, $pass){
        try{
            $connection = conection();
            $sql = "SELECT * FROM usuario WHERE Cedula = $ci";
            $respuesta = $connection->query($sql);
            $usr = $respuesta->fetch_all(MYSQLI_ASSOC);

            if (count($usr) > 0){
                $pas = $usr[0]['Password'];
                if (password_verify($pass, $pas)){
                    $msj = "Inicio de sesión exitosa";
                    return new Respuesta(true, $msj, $usr);
                }else{
                    $msj = "Contraseña incorrecta";
                    return new Respuesta(false, $msj, []);
                }

                
            }else{
                $msj = "Fallo en el inicio de sesión";
                return new Respuesta(false, $msj, []);
            }

        }catch (Exception $e){
            $msj = "Error: $e";
            return new Respuesta(false, $msj, []);
        }
           
    }

}

?>