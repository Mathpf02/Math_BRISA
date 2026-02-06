<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestão de Estoque</title>
    <link rel="stylesheet" href="style_LOGIN.css">
</head>

<body>
    <header class="site-header">
        <a class="unipampa-link" href="https://unipampa.edu.br/portal/" target="_blank" rel="noopener">
            <img src="../../IMAGE/Logo_UNIPAMPA.png" alt="UNIVERSIDADE FEDERAL DO PAMPA - UNIPAMPA" class="unipampa-logo">
        </a>
    </header>

    <div class="page-center">
        <div class="container">
            <div class="login-section">
                <div class="title-block">
                    <strong>
                        <h2>INÍCIAR SESSÃO</h2>
                    </strong>
                    <h4>SISTEMA DE GESTÃO DE ESTOQUE</h4>
                </div>

                <button class="google-btn" type="button">
                    <img src="../../IMAGE/Logo_GOOGLE.png" alt="Logo_GOOGLE" class="google-logo">
                    <strong>ACESSAR COM GOOGLE</strong>
                </button>
            </div>
            </br>

            <h4>ENTRE COM SEU USUÁRIO E SENHA</h4>

            <form action="../veri_alquimia.php" method="POST">
                <div class="input-wrap user">
                    <input type="email" name="email" placeholder="E-MAIL / OU USUÁRIO" required>
                </div>

                <div class="input-wrap lock">
                    <input type="password" name="senha" placeholder="SENHA" required>
                </div>

                <span class="esquecer">Esqueceu a senha? <a href="t_recuperar.php"><strong>Recuperar Senha</strong></a></span>

                <button type="submit"><strong>ENTRAR</strong></button>
            </form>
        </div>

        <div class="branding-section">
            <img src="../../IMAGE/Logo_ALQUIMIA.png" href="../../index.html" alt="ALQUÍMIA TAVERNA" class="emblem">
        </div>
    </div>
    </div>
</body>

</html>