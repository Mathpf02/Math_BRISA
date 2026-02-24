<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

/**
 * Verifica se o usuário logado tem função de administrador
 */
function eh_adminstrador() {
    return (isset($_SESSION['id_usuario']) && $_SESSION['funcao'] === 'administrador');
}

/**
 * Verifica se o usuário logado tem função de funcionário
 */
function eh_funcionario() {
    return (isset($_SESSION['id_usuario']) && $_SESSION['funcao'] === 'funcionário');
}

/**
 * Função centralizada para busca e listagem de funcionários
 * @param mysqli $conexao Objeto de conexão com o banco
 * @param string|null $pesquisa Termo de busca (opcional)
 * @return array Lista de funcionários encontrados
 */
function listar_funcionarios($conexao, $pesquisa = null) {
    $funcionarios = [];
    
    if (!empty($pesquisa)) {
        // Busca Filtrada (Segura contra SQL Injection usando Prepared Statements)
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
?>