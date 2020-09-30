<?php
function mailto($from, $fromname, $to, $toname, $subject, $body) {
    $mail = '';
    include_once ("mailer.php");
    $mail->setFrom($from, $fromname);
    $mail->addAddress($to, $toname);
    $mail->Subject = $subject;
    $mail->msgHTML($body);
    if (!$mail->send()) {
        //failed
        
    } else {
        // message sent;
        
    }
}
?>