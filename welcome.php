<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Aqui você pode exibir uma mensagem de boas-vindas ou conteúdo personalizado
echo "Bem-vindo, usuário!";
?>
