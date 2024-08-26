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
            $sql = "INSERT INTO usuario(`Cedula`, `Email`, `Password`, `Nombre`, `Apellido`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("issss", $ci, $mail, $pass, $name, $sname);
            $stmt->execute();
            
            $msj = "Inserción exitosa";
            return new Respuesta(true, $msj, $stmt);

        }catch (Exception $e){
            $msj = "Error: " . $e->getMessage();
            return new Respuesta(false, $msj, $stmt);
        }
    }

    function login($ci, $pass){
        try{
            $connection = conection();
            $sql = "SELECT * FROM usuario WHERE Cedula = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $ci);
            $stmt->execute();
            $respuesta = $stmt->get_result();
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
            $msj = "Error: " . $e->getMessage();
            return new Respuesta(false, $msj, []);
        }
           
    }

}

?>