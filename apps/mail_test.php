<?php
require '../PHPClass/PHPMailerAutoload.php';


$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mkmarcas.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;   			// Enable SMTP authentication
$mail->SMTPDebug = 0;       
$mail->Debugoutput = 'html';                    
$mail->Username = 'renewals@mkmarcas.com';                 // SMTP username
$mail->Password = 'Nightfire123!';                           // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('renewals@mkmarcas.com', 'Mailer');
$mail->addAddress('montox360@gmail.com', 'Luis Carlos'); 
$mail->addAddress('amontoya@montoyacabrera.com', 'Angelica Montoya');    // Add a recipient
$mail->addReplyTo('exterior@mkmarcas.com', 'Renovaciones Exterior');
$mail->addCC('renewals@mkmarcas.com');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Esta es la segunda prueba probando multiples destinatarios';
$mail->Body    = '<h1>Prueba 2</h1><br>Keka esto es una prueba del sistema de envios automaticos probando multiples <b>destinatarios!</b><br>
<p>Por favor chequea que al momento de darle REPLY te aparezca la direccion de exterior en vez de esta cuenta de renewals@mkmarcas.com';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}