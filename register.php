<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar se o email já existe
    $stmtCheckEmail = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmtCheckEmail->execute([$email]);
    $existingEmail = $stmtCheckEmail->fetch(PDO::FETCH_ASSOC);

    // Verificar se o usuário já existe
    $stmtCheckUsername = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmtCheckUsername->execute([$username]);
    $existingUsername = $stmtCheckUsername->fetch(PDO::FETCH_ASSOC);

    if ($existingEmail) {
        // Exibir uma mensagem de alerta em JavaScript se o email já existir
        echo '<script>alert("Este email já está registrado. Por favor, use outro email.");';
        echo 'window.location.href = "register.html";</script>';
        exit(); // Certifique-se de sair para evitar a execução adicional do código PHP
    } elseif ($existingUsername) {
        // Exibir uma mensagem de alerta em JavaScript se o usuário já existir
        echo '<script>alert("Este nome de usuário já está em uso. Por favor, escolha outro nome de usuário.");';
        echo 'window.location.href = "register.html";</script>';
        exit();
    } else {
        // Inserir novo usuário se o email e usuário não existirem
        $stmtInsertUser = $pdo->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
        $stmtInsertUser->execute([$name, $email, $username, $password]);

        echo "Usuário registrado com sucesso! Redirecionando para a página de login...";
        
        // Redirect to the login page after successful registration
        header('Location: login.html');
        exit(); // Ensure that no further code is executed after the redirect
    }
}
?>
