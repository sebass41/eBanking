<?php
session_start();

require_once "../model/TransaccionDAO.php";

$funcion = $_GET['fun'];

switch ($funcion){
    case 'rt':
        realizarTransaccion();
        break;
    case 'mt':
        mostrar();
        break;
    case 'r':
        recibo();
        break;
}

function realizarTransaccion(){
    if (isset($_SESSION['ci'])){
        $monto = $_POST['monto'];
        $concepto = $_POST['concepto'];
        $cuentaO = $_POST['cuentaO'];
        $cuendaD = $_POST['cuentaD'];
        $ci = $_SESSION['ci'];
        
        date_default_timezone_set('America/Montevideo');
        $date = date('Y-m-d H:i:s');

        $result = (new Transaccion())->hacerTransaccion($monto, $concepto, $date, $ci, $cuentaO, $cuendaD);
        echo json_encode($result);
    }
}

function mostrar(){
    if (isset($_SESSION['ci'])){
        $ci = $_SESSION['ci'];

        $result = (new Transaccion())->mostrar($ci);
        echo json_encode($result);
    }
}

function recibo(){
    if (isset($_SESSION['ci'])){
        $idTrans = $_POST['id'];
        
        $result = (new Transaccion())->recibo($idTrans);
        echo json_encode($result);
    }
}

?>