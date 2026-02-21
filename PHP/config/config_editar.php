<?php
// Exemplo lógico do processamento da edição
include_once "config_alquimia.php";

if (isset($_POST['update'])) {
    $id = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $funcao = $_POST['funcao'];

    // Atualiza nome na tabela USUARIOS
    $sqlU = "UPDATE USUARIOS SET nome=? WHERE id_usuario=?";
    $stmtU = mysqli_prepare($conexao, $sqlU);
    mysqli_stmt_bind_param($stmtU, "si", $nome, $id);
    mysqli_stmt_execute($stmtU);

    // Atualiza função na tabela AUTORIZADOS
    $sqlA = "UPDATE AUTORIZADOS SET funcao=? WHERE id_usuario=?";
    $stmtA = mysqli_prepare($conexao, $sqlA);
    mysqli_stmt_bind_param($stmtA, "si", $funcao, $id);
    mysqli_stmt_execute($stmtA);

    header("Location: ../in/adm_funcionarios.php");
}
