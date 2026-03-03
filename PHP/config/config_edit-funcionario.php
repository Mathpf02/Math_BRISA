<?php
require_once('common.php');
require_once('config_alquimia.php');

if (!eh_administrador()) {
    header('Location: ../in/sist_login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = intval($_POST['id_usuario'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $sobrenome = trim($_POST['sobrenome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $funcao = trim($_POST['funcao'] ?? '');
    $nova_senha = $_POST['senha'] ?? ''; // Nova senha digitada

    if ($id_usuario > 0) {
        $update_foto = false;
        $ft_perfil = '';
        if (isset($_FILES['ft_perfil']) && $_FILES['ft_perfil']['error'] === UPLOAD_ERR_OK) {
            $ft_perfil = $_FILES['ft_perfil']['name'];
            $update_foto = true;
        }

        // --- LÓGICA DE ATUALIZAÇÃO ---
        // Se a senha NÃO foi preenchida, ignora a coluna "senha"
        if (empty($nova_senha)) {
            if ($update_foto) {
                $sql = "UPDATE USUARIOS SET cpf=?, nome=?, sobrenome=?, email=?, ft_perfil=? WHERE id_usuario=?";
                $stmt = mysqli_prepare($conexao, $sql);
                mysqli_stmt_bind_param($stmt, "sssssi", $cpf, $nome, $sobrenome, $email, $ft_perfil, $id_usuario);
            } else {
                $sql = "UPDATE USUARIOS SET cpf=?, nome=?, sobrenome=?, email=? WHERE id_usuario=?";
                $stmt = mysqli_prepare($conexao, $sql);
                mysqli_stmt_bind_param($stmt, "ssssi", $cpf, $nome, $sobrenome, $email, $id_usuario);
            }
        }
        // Se a senha FOI preenchida, aplica o hash e atualiza a coluna "senha" junto
        else {
            $senha_cripto = password_hash($nova_senha, PASSWORD_DEFAULT);
            if ($update_foto) {
                $sql = "UPDATE USUARIOS SET cpf=?, nome=?, sobrenome=?, email=?, senha=?, ft_perfil=? WHERE id_usuario=?";
                $stmt = mysqli_prepare($conexao, $sql);
                mysqli_stmt_bind_param($stmt, "ssssssi", $cpf, $nome, $sobrenome, $email, $senha_cripto, $ft_perfil, $id_usuario);
            } else {
                $sql = "UPDATE USUARIOS SET cpf=?, nome=?, sobrenome=?, email=?, senha=? WHERE id_usuario=?";
                $stmt = mysqli_prepare($conexao, $sql);
                mysqli_stmt_bind_param($stmt, "sssssi", $cpf, $nome, $sobrenome, $email, $senha_cripto, $id_usuario);
            }
        }

        $sucesso = mysqli_stmt_execute($stmt);

        if ($sucesso && !empty($funcao)) {
            $sql_auth = "UPDATE AUTORIZADOS SET funcao=? WHERE id_usuario=?";
            $stmt_auth = mysqli_prepare($conexao, $sql_auth);
            mysqli_stmt_bind_param($stmt_auth, "si", $funcao, $id_usuario);
            mysqli_stmt_execute($stmt_auth);
        }
        $_SESSION['msg_status'] = "Funcionário atualizado com sucesso!";
    }

    header('Location: ../in/adm_funcionarios.php');
    exit();
}
