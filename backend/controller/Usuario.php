<?php
session_start();

require_once "../model/UsuarioDAO.php";

$funcion = $_GET['fun'];

switch($funcion){
    case 'i':
        insertar();
        break;
    case 'l':
        login();
        break;
    case 'lo':
        logout();
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
    $ci = $_POST['ci'];
    $pass = $_POST['pass'];
    $result = (new Usuario())->login($ci, $pass);

    if ($result->sucess){
        $_SESSION['ci'] = $ci;
        
    }
    echo json_encode($result);
}

function logout(){
    session_unset();
    session_destroy();
    
    echo json_encode("Sesión Cerrada");
}

?>