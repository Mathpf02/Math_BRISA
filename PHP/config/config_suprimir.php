<?php
include_once "config_alquimia.php";
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Altera a função para 'inativo', o que impede o login no seu script 'veri_alquimia.php'
    $sql = "UPDATE AUTORIZADOS SET funcao = 'inativo' WHERE id_usuario = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}
header("Location: ../in/adm_funcionarios.php");
exit();