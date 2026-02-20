<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha - Sistema de Gestão de Estoque</title>
  <link rel="stylesheet" href="style_RECUPERAR.css">
</head>

<body>

  <!-- NAVBAR (UNIPAMPA + ALQUIMIA) -->
  <header class="navbar">
    <a class="nav-logo-link" href="https://unipampa.edu.br/portal/" target="_blank">
      <img src="../../IMAGE/Logo_UNIPAMPA.png" alt="UNIVERSIDADE FEDERAL DO PAMPA - UNIPAMPA" class="nav-logo">
    </a>

    <a class="nav-logo-link" href="./../index.html" aria-label="Alquimia Taverna">
      <img src="../../IMAGE/Logo_ALQUIMIA.png" alt="ALQUIMIA TAVERNA" class="nav-logo alquimia">
    </a>
  </header>

  <!-- CONTEÚDO CENTRAL -->
  <main class="content-area">

    <div class="title-block">
      <h2><strong>ESQUECEU SUA SENHA ?</strong></h2>
      <h4>SISTEMA DE GESTÃO DE ESTOQUE</h4>
    </div>
    </br>
    </br>

    <!-- BOX DO FORMULÁRIO -->
    <div class="box">

      <p class="explanatory-text">
        Para recuperar sua senha, informe seu <strong> CPF e E-MAIL </strong> cadastrado.
        Um link de recuperação será enviado para o seu e-mail.
      </p>

      <form action="enviar_recuperacao.php" method="POST">

        <div class="input-wrap user">
          <input type="text" name="cpf" placeholder="CPF" required>
        </div>

        <div class="input-wrap user">
          <input type="email" name="email" placeholder="E-MAIL" required>
        </div>

        <button type="submit" class="primary-btn"><strong>ENVIAR</strong></button>

        <span class="back-link">Voltar para o login? <a href="t_login.php"><strong>Voltar</strong></a></span>
      </form>

    </div>
  </main>

</body>

</html>