<?php
require_once('common.php');
require_once('config_alquimia.php');

if (!eh_administrador()) { header('Location: ../in/sist_login.php'); exit(); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $sobrenome = trim($_POST['sobrenome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $funcao = trim($_POST['funcao'] ?? 'funcionário');
    
    // Recebe a senha digitada pelo administrador e já aplica o HASH seguro
    $senha_limpa = $_POST['senha'] ?? '';
    $senha_criptografada = password_hash($senha_limpa, PASSWORD_DEFAULT);

    $ft_perfil = '';
    if (isset($_FILES['ft_perfil']) && $_FILES['ft_perfil']['error'] === UPLOAD_ERR_OK) {
        $ft_perfil = $_FILES['ft_perfil']['name'];
    }

    $sql = "INSERT INTO USUARIOS (cpf, nome, sobrenome, email, senha, ft_perfil) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $cpf, $nome, $sobrenome, $email, $senha_criptografada, $ft_perfil);
    
    if (mysqli_stmt_execute($stmt)) {
        $id_novo = mysqli_insert_id($conexao);
        $sql_auth = "INSERT INTO AUTORIZADOS (id_usuario, funcao) VALUES (?, ?)";
        $stmt_auth = mysqli_prepare($conexao, $sql_auth);
        mysqli_stmt_bind_param($stmt_auth, "is", $id_novo, $funcao);
        mysqli_stmt_execute($stmt_auth);
        $_SESSION['msg_status'] = "Funcionário cadastrado com sucesso!";
    }
    
    header('Location: ../in/adm_funcionario.php');
    exit();
}