<?php
// Verifica se o usuário logado é um FUNCIONÁRIO
require_once('../config/common.php');
if (!isset($_SESSION['id_usuario'])) {
    header('Location: sist_login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu - Sistema de Gestão de Estoque</title>
    <link rel="stylesheet" href="style_F-MENU.css" />
</head>

<body>
    <!-- Navbar somente com as logos -->
    <header class="header">
        <div class="header-container">
            <a href="../../index.html" class="logo-link">
                <!-- A imagem esta com ENDEREÇO ERRADO - CSS precisa de alteração  -->
                <img src="../SRC/image/Logo_ALQUIMIA.png" alt="Alquimia Taverna" class="logo-unipampa" />
            </a>

            <nav class="nav-menu" aria-label="Navegação principal">

                <a class="nav-btn" href="adm_menu.php">MENU</a>
                <span class="nav-divider">|</span>
                <a href="../config/verif_logout.php" class="nav-btn btn-entrar">SAIR</a>
            </nav>
        </div>
    </header>


    <!-- CONTÉUDO CENTRAL -->
    <main class="content-area">
       
        <!-- TÍTULOS -->
        <div class="title-block">
            <h2><strong>CONTROLE DE FORNECEDORES</strong></h2>
            <h4>SISTEMA DE GESTÃO DE ESTOQUE</h4>
        </div>


        <!--BOX COM TABELA -->
        <div class="table-container">
            <form action="../config/config_pesquisa.php" method="POST" class="form">
                <input type="text" class="campo-pesquisa" placeholder="NOME | SOBRENOME | CPF | E-MAIL" name="pesquisa" id="pesquisa">
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
    </main>
</body>

</html>