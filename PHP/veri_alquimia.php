<?php
//print_r($_REQUEST);

//verifica se o botão foi clicado e se os campos não estão vazios
if (isset($_REQUEST['submit']) && !empty($_REQUEST['email'] && !empty($_REQUEST['senha']))) {

    //acesso
    include_once('config_alquimia.php');
    $email = $_REQUEST['email'];
    $senha = md5($_REQUEST['senha']);
    //print_r('E-mail: '.$email .'<br>');
    //print_r('Senha: '.$senha);

    $sql = "SELECT * FROM func_alquimia WHERE email = '$email'";
    $result = $conexao->query($sql);
    //print_r($sql . '<br>');
    //print_r($result);
    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            if ($user_data['senha'] == $senha) {
                //print_r('Senha correta! <br>');
                session_start();
                $_SESSION['usuario_id'] = $user_data['id'];
                $_SESSION['usuario_nome'] = $user_data['nome'];
                $_SESSION['usuario_sobrenome'] = $user_data['sobrenome'];
                $_SESSION['usuario_email'] = $user_data['email'];
            }
        }
    }

    if (mysqli_num_rows($result) < 1) {
        print_r('USUÁRIO NÃO LOCALIZADOS! <br>');
        header('Location: in/t_login.php');
    } else {
        print_r('USUÁRIO LOCALIZADO! <br>');
        header('Location: in/t_menu.php');
    }
} else {
    header('Location: in/t_menu.php');
    exit();
}
