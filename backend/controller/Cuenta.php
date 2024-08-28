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
}

function mostrar(){
    session_start();
    $_SESSION['ci'] = 56281371;
    $ci = $_SESSION['ci'];
    $result = (new Cuenta())->mostrar($ci);

    echo json_encode($result);
}

function insertar(){
    session_start();
    $saldo = $_POST['saldo'];
    $_SESSION['ci'] = 25883661;
    $ci = $_SESSION['ci'];
    
    $result = (new Cuenta())->insertar($ci, $saldo);
    echo json_encode($result);
}

?>