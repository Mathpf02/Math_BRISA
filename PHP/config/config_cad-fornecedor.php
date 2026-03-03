<?php
require_once('common.php');
require_once('config_alquimia.php');

// Proteção de rota
if (!eh_administrador()) {
    header('Location: ../in/sist_login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Recebe e limpa os dados de texto comuns
    $nome = trim($_POST['nome'] ?? '');
    $sobrenome = trim($_POST['sobrenome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    
    // CORREÇÃO: O nome da variável agora é $cpf_cnpj para bater com o bind_param abaixo
    $cpf_cnpj = trim($_POST['cpf_cnpj'] ?? '');

    // 2. Recebe os dados dos arquivos de imagem via $_FILES
    $ft_rg = '';
    $ft_perfil = '';

    // Verifica se enviaram a foto do RG e se não houve erro no upload
    if (isset($_FILES['ft_rg']) && $_FILES['ft_rg']['error'] === UPLOAD_ERR_OK) {
        $ft_rg = $_FILES['ft_rg']['name']; // Pega o nome do arquivo enviado
    }

    // Verifica se enviaram a foto de perfil e se não houve erro no upload
    if (isset($_FILES['ft_perfil']) && $_FILES['ft_perfil']['error'] === UPLOAD_ERR_OK) {
        $ft_perfil = $_FILES['ft_perfil']['name']; // Pega o nome do arquivo enviado
    }

    // 3. Prepara a query SQL com Prepared Statements
    $sql = "INSERT INTO FORNECEDOR (nome, sobrenome, email, telefone, cpf_cnpj, ft_rg, ft_perfil) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);
    
    // Agora o $cpf_cnpj existe e está com o dado correto!
    mysqli_stmt_bind_param($stmt, "sssssss", $nome, $sobrenome, $email, $telefone, $cpf_cnpj, $ft_rg, $ft_perfil);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['msg_status'] = "Fornecedor cadastrado com sucesso!";
    } else {
        $_SESSION['msg_status'] = "Erro ao cadastrar fornecedor: " . mysqli_error($conexao);
    }
    
    // Redireciona de volta
    header('Location: ../in/adm_fornecedor.php');
}