<?php

require_once "../model/cuentaDAO.php";

$funcion = $_GET['fun'];

switch ($funcion){
    case 'm':
        mostrar();
        break;
    case 'i':
        insertar();
        break;
    case 'a':
        actualizar();
        break;
}

function mostrar(){
    session_start();

    $ci = $_SESSION['ci'];
    $result = (new Cuenta())->mostrar($ci);

    echo json_encode($result);
}

function insertar(){
    $saldo = $_POST['saldo'];
    $ci = $_SESSION['ci'];
    
    $result = (new Cuenta())->insertar($ci, $saldo);
    echo json_encode($result);
}

function actualizar(){
    $cuenta = 2;
}

?>