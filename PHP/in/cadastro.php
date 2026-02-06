<?php
if (isset($_POST['submit'])) {

    /*VERIFICAÇÃO DE DADOS NO FORMULÁRIO
    print_r("nome <br>" . $_POST['nome']);
    print_r("sobrenome <br>" . $_POST['sobrenome']);
    print_r("telefone <br>" . $_POST['telefone']);
    print_r("cpf <br>" . $_POST['cpf']);
    print_r("copia_cpf <br>" . $_POST['copia_cpf']);
    print_r("email <br>" . $_POST['email']);
    print_r("senha <br>" . $_POST['senha']);
    */

    include_once('../config_alquimia.php');

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $copia_cpf = $_POST['copia_cpf'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $result = mysqli_query ($conexao, "INSERT INTO func_alquimia(nome,sobrenome,telefone,cpf,copia_cpf,email,senha) 
        VALUES ('$nome','$sobrenome','$telefone','$cpf','$copia_cpf','$email','$senha')");
    header('Location: login.php');
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/style_LOGIN.css" />
    <title>Alquimia Taverna</title>
</head>

<body>
    <div class="header">
        <strong>
            <h2>CADASTRO DE FUNCIONÁRIO</h2>
        </strong>
        <h3>SISTEMA DE GESTÃO DE ESTOQUE</h3>
    </div>
    <div class="container">
        <form method="POST" action="cadastro.php" class="form">

            <input type="text" name="nome" id="nome" placeholder="NOME" required />
            <br />
            <br />
            <input type="text" name="sobrenome" id="sobrenome" placeholder="SOBRENOME" required />
            <br />
            <br />
            <input type="text" name="telefone" id="telefone" placeholder="TELEFONE" required />
            <br />
            <br />
            <input type="text" name="cpf" id="cpf" placeholder="CPF" required />
            <br />
            <br />
            <input type="file" name="copia_cpf" id="copia_cpf" placeholder="CÓPIA DA IDENTIDADE" required />
            <br />
            <br />
            <input type="email" name="email" id="email" placeholder="E-MAIL" required />
            <br />
            <br />
            <input type="password" name="senha" id="senha" placeholder="SENHA" required />
            <br />
            <br />
            <br />

            <button type="submit" name="submit" id="submit">CADASTRAR</button>


        </form>
</body>

</html>