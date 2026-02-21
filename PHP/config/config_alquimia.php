<?php
    //Configurações de conexão com o banco de dados
    $dbhost = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "mydb";
    
    //Realiza a conexao com o banco de dados
    $conexao = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);
    //Verifica se a conexao foi bem sucedida
    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }
?>

