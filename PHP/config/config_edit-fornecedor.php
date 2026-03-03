<?php
require_once('common.php');
require_once('config_alquimia.php');

// Proteção de rota
if (!eh_administrador()) {
    header('Location: ../in/sist_login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados
    $id_usuario = intval($_POST['id_usuario'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $sobrenome = trim($_POST['sobrenome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $cpf = trim($_POST['cpf'] ?? ''); 
    $ft_rg = trim($_POST['ft_rg'] ?? '');
    $ft_perfil = trim($_POST['ft_perfil'] ?? '');

    if ($id_usuario > 0) {
        // Query de UPDATE
        $sql = "UPDATE FORNECEDOR SET nome=?, sobrenome=?, email=?, telefone=?, cpf=?, ft_rg=?, ft_perfil=? WHERE id_usuario=?";
        
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $nome, $sobrenome, $email, $telefone, $cpf, $ft_rg, $ft_perfil, $id_usuario);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['msg_status'] = "Fornecedor atualizado com sucesso!";
        } else {
            $_SESSION['msg_status'] = "Erro ao atualizar fornecedor: " . mysqli_error($conexao);
        }
    } else {
        $_SESSION['msg_status'] = "ID do fornecedor é inválido!";
    }
    
    // Redireciona
    header('Location: ../in/adm_fornecedor.php');
    exit();
}
?>