<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

$data = $_POST;

function sendEmails($data) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.mailosaur.net'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'qf3ctqlu@mailosaur.net'; 
        $mail->Password = 'h2cmL8UJoC0yoUILicOEFVee9IBvSfbN'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->SMTPDebug = 2; 

        $mail->setFrom('qf3ctqlu@mailosaur.net', 'Loja Magica');
        $mail->Subject = $data["email_subject"];
        $mail->Body = $data["email_body"];
        $mail->isHTML(true);

        if (is_string($data['emails'])) 
            $data['emails'] = json_decode($data['emails'], true);

        if (is_array($data['emails'])) 
            foreach ($data['emails'] as $email) 
                $mail->addAddress($email);

        if ($mail->send()) 
            echo "Emails enviados com sucesso!";
         else 
            echo "Falha ao enviar emails.";
        
    } catch (Exception $e) {
        echo "Erro ao enviar email: " . $mail->ErrorInfo;
    }
}

sendEmails($data);
