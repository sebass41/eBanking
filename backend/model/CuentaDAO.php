<?php

require_once "../conexion.php";
require_once "res/Respuesta.php";

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

ini_set('log_errors', 1);
ini_set('error_log', '../log/php_errors.log');

class Cuenta{
    function mostrar($ci){
       try{
            $connection = conection();
            $sql = "SELECT * FROM cuenta WHERE Cedula = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $ci);
            $stmt->execute();

            $respuesta = $stmt->get_result();
            $cuentas = $respuesta->fetch_all(MYSQLI_ASSOC);

            $msj = "Datos obtenidos correctamente";
            return new Respuesta (true, $msj, $cuentas);
        } catch (Exception $e){
            $msj = "Error: " . $e->getMessage();
            return new Respuesta(false, $msj, []);
       }

    }

    function depositar($numCuenta, $saldo){
        try{
            $connection = conection();
            $sql = "UPDATE `cuenta` SET `Saldo`= saldo + ? WHERE Num_cuenta = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ii", $saldo, $numCuenta);
            $stmt->execute();

            $msj = "Actualización exitosa";
            return new Respuesta(true, $msj, $stmt);
        }catch(Exception $e){
            $msj = "Error: " . $e->getMessage();
            return new Respuesta(false, $msj, []);
        }
    }

    function insertar($ci, $saldo){
        try{
            $connection = conection();
            $sql = "INSERT INTO `cuenta`(`Saldo`, `Cedula`) VALUES (?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ii", $saldo, $ci);
            $stmt->execute();

            $msj = "La cuenta se creó correctamente";
            return new Respuesta(true, $msj, $stmt);
        }catch (Exception $e){
            $msj = "Error: " . $e->getMessage();
            return new Respuesta(false, $msj, []);
        }
    }

    
}

?>