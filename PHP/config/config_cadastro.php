<?php
require_once 'config_alquimia.php'; // Usa sua conexão existente

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografia por segurança
    $funcao = $_POST['funcao'];

    // Iniciar transação para garantir que ambos os inserts funcionem ou nenhum
    mysqli_begin_transaction($conexao);

    try {
        // 1. Inserir na tabela USUARIOS
        $sqlUser = "INSERT INTO USUARIOS (cpf, nome, sobrenome, email, senha) VALUES (?, ?, ?, ?, ?)";
        $stmtUser = mysqli_prepare($conexao, $sqlUser);
        mysqli_stmt_bind_param($stmtUser, "sssss", $cpf, $nome, $sobrenome, $email, $senha);
        mysqli_stmt_execute($stmtUser);

        // Recuperar o ID gerado para o usuário
        $id_usuario = mysqli_insert_id($conexao);

        // 2. Inserir na tabela AUTORIZADOS correlacionando o ID
        $sqlAuth = "INSERT INTO AUTORIZADOS (id_usuario, funcao) VALUES (?, ?)";
        $stmtAuth = mysqli_prepare($conexao, $sqlAuth);
        mysqli_stmt_bind_param($stmtAuth, "is", $id_usuario, $funcao);
        mysqli_stmt_execute($stmtAuth);

        mysqli_commit($conexao);

        // Define a mensagem de sucesso na sessão
        $_SESSION['msg_status'] = "EXITO DE CADASTRAMENTO";
        header('Location: ../in/adm_funcionarios.php');
        exit();

    } catch (Exception $e) {
        mysqli_rollback($conexao);
        
        // Define a mensagem de erro na sessão
        $_SESSION['msg_status'] = "ERRO AO CADASTRAR: " . $e->getMessage();
        header('Location: ../in/adm_funcionarios.php');
        exit();
    }
}
