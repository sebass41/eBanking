<?php

require_once "../model/UsuarioDAO.php";

$funcion = $_GET['fun'];

switch($funcion){
    case 'insertar':
        insertar();
        break;
}

function insertar(){
    $ci = $_POST['ci'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $sName = $_POST['sName'];

    $result = (new Usuario())->insertar($ci, $mail, $pass, $name, $sName);
    return json_encode($result);
}

?>