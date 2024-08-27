<?php

require_once "../conexion.php";
require_once "res/Respuesta.php";

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

ini_set('log_errors', 1);
ini_set('error_log', '../log/php_errors.log');

class Transaccion{
    function mostrar(){
       
    }

    function insertar($monto, $concepto, $fecha, $cedula, $cuentaO, $cuentaD){
        try{
            $connection = conection();
            $sql = "INSERT INTO `transaccion`(`Monto`, `Concepto`, `Fecha`, `Cedula`, `Cuenta_origen`, `Cuenta_destino`) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("issiii", $monto, $concepto, $fecha, $cedula, $cuentaO, $cuentaD);
            $stmt->execute();

            

            $msj = "Inserción exitosa";
            return new Respuesta(true, $msj, $stmt);
        }catch(Exception $e){
            $msj = "Error: " . $e->getMessage();
            return new Respuesta(false, $msj, []);
        }
        
    }

    
}

?>