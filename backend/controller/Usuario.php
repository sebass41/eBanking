<?php

require_once "../model/UsuarioDAO.php";

$funcion = $_GET['fun'];

switch($funcion){
    case 'i':
        insertar();
        break;
}

function insertar(){
    $ci = $_POST['ci'];
    $mail = $_POST['mail'];
    $pas = $_POST['pass'];
    $name = $_POST['name'];
    $sName = $_POST['sName'];
    
    $pass = password_hash($pas, PASSWORD_DEFAULT);

    $result = (new Usuario())->insertar($ci, $mail, $pass, $name, $sName);
    echo json_encode($result);
}

?>