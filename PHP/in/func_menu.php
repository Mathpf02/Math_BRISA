<?php
// Verifica se o usuário logado é um FUNCIONÁRIO
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['funcao'] != 'funcionario') {
    // header('Location: sist_login.php');
    // exit();
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
    <header class="navbar">
        <a class="nav-logo-link" href="https://unipampa.edu.br/portal/" target="_blank" rel="noopener">
            <img src="../../SRC/image/Logo_UNIPAMPA.png" alt="UNIPAMPA" class="nav-logo">
        </a>

        <a class="nav-logo-link" href="../../index.html" aria-label="Alquimia Taverna">
            <img src="../../SRC/image/Logo_ALQUIMIA.png" alt="Alquimia Taverna" class="nav-logo alquimia">
        </a>
    </header>

    <!-- Conteúdo central -->
    <main class="content-area">
        <!-- Títulos (como no design original: centralizados) -->
        <div class="title-block">
            <h2><strong>MENU DE PRODUTOS</strong></h2>
            <h4>SISTEMA DE GESTÃO DE ESTOQUE</h4>
        </div>

        <!-- Box com o botão -->
        <div class="box">

            <a href="produtos.php" class="menu-button">
                <img src="../../SRC/image/icons/15-icon.png" alt="" class="menu-icon-img" aria-hidden="true">
                <strong><span>PRODUTOS</span></strong>
            </a>

        </div>
    </main>
</body>

</html>