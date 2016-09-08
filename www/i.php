<?php
$to      = 'cos.palip@yandex.ru';
$subject = 'the subject';
$message = 'hello makewear.com.ua test send mail OK';
$headers = 'From: sales@makewear.com.ua' . "\r\n" .
            'Reply-To: cos.palip@yandex.ru' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>
