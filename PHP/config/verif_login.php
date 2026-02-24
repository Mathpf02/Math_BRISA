<?php
include_once "config_alquimia.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Limpeza de dados
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $senha = trim($_POST['senha']);

    if (empty($email) || empty($senha)) {
        $_SESSION['erro'] = "PREENCHA TODOS OS CAMPOS!";
        header("Location: ../in/sist_login.php");
        exit();
    }

    // Consulta com INNER JOIN para correlacionar as tabelas
    /*testar o id_usuario primeiro e dps testar o  email e senha separados.*/
    $sql = "SELECT U.id_usuario, 
    U.nome, U.senha, A.funcao 
            FROM USUARIOS U 
            INNER JOIN AUTORIZADOS A ON U.id_usuario = A.id_usuario 
            WHERE U.email = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        // Verificação de senha (se você usou password_hash no cadastro)
        // Se ainda estiver usando texto puro, use: if ($senha == $usuario['senha'])
        if (password_verify($senha, $usuario['senha'])) {

            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['funcao'] = $usuario['funcao'];

            // Redirecionamento baseado na função vinda da tabela AUTORIZADOS
            if ($usuario['funcao'] == 'administrador') {
                header("Location: ../in/adm_menu.php");
            } else {
                header("Location: ../in/func_menu.php");
            }
            exit();
        } else {
            $_SESSION['erro'] = "SENHA INCORRETA!";
            header("Location: ../in/sist_login.php");
        }
    } else {
        $_SESSION['erro'] = "USUÁRIO NÃO ENCONTRADO OU NÃO AUTORIZADO!";
        header("Location: ../in/sist_login.php");
    }
}
