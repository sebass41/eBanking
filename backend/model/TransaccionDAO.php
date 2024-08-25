<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

ini_set('log_errors', 1);
ini_set('error_log', '../log/php_errors.log');

class Transaccion{
    function mostrar(){
        $connection = conection();
        $sql = "SELECT * FROM Transaccion";
        $respuesta = $connection->query($sql);
        $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
        
        if ($respuesta) {
            $msj = "Datos obtenidos correctamente";
            return new Respuesta(true, $msj, $pedidos);
        }else {
            $msj = "No se pudieron obtener los datos";
            return new Respuesta(false, $msj, []);
        }
    }

    function insertar($id, $monto, $concepto, $fecha, $cedula, $cuentaO, $cuentaD){
        $connection = conection();
        $sql = "INSERT INTO Usuario VALUES ($id, $monto, '$concepto', '$fecha',$cedula, $cuentaO, $cuentaD";
        $respuesta = $connection->query($sql);

        if($respuesta){
            $msj = "Inserción exitosa";
            return new Respuesta(true, $msj, $respuesta);
        }else{
            $msj = "Fallo en la inserción";
            return new Respuesta(false, $msj, []);
        }
    }

    
}

?>