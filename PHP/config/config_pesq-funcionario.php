<?php
require_once 'config_alquimia.php'; // Usa sua conexão existente
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['pesquisa'] = $_POST['pesquisa'];
    header('Location: ../in/adm_funcionario.php');
}

?>