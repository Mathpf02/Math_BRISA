<?php
require_once('common.php');
// A única verificação opcional é se o usuário está logado, 
// mas mesmo que não esteja, o comando abaixo funcionará sem erros.

$_SESSION = array(); // Limpa as variáveis na memória

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy(); // Encerra a sessão no servidor

header("Location: ../in/sist_login.php"); // Redireciona para o login
exit();

?>
