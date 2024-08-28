<?php

require_once "../model/cuentaDAO.php";

$funcion = $_GET['fun'];

switch ($funcion){
    case 'm':
        mostrar();
        break;
    case 'c':
        crear();
        break;
    case 'd':
        depositar();
        break;
}

function mostrar(){
    session_start();
    $_SESSION['ci'] = 25883661;
    $ci = $_SESSION['ci'];
    $result = (new Cuenta())->mostrar($ci);

    echo json_encode($result);
}

function crear(){
    session_start();
    $saldo = $_POST['saldo'];
    $_SESSION['ci'] = 25883661;
    $ci = $_SESSION['ci'];
    
    $result = (new Cuenta())->insertar($ci, $saldo);
    echo json_encode($result);
}

function depositar(){
    session_start();
    $cuenta = $_POST['cuenta'];
    $cantidad = $_POST['cantidad'];
    $result = (new Cuenta())->depositar($cuenta, $cantidad);

    echo json_encode($result);
}

?>