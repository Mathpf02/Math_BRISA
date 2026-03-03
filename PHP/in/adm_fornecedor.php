<?php
// Verifica se o usuário logado é um ADMINISTRADOR
require_once('../config/common.php');
require_once('../config/config_alquimia.php');

if (!eh_administrador()) {
    header('Location: sist_login.php');
    exit();
}

// Lógica de busca: Verifica se há algo na sessão e limpa após o uso
$termo_busca = $_SESSION['pesquisa_fornecedor'] ?? null;
// Mantemos a chamada da função que está no common.php
$fornecedores = listar_fornecedores($conexao, $termo_busca);

// Limpa o filtro de pesquisa da sessão
unset($_SESSION['pesquisa_fornecedor']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fornecedores - Sistema de Gestão de Estoque</title>
    <link rel="stylesheet" href="style_F-MENU.css" />
    <link rel="stylesheet" href="style_FUNCIONARIOS.css" />
</head>

<body>
    <header class="header">
        <div class="header-container">
            <a href="../../index.html" class="logo-link">
                <img src="../../image/Logo_ALQUIMIA.png" alt="Alquimia Taverna" class="logo-unipampa" />
            </a>

            <nav class="nav-menu" aria-label="Navegação principal">
                <a class="nav-btn" href="adm_menu.php">MENU</a>
                <span class="nav-divider">|</span>
                <a href="../config/verif_logout.php" class="nav-btn btn-entrar">SAIR</a>
            </nav>
        </div>
    </header>

    <main class="content-area">

        <div class="title-block">
            <h2><strong>CONTROLE DE FORNECEDORES</strong></h2>
            <h4>SISTEMA DE GESTÃO DE ESTOQUE</h4>
        </div>

        <div class="table-container">
            <div class="pesquisa-cadastro">

                <form action="../config/config_pesq_fornecedor.php" method="POST" class="form">
                    <input type="text" class="campo-pesquisa" placeholder="NOME | SOBRENOME | CPF/CNPJ | E-MAIL" name="pesquisa" id="pesquisa">
                    <input type="submit" value="PESQUISA" class="btn-adicionar">
                </form>

                <div class="action-bar">
                    <a href="cad_fornecedor.php" class="btn-adicionar"><strong>+ CADASTRAR</strong></a>
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
                        unset($_SESSION['msg_status']);
                        ?>
                    </div>
                <?php endif; ?>
            </div>

            <table class="table-funcionarios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>SOBRENOME</th>
                        <th>TELEFONE</th>
                        <th>E-MAIL</th>
                        <th>CPF / CNPJ</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($fornecedores) > 0): ?>
                        <?php foreach ($fornecedores as $func): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($func['id_fornecedor']); ?></td>
                                <td><?php echo htmlspecialchars($func['nome']); ?></td>
                                <td><?php echo htmlspecialchars($func['sobrenome']); ?></td>
                                <td><?php echo htmlspecialchars($func['telefone'] ?? 'Não informado'); ?></td>
                                <td><?php echo htmlspecialchars($func['email']); ?></td>
                                <td><?php echo htmlspecialchars($func['cpf_cnpj']); ?></td>

                                <td class="col-acoes">
                                    <a href="cad_fornecedor.php?id=<?php echo $func['id_fornecedor']; ?>" class="btn-editar">
                                        <strong>EDITAR</strong>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">NENHUM FORNECEDOR ENCONTRADO</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>