<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}


session_start();

//Retorna o se usuário da função administrador é um ADMINISTRADOR
function eh_adminstrador(){
    if (!isset($_SESSION['id_usuario']) || $_SESSION['funcao'] != 'administrador') {
        return false;
    }
    return true;
}
//Retorna o se usuário da função funcionário é um FUNCIONÁRIO
function eh_funcionario(){
    if (!isset($_SESSION['id_usuario']) || $_SESSION['funcao'] != 'funcionário') {
        return false;
    }
    return true;
}

// phpinfo();
