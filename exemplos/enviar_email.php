<?php
// Importar o phpMailer
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Instancia a classe PHPMailer com as credenciais do email:
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = 'rober.flexxo@gmail.com';
$mail->Password = 'Flexxo@2018';
$mail->Port = 587;

// seta parametros para envio do email
// Remetente
$mail->setFrom('rober.flexxo@gmail.com', 'Rober Flexxo');

// Adiciona emails para enviar
$mail->addAddress('roberzguerra@gmail.com', 'Rober Guerra');
//$mail->addAddress('email2@email.com.br', 'Nome da pessoa 2');
// Adiciona na linha Com Copia
//$mail->addCC('email_copia@email.com.br', 'Nome da pessoa Cópia');
// Adiciona na linha Com Copia Oculta
//$mail->addBCC('email@email.com.br', 'Nome da pessoa com cópia oculta');


// Cria o corpo do email
// True usa HTML no corpo do email, False usa somente texto.
$mail->isHTML(true);
// Assunto do email
$mail->Subject = 'Email Teste';
// Corpo do email
$mail->Body = "Corpo do email com <strong> HTML </strong>.";
// Texto exibido acima do corpo do email
//$mail->AltBody = 'texto acima do corpo';
// Adiciona anexos
//$mail->addAttachment('/tmp/image.jpg', 'nome.jpg');

if($mail->send()) {
    echo 'Mensagem enviada.';
} else {
    echo 'Não foi possível enviar a mensagem.<br>';
    echo 'Erro: ' . $mail->ErrorInfo;
}