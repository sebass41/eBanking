<?php

require_once "../model/UsuarioDAO.php";

$funcion = $_GET['fun'];

switch($funcion){
    case 'i':
        insertar();
        break;
    case 'l':
        login();
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

function login(){
    session_start();

    $ci = $_POST['ci'];
    $pass = $_POST['pass'];
    $_SESSION['ci'] = $ci;
    $result = (new Usuario())->login($ci, $pass);

    echo json_encode($result);
}
?>