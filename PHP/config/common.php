<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
// ==========================================
// INTERCEPTADOR DE REQUISIÇÕES (CONTROLADOR)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {

    // Se a ação for a pesquisa de funcionários
    if ($_POST['action'] === 'pesquisar_funcionario') {
        $_SESSION['pesquisa'] = $_POST['pesquisa'];
        header('Location: ../in/adm_funcionarios.php');
        exit();
    }

    // Você pode adicionar outras ações aqui no futuro...
}

/**
 * Verifica se o usuário logado tem função de administrador
 */
function eh_administrador()
{
    return (isset($_SESSION['id_usuario']) && $_SESSION['funcao'] === 'administrador');
}

/**
 * Verifica se o usuário logado tem função de funcionário
 */
function eh_funcionario()
{
    return (isset($_SESSION['id_usuario']) && $_SESSION['funcao'] === 'funcionário');
}

/**
 * Função centralizada para busca e listagem de funcionários
 */
function listar_funcionarios($conexao, $pesquisa = null)
{
    $funcionarios = [];

    if (!empty($pesquisa)) {
        // Busca Filtrada (Segura contra SQL Injection)
        $sql = "SELECT U.id_usuario, U.nome, U.sobrenome, U.cpf, U.email, A.funcao 
                FROM USUARIOS U 
                INNER JOIN AUTORIZADOS A ON U.id_usuario = A.id_usuario 
                WHERE U.nome LIKE ? OR U.sobrenome LIKE ? OR U.cpf LIKE ?";

        $stmt = mysqli_prepare($conexao, $sql);
        $termo = "%" . $pesquisa . "%";
        mysqli_stmt_bind_param($stmt, "sss", $termo, $termo, $termo);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $funcionarios = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
        // Listagem Completa
        $sql = "SELECT U.id_usuario, U.nome, U.sobrenome, U.cpf, U.email, A.funcao 
                FROM USUARIOS U 
                INNER JOIN AUTORIZADOS A ON U.id_usuario = A.id_usuario";
        $res = mysqli_query($conexao, $sql);
        $funcionarios = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    return $funcionarios;
}

/**
 * Função centralizada para busca e listagem de fornecedores
 */
function listar_fornecedores($conexao, $pesquisa = null)
{
    $fornecedores = [];

    if (!empty($pesquisa)) {
        // CORREÇÃO: id_fornecedor no lugar de id_usuario
        $sql = "SELECT id_fornecedor, nome, sobrenome, telefone, email, cpf_cnpj 
                FROM FORNECEDOR 
                WHERE nome LIKE ? OR sobrenome LIKE ? OR cpf_cnpj LIKE ? OR email LIKE ?";

        $stmt = mysqli_prepare($conexao, $sql);
        $termo = "%" . $pesquisa . "%";

        mysqli_stmt_bind_param($stmt, "ssss", $termo, $termo, $termo, $termo);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $fornecedores = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
        // Listagem Completa
        // CORREÇÃO: id_fornecedor no lugar de id_usuario
        $sql = "SELECT id_fornecedor, nome, sobrenome, telefone, email, cpf_cnpj 
                FROM FORNECEDOR";

        $res = mysqli_query($conexao, $sql);
        $fornecedores = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    return $fornecedores;
}
