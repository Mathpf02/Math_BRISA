<?php

require_once('../config/common.php');
require_once('../config/config_alquimia.php');

if (!eh_administrador()) {
    header('Location: sist_login.php');
    exit();
}

// Variáveis para controle do modo (Cadastro ou Edição)
$edit_mode = false;
$dados = [
    'id_usuario' => '',
    'nome' => '',
    'sobrenome' => '',
    'cpf' => '',
    'email' => '',
    'funcao' => '', 
    'ft_perfil' => ''
];

// Se houver ID na URL, entramos no modo de EDIÇÃO
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = intval($_GET['id']);

    // Para funcionários usamos a tabela USUARIOS conectada com AUTORIZADOS.
    $sql = "SELECT U.*, A.funcao FROM USUARIOS U 
            LEFT JOIN AUTORIZADOS A ON U.id_usuario = A.id_usuario 
            WHERE U.id_usuario = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($u = mysqli_fetch_assoc($res)) {
        // Usa array_merge para mesclar os dados e evitar o erro com valores nulos
        $dados = array_merge($dados, $u);
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_LOGIN.css" />
    <title><?php echo $edit_mode ? "Editar" : "Cadastrar"; ?> Funcionários - ALQUIMIA TAVERNA</title>
</head>

<body>
    <div class="header">
        <strong>
            <h2><?php echo $edit_mode ? "ATUALIZAR FUNCIONÁRIOS" : "CADASTRAR FUNCIONÁRIOS"; ?></h2>
        </strong>
        <h3>SISTEMA DE GESTÃO DE ESTOQUE</h3>
    </div>

    <div class="container">
        <form action="../config/config_cad-funcionario.php" method="POST" class="form" enctype="multipart/form-data">

            <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($dados['id_usuario'] ?? ''); ?>">
            <input type="hidden" name="acao" value="<?php echo $edit_mode ? 'editar' : 'cadastrar'; ?>">

            <input type="text" name="nome" placeholder="NOME" value="<?php echo htmlspecialchars($dados['nome'] ?? ''); ?>" required>
            <input type="text" name="sobrenome" placeholder="SOBRENOME" value="<?php echo htmlspecialchars($dados['sobrenome'] ?? ''); ?>" required>
            <input type="email" name="email" placeholder="E-MAIL" value="<?php echo htmlspecialchars($dados['email'] ?? ''); ?>" required>
            <input type="text" name="cpf" placeholder="CPF" value="<?php echo htmlspecialchars($dados['cpf'] ?? ''); ?>" required>

            <input type="password" name="senha" placeholder="<?php echo $edit_mode ? 'NOVA SENHA (Opcional)' : 'SENHA'; ?>" <?php echo $edit_mode ? '' : 'required'; ?>>

            <select name="funcao" required>
                <option value="" disabled <?php echo empty($dados['funcao']) ? 'selected' : ''; ?>>SELECIONE A FUNÇÃO</option>
                <option value="funcionário" <?php echo ($dados['funcao'] === 'funcionário' || $dados['funcao'] === 'funcionario') ? 'selected' : ''; ?>>Funcionário</option>
                <option value="administrador" <?php echo ($dados['funcao'] === 'administrador') ? 'selected' : ''; ?>>Administrador</option>
            </select>

            <input type="file" name="ft_perfil" placeholder="FOTO DE PERFIL" <?php echo $edit_mode ? '' : 'required'; ?>>

            <button type="submit"><strong><?php echo $edit_mode ? "SALVAR" : "CADASTRAR"; ?></strong></button>
            <a href="adm_funcionario.php">CANCELAR</a>
        </form>
    </div>

</body>

</html>