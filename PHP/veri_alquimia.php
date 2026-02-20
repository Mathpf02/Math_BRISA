<?php
include_once "config_alquimia.php";
session_start(); //Inicia a sessão

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Protege contra XSS e SQL Injection
    $email = htmlspecialchars(trim($_POST['email']));
    $senha = htmlspecialchars(trim($_POST['senha']));

    // Verifica se os campos estão preenchidos
    if (empty($email) || empty($senha)) {
        $_SESSION['erro'] = "PREENCA TODOS OS CAMPOS !";
        header("Location: in/sist_login.php?erro=naoPreenchido");
        exit();
    }


    // Prepara a consulta para buscar o usuário pelo email
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $sqlteste = "SELECT * FROM usuarios";
    $stmt2 = mysqli_prepare($conexao, $sqlteste);
    mysqli_stmt_execute($stmt2);
    $resultado_teste = mysqli_stmt_get_result($stmt2);
    $usuarios = mysqli_fetch_all($resultado_teste, MYSQLI_ASSOC);
    foreach ($usuarios as $usuario) {
        echo "ID: " . $usuario['id_usuario'] . " - Nome: " . $usuario['nome'] . " - Email: " . $usuario['email'] . " - Senha: " . $usuario['senha'] . " - Função: " . $usuario['funcao'] . "<br>";
        //compara emails e senhas]
        $emailCerto = $usuario['email'];
        $senhaCerto = $usuario['senha'];
        if ($email == $usuario['email'] && $senha == $usuario['senha']) {
            echo 'logado';
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['funcao'] = $usuario['funcao'];
            if ($usuario['funcao'] == 'admin') {
                header("Location: in/adm_menu.php");
            } else if ($usuario['funcao'] == 'funci') {
                header("Location: in/func_menu.php");
            }
        } else {
            echo 'credencial errada <br>';
            echo "$email != $emailCerto <br>";
            echo "$senha != $senhaCerto <br>";
        }
    }
}
