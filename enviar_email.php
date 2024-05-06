<?php

ini_set("SMTP", "smtp.example.com");
ini_set("smtp_port", "587");
ini_set("sendmail_from", "vitor.eg90@gmail.com");
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define as variáveis para o e-mail
    $para = "vitor.eg90@gmail.com"; // Substitua pelo seu endereço de e-mail
    $assunto = $_POST['subject'];
    $mensagem = $_POST['message'];
    $remetente = isset($_POST['email']) ? $_POST['email'] : 'sememail@dominio.com'; // Pega o e-mail do remetente ou define um padrão
    
    // Monta o cabeçalho do e-mail
    $headers = "From: $remetente\r\n"; // Definindo o cabeçalho "From:"
    $headers .= "Reply-To: $remetente\r\n"; // Definindo o cabeçalho "Reply-To:"
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Envia o e-mail
    if (mail($para, $assunto, $mensagem, $headers)) {
        echo "<script>alert('E-mail enviado com sucesso!');</script>";
    } else {
        echo "<script>alert('Ocorreu um erro ao enviar o e-mail. Por favor, tente novamente mais tarde.');</script>";
    }
}
?>
