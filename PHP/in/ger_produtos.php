<?php
// Verifica se o usuário logado é um ADMINISTRADOR e FUNCIONÁRIO
session_start();
if (!isset($_SESSION['id_usuarios']) || $_SESSION['funcao'] != 'admin' && $_SESSION['funcao'] != 'funci') {
    header('Location: sist_login.php');
    exit();
}

?>