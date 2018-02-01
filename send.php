<?php
require_once './loader.php';
require_once './modulos.php';

// Do not edit this if you are not familiar with php
error_reporting (E_ALL ^ E_NOTICE);
$post = (!empty($_POST)) ? true : false;
if($post) {
require_once './plugin/email/email.php';
    global $mail;
    $smtp = new Smtpr();
    $smtp->getSmtp();
    $mail->Port = $smtp->smtp_port;
    $mail->Host = $smtp->smtp_host;
    $mail->Username = $smtp->smtp_username;
    $mail->From = $smtp->smtp_username;
    $mail->Password = $smtp->smtp_password;
    $mail->FromName = $smtp->smtp_fromname;
    $mail->Subject = utf8_decode("Contato Via Site " . $site->site_meta_titulo);
    $mail->AddBCC($smtp->smtp_bcc);
    $mail->AddAddress($smtp->smtp_username);

    $data = date('d/m/Y H:i');
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $mail->AddReplyTo($email);
    $body = "<b>Data da Mensagem: </b> $data <br />";
    $body .= "<b>Nome:</b> $nome <br />";
    $body .= "<b>Telefone:</b> $telefone <br />";
    $body .= "<b>E-mail:</b> $email <br />";
    $body .= "<b>Mensagem: </b>$mensagem <br />";
    $mail->Body = nl2br($body);
}
?>