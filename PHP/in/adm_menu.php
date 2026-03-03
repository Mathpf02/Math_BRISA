<?php
// Verifica se o usuário logado é um FUNCIONÁRIO
require_once('../config/common.php');
if (!eh_administrador()) {
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
  <link rel="stylesheet" href="style_MENU.css" />
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

  <!-- Conteúdo central -->
  <main class="content-area">
    <!-- Títulos (como no design original: centralizados) -->
    <div class="title-block">
      <h2><strong>MENU DE GESTÃO</strong></h2>
      <h4>SISTEMA DE GESTÃO DE ESTOQUE</h4>
    </div>

    <!-- Box com os botões -->
    <div class="box">
      <?php
      if (eh_administrador()): ?>
        <a href="adm_funcionario.php" class="menu-button">
          <img src="../../SRC/image/icons/10-icon.png" alt="" class="menu-icon-img" aria-hidden="true">
          <strong><span>FUNCIONÁRIOS</span></strong>
        </a>
        <a href="adm_fornecedor.php" class="menu-button">
          <img src="../../SRC/image/icons/4-icon.png" alt="" class="menu-icon-img" aria-hidden="true">
          <strong><span>FORNECEDOR</span></strong>
        </a>
        <a href="relatorios.php" class="menu-button">
          <img src="../../SRC/image/icons/22-icon.png" alt="" class="menu-icon-img" aria-hidden="true">
          <strong><span>RELATÓRIOS</span></strong>
        </a>

      <?php endif; ?>

      <a href="produtos.php" class="menu-button">
        <img src="../../SRC/image/icons/15-icon.png" alt="" class="menu-icon-img" aria-hidden="true">
        <strong><span>PRODUTOS</span></strong>
      </a>

    </div>
  </main>
</body>

</html>