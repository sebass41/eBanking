<?php

require_once "../model/TransaccionDAO.php";

$funcion = $_GET['fun'];

switch ($funcion){
    case 'i':
        insertar();
        break;
}

function insertar(){
    $monto = $_POST['monto'];
    $concepto = $_POST['concepto'];
    $cuendaD = $_POST['cuentaD'];

    
}

?>