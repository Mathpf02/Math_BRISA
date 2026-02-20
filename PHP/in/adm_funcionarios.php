<?php
// Verifica se o usuário logado é um ADMINISTRADOR
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['funcao'] != 'admin') {
    header('Location: sist_login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários - Sistema de Gestão de Estoque</title>
    <link rel="stylesheet" href="style_FUNCIONARIOS.css">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <a class="nav-logo-link" href="https://unipampa.edu.br/portal/" target="_blank">
            <img src="../../SRC/image/Logo_UNIPAMPA.png" class="nav-logo">
        </a>

        <a class="nav-logo-link" href="../../index.html">
            <img src="../../SRC/image/Logo_ALQUIMIA.png" class="nav-logo alquimia">
        </a>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="content-area">

        <!-- TÍTULOS -->
        <div class="title-block">
            <h2><strong>FUNCIONÁRIOS</strong></h2>
            <h4>SISTEMA DE GESTÃO DE ESTOQUE</h4>
        </div>

        <!-- BOX COM TABELA -->
        <div class="box">

            <!-- BOTÃO ADICIONAR -->
            <div class="action-bar">
                <a href="adm_cadastros.php" class="btn-adicionar"><strong>+ CADASTRAR</strong></a>
            </div>

            <!-- TABELA DE FUNCIONÁRIOS -->
            <table class="table-funcionarios">
                <thead>
                    <tr>
                        <th> </th>
                        <th>NOME</th>
                        <th>SOBRENOME</th>
                        <th>CPF</th>
                        <th>E-MAIL</th>
                        <th>FUNÇÃO</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($funcionarios) > 0): ?>
                        <?php foreach ($funcionarios as $func): ?>
                            <tr>
                                <td><?php echo $func['id']; ?></td>
                                <td><?php echo htmlspecialchars($func['nome']); ?></td>
                                <td><?php echo htmlspecialchars($func['sobrenome']); ?></td>
                                <td><?php echo htmlspecialchars($func['cpf']); ?></td>
                                <td><?php echo htmlspecialchars($func['email']); ?></td>
                                <td><?php echo htmlspecialchars($func['funcao']); ?></td>
                                <td class="col-acoes">
                                    <a href="funcionarios_editar.php?id=<?php echo $func['id']; ?>" class="btn-editar">EDITAR</a>
                                    <a href="funcionarios_deletar.php?id=<?php echo $func['id']; ?>" class="btn-deletar" onclick="return confirm('Tem certeza?')">DELETAR</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="sem-dados">Nenhum funcionário cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>

        <!-- BOTÃO VOLTAR -->
        <div class="back-button">
            <a href="adm_menu.php">← VOLTAR AO MENU</a>
        </div>

    </main>

</body>

</html>