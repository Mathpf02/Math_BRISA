<?php

require_once('../config/common.php');
require_once('../config/config_alquimia.php');

if (!eh_adminstrador()) {
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
    'funcao' => ''
];

// Se houver ID na URL, entramos no modo de EDIÇÃO
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = intval($_GET['id']);

    $sql = "SELECT U.*, A.funcao FROM USUARIOS U 
            INNER JOIN AUTORIZADOS A ON U.id_usuario = A.id_usuario 
            WHERE U.id_usuario = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($u = mysqli_fetch_assoc($res)) {
        $dados = $u;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_LOGIN.css" />
    <title><?php echo $edit_mode ? "Editar" : "Cadastrar"; ?> Funcionário - ALQUIMIA TAVERNA</title>
</head>

<body>
    <div class="header">
        <strong>
            <h2><?php echo $edit_mode ? "ATUALIZAR DADOS" : "CADASTRAR FUNCIONÁRIO"; ?></h2>
        </strong>
        <h3>SISTEMA DE GESTÃO DE ESTOQUE</h3>
    </div>
    <div class="container">
        <form action="../config/config_cadastro.php" method="POST" class="form">
            <input type="hidden" name="id_usuario" value="<?php echo $dados['id_usuario']; ?>">
            <input type="hidden" name="acao" value="<?php echo $edit_mode ? 'editar' : 'cadastrar'; ?>">

            <input type="text" name="nome" placeholder="NOME" value="<?php echo htmlspecialchars($dados['nome']); ?>" required>
            <input type="text" name="sobrenome" placeholder="SOBRENOME" value="<?php echo htmlspecialchars($dados['sobrenome']); ?>" required>
            <input type="text" name="cpf" placeholder="CPF" value="<?php echo htmlspecialchars($dados['cpf']); ?>" required>
            <input type="email" name="email" placeholder="E-MAIL" value="<?php echo htmlspecialchars($dados['email']); ?>" required>

            <input type="password" name="senha" placeholder="<?php echo $edit_mode ? 'NOVA SENHA (DEIXE VAZIO PARA MANTER)' : 'SENHA'; ?>" <?php echo $edit_mode ? '' : 'required'; ?>>

            <select name="funcao" required>
                <option value="funcionário" <?php echo $dados['funcao'] == 'funcionário' ? 'selected' : ''; ?>>FUNCIONÁRIO</option>
                <option value="administrador" <?php echo $dados['funcao'] == 'administrador' ? 'selected' : ''; ?>>ADMINISTRADOR</option>
            </select>

            <button type="submit"><strong><?php echo $edit_mode ? "SALVAR" : "CADASTRAR"; ?></strong></button>
            <a href="adm_funcionarios.php">CANCELAR</a>
        </form>
    </div>

</body>

</html>