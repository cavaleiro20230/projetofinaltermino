<?php
require_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login bem-sucedido, armazenar o ID do usuário na sessão
        $_SESSION['user_id'] = $user['id'];

        // Redirecionar para a página de boas-vindas
        header("Location: https://appturismo2023.netlify.app/");
        exit();
    } else {
        // Exibir um alerta em caso de usuário ou senha incorretos
        echo "<script>alert('Usuário ou senha incorretos.');";
        echo "window.location.href = 'login.html';</script>";
    }
}
?>
