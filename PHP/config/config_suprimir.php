<?php
require_once ('common.php'); // Para usar eh_adminstrador()
require_once ('config_alquimia.php');

// 1. Segurança: Apenas administradores podem executar esta ação
if (!eh_administrador()) {
    header("Location: ../in/sist_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitização básica do ID

    // 2. Consulta o estado atual do usuário para decidir se vamos Ativar ou Suprimir
    $sql_busca = "SELECT funcao FROM AUTORIZADOS WHERE id_usuario = ?";
    $stmt_busca = mysqli_prepare($conexao, $sql_busca);
    mysqli_stmt_bind_param($stmt_busca, "i", $id);
    mysqli_stmt_execute($stmt_busca);
    $resultado = mysqli_stmt_get_result($stmt_busca);
    $usuario = mysqli_fetch_assoc($resultado);

    if ($usuario) {
        // 3. Lógica de Alternância (Toggle)
        if ($usuario['funcao'] === 'inativo') {
            // Se está inativo, voltamos para 'funcionário' (ou a função padrão do seu sistema)
            $nova_funcao = 'funcionário';
            $_SESSION['msg_status'] = "Usuário REATIVADO com Sucesso!";
        } else {
            // Se está ativo, alteramos para 'inativo'
            $nova_funcao = 'inativo';
            $_SESSION['msg_status'] = "Usuário SUPRIMIDO com sucesso!";
        }

        // 4. Atualiza o banco de dados com a nova função
        $sql_update = "UPDATE AUTORIZADOS SET funcao = ? WHERE id_usuario = ?";
        $stmt_update = mysqli_prepare($conexao, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "si", $nova_funcao, $id);
        mysqli_stmt_execute($stmt_update);
    }
}

// 5. Redireciona de volta para a listagem
header("Location: ../in/adm_funcionario.php");
exit();