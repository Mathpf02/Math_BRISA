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
    'id_fornecedor' => '',
    'nome' => '',
    'sobrenome' => '',
    'cpf_cnpj' => '',
    'email' => '',
    'telefone' => '',
    'ft_rg' => '',
    'ft_perfil' => ''
];

// Se houver ID na URL, entramos no modo de EDIÇÃO
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM FORNECEDOR WHERE id_fornecedor = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($u = mysqli_fetch_assoc($res)) {
        // Usa array_merge para mesclar os dados e evitar o erro do htmlspecialchars com valores nulos
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
    <title><?php echo $edit_mode ? "Editar" : "Cadastrar"; ?> Fornecedores - ALQUIMIA TAVERNA</title>
</head>

<body>
    <div class="header">
        <strong>
            <h2><?php echo $edit_mode ? "ATUALIZAR FORNECEDORES" : "CADASTRAR FORNECEDORES"; ?></h2>
        </strong>
        <h3>SISTEMA DE GESTÃO DE ESTOQUE</h3>
    </div>
    <div class="container">
        <form action="../config/config_cad-fornecedor.php" method="POST" class="form">
            <input type="hidden" name="id_fornecedor" value="<?php echo $dados['id_fornecedor']; ?>">
            <input type="hidden" name="acao" value="<?php echo $edit_mode ? 'editar' : 'cadastrar'; ?>">

            <input type="text" name="nome" placeholder="NOME" value="<?php echo htmlspecialchars($dados['nome']); ?>" required>
            <input type="text" name="sobrenome" placeholder="SOBRENOME" value="<?php echo htmlspecialchars($dados['sobrenome']); ?>" required>
            <input type="email" name="email" placeholder="E-MAIL" value="<?php echo htmlspecialchars($dados['email']); ?>" required>
            <input type="text" name="telefone" placeholder="TELEFONE" value="<?php echo htmlspecialchars($dados['telefone']); ?>" required>
            <input type="text" name="cpf_cnpj" placeholder="CPF/CNPJ" value="<?php echo htmlspecialchars($dados['cpf_cnpj']); ?>" required>
            <input type="file" name="ft_rg" placeholder="FOTO DO RG" value="<?php echo htmlspecialchars($dados['ft_rg']); ?>" required>
            <input type="file" name="ft_perfil" placeholder="FOTO DE PERFIL" value="<?php echo htmlspecialchars($dados['ft_perfil']); ?>" required>

            <button type="submit"><strong><?php echo $edit_mode ? "SALVAR" : "CADASTRAR"; ?></strong></button>
            <a href="adm_fornecedor.php">CANCELAR</a>
        </form>
    </div>

</body>

</html>