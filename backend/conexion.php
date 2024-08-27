<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

ini_set('log_errors', 1);
ini_set('error_log', 'log/php_errors.log');

//Función para la conexión a la BD 
function conection (){
    try{
        $host = "localhost"; 
        $usr = "root"; 
        $pass = ""; 
        $bd = "eBanking";
        $puerto = 3306;
        $mysqli = new mysqli ($host, $usr, $pass, $bd, $puerto); 
        return $mysqli; 
    }catch (Exception $e){
        echo "Se ha producido un error en la Conexión:".$e->getMessage();
    }
}

function conectionPDO(){
    $dsn = 'mysql:host=localhost;dbname=eBanking';
    $username = 'root';
    $password = '';
    $options = [];
    try {
        $pdo = new PDO($dsn, $username, $password, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('Error al conectar: ' . $e->getMessage());
    }
}


?>