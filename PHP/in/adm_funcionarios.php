<?php

// Verifica se o usuário logado é um ADMINISTRADOR
require_once('../config/common.php');
require_once('../config/config_alquimia.php');

if (!eh_adminstrador()) {
    header('Location: sist_login.php');
    exit();
}

// 2. Lógica de busca: Verifica se há algo na sessão e limpa após o uso
$termo_busca = $_SESSION['pesquisa'] ?? null;
$funcionarios = listar_funcionarios($conexao, $termo_busca);

// Limpa o filtro de pesquisa da sessão para que não persista eternamente
unset($_SESSION['pesquisa']);

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários - Sistema de Gestão de Estoque</title>
    <link rel="stylesheet" href="style_FUNCIONARIOS.css">
</head>
<style>
    .campo-pesquisa {
        background-color: #85848433;
        color: white;
    }
</style>

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
            <div class="pesquisa-cadastro">

                <form action="../config/co.php" method="POST" class="form">
                    <input type="text" class="campo-pesquisa" placeholder= "NOME | SOBRENOME | CPF | E-MAIL" name="pesquisa" id="pesquisa">
                    <input type="submit" value="PESQUISA" class="btn-adicionar">
                </form>
                <!-- BOTÃO ADICIONAR -->
                <div class="action-bar">
                    <a href="adm_cadastros.php" class="btn-adicionar"><strong>+ CADASTRAR</strong></a>
                </div>
                <?php if (isset($_SESSION['msg_status'])): ?>
                    <div style="background-color: #d4edda; 
                                color: #155724; padding: 15px; 
                                text-align: center; 
                                font-weight: bold; 
                                border-radius: 5px; 
                                margin-bottom: 20px; 
                                border: 1px solid #c3e6cb;">
                        <?php
                        echo $_SESSION['msg_status'];
                        unset($_SESSION['msg_status']); // Limpa a mensagem para não repetir no refresh
                        ?>
                    </div>
                <?php endif; ?>
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
                                <td><?php echo $func['id_usuario']; ?></td>
                                <td><?php echo htmlspecialchars($func['nome']); ?></td>
                                <td><?php echo htmlspecialchars($func['sobrenome']); ?></td>
                                <td><?php echo htmlspecialchars($func['cpf']); ?></td>
                                <td><?php echo htmlspecialchars($func['email']); ?></td>
                                <td><?php echo htmlspecialchars($func['funcao']); ?></td>
                                <td class="col-acoes">
                                    <a href="../config/config_pdf.php?id=<?php echo $func['id_usuario']; ?>" class="btn-pdf">
                                        <strong>PDF</strong>
                                    </a>
                                    <a href="adm_cadastros.php?id=<?php echo $func['id_usuario']; ?>" class="btn-editar">
                                        <strong>EDITAR</strong>
                                    </a>
                                    <a href="../config/config_suprimir.php?id=<?php echo $func['id_usuario']; ?>" class="btn-suprimir"
                                        onclick="return confirm('Deseja realmente <?php echo ($func['funcao'] == 'inativo') ? 'ATIVAR' : 'SUPRIMIR'; ?> este usuário?')">
                                        <!-- Muda conforme a cituação do usuário-->
                                        <strong>
                                            <?php echo ($func['funcao'] == 'inativo') ? 'ATIVAR' : 'SUPRIMIR'; ?>
                                        </strong>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">NENHUM USUÁRIO ENCONTRADO</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>

        <!-- BOTÃO VOLTAR -->
        <div class="back-button">
            <a href="adm_menu.php">
                <strong>VOLTAR AO MENU</strong>
            </a>
        </div>

    </main>

</body>

</html>