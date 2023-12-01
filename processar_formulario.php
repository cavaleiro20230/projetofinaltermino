<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    // Substitua com suas configurações de e-mail
    $to = "seu_email@example.com";
    $subject = "Nova mensagem de contato";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Envia o e-mail
    mail($to, $subject, $message, $headers);

    // Redireciona de volta para a página de contato
    header("Location: index.html");
} else {
    // Se alguém tentar acessar este script diretamente, redireciona para a página de contato
    header("Location: index.html");
}
?>
