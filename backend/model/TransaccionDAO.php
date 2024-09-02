<?php

require_once "../conexion.php";
require_once "res/Respuesta.php";

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

ini_set('log_errors', 1);
ini_set('error_log', '../log/php_errors.log');

class Transaccion{
    function mostrar($ci){
       try{
            $connection = conection();
            $stmt = "SELECT * FROM transaccion WHERE Cedula = ?";
            $stmt = $connection->prepare($stmt);
            $stmt->bind_param("i", $ci);
            $stmt->execute();

            $respuesta = $stmt->get_result();
            $transacciones = $respuesta->fetch_all(MYSQLI_ASSOC);

            $msj = "Datos obtenidos correctamente";
            return new Respuesta (true, $msj, $transacciones);
       }catch(Exception $e){
            $msj = "Error: " . $e->getMessage();
            return new Respuesta(false, $msj, []);
       }
    }


function hacerTransaccion($monto, $concepto, $fecha, $cedula, $cuentaO, $cuentaD) {
    try {
        $connection = conectionPDO();
        $connection->beginTransaction(); // Iniciar la transacción

        // Verificar saldo de la cuenta origen
        $stmt = $connection->prepare('SELECT saldo FROM cuenta WHERE Num_cuenta = ?');
        $stmt->execute([$cuentaO]);
        $saldo = $stmt->fetchColumn();

        if ($saldo < $monto) {
            throw new Exception('Saldo insuficiente en la cuenta origen.');
        }

        // Restar el monto de la cuenta origen
        $stmt = $connection->prepare('UPDATE cuenta SET saldo = saldo - ? WHERE Num_cuenta = ?');
        $stmt->execute([$monto, $cuentaO]);

        // Sumar el monto a la cuenta destino
        $stmt = $connection->prepare('UPDATE cuenta SET saldo = saldo + ? WHERE Num_cuenta = ?');
        $stmt->execute([$monto, $cuentaD]);

        // Registrar la transacción
        $stmt = $connection->prepare('INSERT INTO transaccion (Monto, Concepto, Fecha, Cedula, Cuenta_origen, Cuenta_destino) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$monto, $concepto, $fecha, $cedula, $cuentaO, $cuentaD]);

        $connection->commit(); // Confirmar la transacción

        $msj = "Inserción exitosa";
        return new Respuesta(true, $msj, $stmt);
    } catch (Exception $e) {
        $connection->rollBack(); // Revertir la transacción en caso de error
        $msj = "Error: " . $e->getMessage();
        return new Respuesta(false, $msj, []);
    }
}

function recibo($IdTrans){
    try{
        $connection = conection();
        $stmt = "SELECT * FROM transaccion WHERE Id_transaccion = ?";
        $stmt = $connection->prepare($stmt);
        $stmt->bind_param("i", $IdTrans);
        $stmt->execute();

        $respuesta = $stmt->get_result();
        $recibo = $respuesta->fetch_all(MYSQLI_ASSOC);

        $msj = "Datos obtenidos correctamente";
        return new Respuesta (true, $msj, $recibo);

    }catch (Exception $e){
        $msj = "Error: " . $e;
        return new Respuesta (false, $msj, []);
    }
}
}

?>