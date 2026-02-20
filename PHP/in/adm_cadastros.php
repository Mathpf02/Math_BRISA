<?php
// inicia a sessão
session_start();


// Verifica se o usuário logado é um ADMINISTRADOR
if (!isset($_SESSION['id_usuario']) || $_SESSION['funcao'] != 'admin') {
    header('Location: sist_login.php');
    exit();
}

if (isset($_POST['submit'])) {
    // Inclui o arquivo de configuração para conexão com o banco de dados
    include_once('../config_alquimia.php');

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $funcao = $_POST['funcao'];

    // --- LÓGICA DE VERIFICAÇÃO E RENOMEAÇÃO DE ID ---
    // Verifica se existe o usuário '0' que causa o conflito
    $check_admin = mysqli_query($conexao, "SELECT id_usuario FROM usuarios WHERE id_usuario = 0");
    
    if (mysqli_num_rows($check_admin) > 0) {
        // Se existir, move ele para o ID mais alto + 1 para liberar o auto-incremento
        $move_sql = "UPDATE usuarios SET id_usuario = (SELECT MAX(id_usuario) + 1 FROM (SELECT id_usuario FROM usuarios) AS t) WHERE id_usuario = 0";
        mysqli_query($conexao, $move_sql);
    }

    $sql = "INSERT INTO usuarios (cpf, nome, sobrenome, email, senha, funcao) 
    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    if ($stmt) {
        // "ssssss" vincula as 6 variáveis como strings
        mysqli_stmt_bind_param($stmt, "ssssss", $cpf, $nome, $sobrenome, $email, $senha, $funcao);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: adm_funcionarios.php');
            exit();
        } else {
            echo "Erro ao executar o cadastro: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação do banco de dados: " . mysqli_error($conexao);
    }
}

?>

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
            <h2>CADASTRO DE FUNCIONÁRIO</h2>
        </strong>
        <h3>SISTEMA DE GESTÃO DE ESTOQUE</h3>
    </div>
    <div class="container">
        <form method="POST" action="adm_cadastros.php" class="form">

            <input type="text" name="nome" id="nome" placeholder="NOME" required />
            <br />
            <br />
            <input type="text" name="sobrenome" id="sobrenome" placeholder="SOBRENOME" required />
            <br />
            <br />
            <input type="text" name="cpf" id="cpf" placeholder="CPF" required />
            <br />
            <br />
            <input type="email" name="email" id="email" placeholder="E-MAIL" required />
            <br />
            <br />
            <input type="password" name="senha" id="senha" placeholder="SENHA" required />
            <br />
            <br />
            <select name="funcao" id="funcao" required>
                <option value="">SELECIONE A FUNÇÃO</option>
                <option value="admin">ADMINISTRADOR</option>
                <option value="funci">FUNCIONÁRIO</option>
            </select>
            <br />
            <br />
            <br />

            <button type="submit" name="submit" id="submit">CADASTRAR</button>


        </form>
</body>

</html>