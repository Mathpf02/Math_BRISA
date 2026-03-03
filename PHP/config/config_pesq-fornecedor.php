<?php
require_once('common.php');
require_once('config_alquimia.php');

// Proteção de rota: apenas administradores podem pesquisar
if (!eh_administrador()) {
    header('Location: ../in/sist_login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Salva o termo pesquisado na sessão específica de fornecedores
    $_SESSION['pesquisa_fornecedor'] = $_POST['pesquisa'] ?? '';

    // Redireciona de volta para a página de administração de fornecedores
    header('Location: ../in/adm_fornecedor.php');
    exit();
}
