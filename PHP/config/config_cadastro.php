<?php
// config_cadastro.php
require_once 'common.php';
require_once 'config_alquimia.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acao = $_POST['acao'];
    $id_usuario = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $funcao = $_POST['funcao'];

    mysqli_begin_transaction($conexao);

    try {
        if ($acao === 'editar') {
            // Lógica de UPDATE
            $sqlUser = "UPDATE USUARIOS SET nome=?, sobrenome=?, cpf=?, email=? WHERE id_usuario=?";
            $stmtUser = mysqli_prepare($conexao, $sqlUser);
            mysqli_stmt_bind_param($stmtUser, "ssssi", $nome, $sobrenome, $cpf, $email, $id_usuario);
            mysqli_stmt_execute($stmtUser);

            // Se a senha foi preenchida, atualiza ela separadamente
            if (!empty($_POST['senha'])) {
                $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $sqlSenha = "UPDATE USUARIOS SET senha=? WHERE id_usuario=?";
                $stmtS = mysqli_prepare($conexao, $sqlSenha);
                mysqli_stmt_bind_param($stmtS, "si", $novaSenha, $id_usuario);
                mysqli_stmt_execute($stmtS);
            }

            $sqlAuth = "UPDATE AUTORIZADOS SET funcao=? WHERE id_usuario=?";
            $stmtAuth = mysqli_prepare($conexao, $sqlAuth);
            mysqli_stmt_bind_param($stmtAuth, "si", $funcao, $id_usuario);
            mysqli_stmt_execute($stmtAuth);

            $_SESSION['msg_status'] = "DADOS ATUALIZADOS COM SUCESSO!";
        } else {
            // Lógica de INSERT (Seu código original de cadastro)
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $sqlUser = "INSERT INTO USUARIOS (cpf, nome, sobrenome, email, senha) VALUES (?, ?, ?, ?, ?)";
            $stmtUser = mysqli_prepare($conexao, $sqlUser);
            mysqli_stmt_bind_param($stmtUser, "sssss", $cpf, $nome, $sobrenome, $email, $senha);
            mysqli_stmt_execute($stmtUser);

            $novo_id = mysqli_insert_id($conexao);

            $sqlAuth = "INSERT INTO AUTORIZADOS (id_usuario, funcao) VALUES (?, ?)";
            $stmtAuth = mysqli_prepare($conexao, $sqlAuth);
            mysqli_stmt_bind_param($stmtAuth, "is", $novo_id, $funcao);
            mysqli_stmt_execute($stmtAuth);

            $_SESSION['msg_status'] = "FUNCIONÁRIO CADASTRADO COM SUCESSO!";
        }

        mysqli_commit($conexao);
        header('Location: ../in/adm_funcionarios.php');
        exit();
    } catch (Exception $e) {
        mysqli_rollback($conexao);
        $_SESSION['msg_status'] = "ERRO NA OPERAÇÃO: " . $e->getMessage();
        header('Location: ../in/adm_funcionarios.php');
        exit();
    }
}
