<?php

    $dbhost = "localhost";
    $dbusername = "root";
    $dbpassword = "";

    $dbname = "alquimia_taverna";
        $conexao = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
   
    /*TESTE DE CONEXAO
    if ($conexao->connect_errno) {
        echo "Erro na conexao: " ;
    }else {
        echo "Conexao bem sucedida!";
    }   
    */

?>

