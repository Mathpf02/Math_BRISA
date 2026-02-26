<?php
include_once "config_alquimia.php";

// Dados do novo usuário administrador
$cpf = "000.000.000-01"; // Valor padrão para CPF
$nome = "Gerardo";

$sobrenome = "Bot";

$email = "gerardogaetjens.aluno@unipampa.edu.br";

$senha_pura = "admin123";

$senha_hashed = password_hash($senha_pura, PASSWORD_DEFAULT);
$funcao = "administrador";

mysqli_begin_transaction($conexao);

try {
    // 1. Inserir na tabela USUARIOS
    $sqlUser = "INSERT INTO USUARIOS (cpf, nome, sobrenome, email, senha) VALUES (?, ?, ?, ?, ?)";
    $stmtUser = mysqli_prepare($conexao, $sqlUser);
    mysqli_stmt_bind_param($stmtUser, "sssss", $cpf, $nome, $sobrenome, $email, $senha_hashed);
    mysqli_stmt_execute($stmtUser);

    $id_usuario = mysqli_insert_id($conexao);

    // 2. Inserir na tabela AUTORIZADOS
    $sqlAuth = "INSERT INTO AUTORIZADOS (id_usuario, funcao) VALUES (?, ?)";
    $stmtAuth = mysqli_prepare($conexao, $sqlAuth);
    mysqli_stmt_bind_param($stmtAuth, "is", $id_usuario, $funcao);
    mysqli_stmt_execute($stmtAuth);

    mysqli_commit($conexao);
    echo "Usuário Administrador criado com sucesso!\n";
    echo "E-mail: $email\n";
    echo "Senha: $senha_pura\n";
}
catch (Exception $e) {
    mysqli_rollback($conexao);
    echo "Erro ao criar usuário: " . $e->getMessage();
}
?>
