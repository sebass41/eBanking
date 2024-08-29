<?php
session_start();

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
    if (isset($_SESSION['ci'])){
   
        $ci = $_SESSION['ci'];
        $result = (new Cuenta())->mostrar($ci);

        echo json_encode($result);

    }
}
function crear(){
    if (isset($_SESSION['ci'])){
        $saldo = $_POST['saldo'];
        $ci = $_SESSION['ci'];
        
        $result = (new Cuenta())->insertar($ci, $saldo);
        echo json_encode($result);
    }
}

function depositar(){
    if (isset($_SESSION['ci'])){
        $cuenta = $_POST['cuenta'];
        $cantidad = $_POST['cantidad'];
        $result = (new Cuenta())->depositar($cuenta, $cantidad);

        echo json_encode($result);
    }
}

?>