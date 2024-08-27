<?php

require_once "../model/TransaccionDAO.php";
require_once "Cuenta.php";

$funcion = $_GET['fun'];

switch ($funcion){
    case 'i':
        realizarTransaccion();
        break;
}

function realizarTransaccion(){
    $monto = $_POST['monto'];
    $concepto = $_POST['concepto'];
    $cuentaO = $_POST['cuentaO'];
    $cuendaD = $_POST['cuentaD'];
    $ci = $_SESSION['ci'];
    
    date_default_timezone_set('America/Montevideo');
    $date = date('Y-m-d H:i:s');
}



?>