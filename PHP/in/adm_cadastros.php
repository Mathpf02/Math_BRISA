<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_LOGIN.css" />
    <title>Alquimia Taverna</title>
</head>

<body>
    <div class="header">
        <strong>
            <h2>CADASTRO DE USUÁRIOS</h2>
        </strong>
        <h3>SISTEMA DE GESTÃO DE ESTOQUE</h3>
    </div>
    <div class="container">
        <form action="../config/config_cadastro.php" method="POST" class="form">
            <input type="text" name="nome" id="nome" placeholder="NOME" required />
            <input type="text" name="sobrenome" id="sobrenome" placeholder="SOBRENOME" required />
            <input type="text" name="cpf" id="cpf" placeholder="CPF" required />
            <input type="email" name="email" id="email" placeholder="E-MAIL" required />
            <input type="password" name="senha" id="senha" placeholder="SENHA" required />
            <br />

            <select name="funcao" id="funcao" required>
                <option value="">NÍVEL DE ACESSO</option>
                <option value="administrador">ADMINISTRADOR</option>
                <option value="funcionario">FUNCIONÁRIO</option>
            </select>

            <button type="submit" name="submit" id="submit"><strong>CADASTRAR</strong></button>
        </form>
    </div>

</body>

</html>