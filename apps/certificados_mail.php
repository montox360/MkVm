<?php
require '../PHPClass/PHPMailerAutoload.php';


function createMail($marca, $cliente, $contactos, $idioma, $certificado, $factura){
$mail = new PHPMailer;
$certificado = "http://mkgalena.puntoip.info/docs_ma/".$certificado;
$factura = "http://mkgalena.puntoip.info/docs_ma/".$factura;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mkmarcas.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;   			// Enable SMTP authentication
$mail->SMTPDebug = 0;       
$mail->Debugoutput = 'html';                    
$mail->Username = 'publicaciones_boletin@mkmarcas.com';                 // SMTP username
$mail->Password = 'Nightfire123!';                           // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;  
$mail->CharSet = 'UTF-8';                                  // TCP port to connect to

$mail->setFrom('exterior@mkmarcas.com', 'Montoya, Kociecki & Asociados');
$arr = explode(',',str_replace(' ', '', $cliente['ClienteMail']));
if($idioma==1)
{
    $mail->addStringAttachment(file_get_contents($certificado), "M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT).".pdf");
    $mail->addStringAttachment(file_get_contents($factura), "Nota Debito.pdf");
}
else
{
    $mail->addStringAttachment(file_get_contents($certificado), "M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT).".pdf");
    $mail->addStringAttachment(file_get_contents($factura), "Debit Note.pdf");
}

//$mail->addAddress("montox360@gmail.com");
//$mail->addAddress("amontoya@mkmarcas.com");

foreach ($arr as $value)
{
	if($value != '' || $value != ' ')
    $mail->addAddress($value); 
}

$conarr = explode(',', str_replace(' ', '', $contactos[$marca['Codigo']]));

foreach($conarr as $contac){
    $mail->addAddress($contac);
}
$mail->addReplyTo('exterior@mkmarcas.com', 'Montoya, Kociecki & Asociados');
$mail->addBCC('publicaciones_boletin@mkmarcas.com');
// Add a recipient
//$mail->addAddress('lmontoya@mkmarcas.com');
    //$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]);

$mail->isHTML(true);                                  // Set email format to HTML


if($idioma==2){
$mail->Subject = "CERTIFICATE OF REGISTRATION, Trademark: ".$marca['NombreMarca']." - Appln No. ".$marca['Solicitud']." in Class ".$marca['ClaseInt'].", in Venezuela o/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}else{
	$mail->Subject = "CERTIFICADO DE REGISTRO, Marca: ".$marca['NombreMarca']." - Inscripción No. ".$marca['Solicitud']." , en Clase ".$marca['ClaseInt']."
 en Venezuela, n/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT);
}

if($idioma==2)
{

$mail->Body ="<body style='font-family:sans-serif'><p align=\"right\">Caracas, March 07, 2016.</p>
Messrs<br>
<b>".$cliente['ClienteNombre']."</b><br>
".$cliente['ClienteDireccion']."<br>
".$cliente['ClientePais']."<br>
Phone(s): ".$cliente['ClienteTelefono'].", Fax: ".$cliente['ClienteFax']."<br>
e-mail: ".$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."<br>
<br>
Re: ".$marca['Propietario']."<br>
&nbsp; &nbsp; &nbsp; Trademark:&nbsp;<b>".$marca['NombreMarca']."</b><br>
&nbsp; &nbsp; &nbsp; Application No. ".$marca['Solicitud'].", in Int Class&nbsp;".$marca['ClaseInt'].",(local class ".$marca['ClaseLocal'].") in&nbsp;Venezuela<br>
&nbsp; &nbsp; &nbsp; o/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT)."<br>
<br>
Status:&nbsp;<b>REGRISTRATION</b><br>
<br>
<b>Important:&nbsp;</b>REGISTRATION<br>
<br>
Dear Sirs:<br>
<div align=\"justify\">
Please be informed that the Trademark Office has issued the certificate of registration for the trademark quoted in the reference.<br>
<br>
For your information, the trademark office, lately, has been issuing the certificates as already signed and stamped digital copies. That is the reason that we are no longer sending the physical original copy of the certificate, thus we are not charging the DHL Courier fee in our debit note<br> 
<br>
In case you wish to obtain the physical copy of the certificate we could make a quality print of the certificate and send it to your offices, but it would incurr in Courier expenses.<br>
<br>
Please find attached the Certificate of Registration, along with our debit note regarding the obtention of the certificate and our surveillance service for the next 15 years.<br>
<br>
This trademark will remain in force for a period of 15 years from its granting date.<br>
<br>
Best regards,<br>
<br>
Luis Carlos Montoya<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div></body>
";}

/*Dear Sirs:<br>
<div align=\"justify\">Please be advised that, the renewal of the registration stated in the reference should be effected before the deadline mentioned above.<br>
<br>
In case you wish to proceed with the renewal of the trademark, the costs for this service are as follows:<br>
<br>
1.- US$ 2412.86 (Renewal Tax + Bank charges). *<br>
&nbsp;&nbsp;&nbsp;* This amount should be wired at least 30 days before the deadline directly to the PTO account.<br>
2.- US$ 385.00 (Service Charges + Official Fees)<br>
<br>
The information to proceed with the Renewal Tax wire-transfer is as follows:<br>
<br>
Beneficiary: Banco Bicentenario del Pueblo de la Clase Obrera, Mujer y Comunas, Banco Universal C.A<br>
Account No.: 36252699<br>
Beneficiary Physical Address:<br>
Av. Venezuela, Urb. El Rosal, Edificio Banco Bicentenario, Caracas - Venezuela<br>
Beneficiary Bank: CITIBANK<br>
ABA No.: 021000089&nbsp;/&nbsp;SWIFT: CITIUS33XXX<br>
Address of the bank: NEW YORK, USA<br>
Beneficiary Instructions:<br>
Credit to SAPI account. Foreign Currency. No. 0175-0473-81-0073423-544. Renewal - Registration. No. ".$marca['Registro']."<br> 
<br>
Once the Renewal Tax amount has been transfered to the PTO's Account, you must send us the transfer receipt, 
so we can file it at the PTO in order for the trademark Office to confirm the payment and emit the official invoice.<br>
<br>
Should we not receive an explicit answer ordering said renewal, we will consider that you are not interested
in the trademark and we will proceed to eliminate this case from our files.<br>
<br>
Best regards.<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div>";
*/
else{
$mail->Body    ="<body style='font-family:sans-serif'><p align=\"right\">Caracas, Marzo 07, 2016.</p> 
Se&ntilde;ores<br>
<b>".$cliente['ClienteNombre']."</b><br>
".$cliente['ClienteDireccion']."<br>
".$cliente['ClientePais']."<br>
Tlf(s): ".$cliente['ClienteTelefono'].", Fax: ".$cliente['ClienteFax']."<br>
e-mail: ".$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."<br>
<br>
Ref:  ".$marca['Propietario']."<br>
&nbsp; &nbsp; &nbsp; Marca:&nbsp;<b>".$marca['NombreMarca']."</b><br>
&nbsp; &nbsp; &nbsp; Inscripci&oacute;n No. ".$marca['Solicitud']."; en Clase Internacional&nbsp;".$marca['ClaseInt'].", en Venezuela<br>
&nbsp; &nbsp; &nbsp; n/ref: M".str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT)."<br>  
<br>
Estado actual: &nbsp;<b>REGISTRO</b><br>
<br>
Estimados se&ntilde;ores:<br>
<div align=\"justify\">
<br>
Por  medio  de  la  presente,  les  informamos que el certificado de registro para la marca citada en la referencia ha sido emitido.<br>
<br>
La oficina de Marcas en Venezuela ha estado emitiendo durante éste año los certificados de registro de manera digital, esta copia digital ya viene directamente sellada y firmada por la oficina de Marcas. Es por esto que no estamos enviando copias fisicas del certificado a sus oficinas y no estamos cargando los gastos de envío de correo especial en nuestras facturas<br>
<br>
En caso de que usted requiera una copia fisica del certificado, nosotros procederíamos a hacer una impresión de calidad del documento anexo, y procederíamos a enviarlo a sus oficinas vía correo especial, lo cual incurriría en gastos por envío.<br>
<br>
Este caso se mantendrá en vigencia por los próximos 15 años, desde su fecha de concesión.
<br>
Encuentre anexa la emisión digital del certificado de registro junto con nuestra factura por servicios de obtención del certificado y vigilancia del caso por los próximos 15 años.<br>
<br>
Sin más a que hacer mención, les saludamos,<br>
<br>
Atentamente,<br>
<br>
Luis Carlos Montoya<br>
MONTOYA, KOCIECKI & ASOCIADOS.</div></body>";}


$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    return "Error";
} else {
	return "Ok";
    //echo 'e No.: M'.str_pad($marca['Codigo'], "6", "0", STR_PAD_LEFT).' has been sent to '.$cliente['ClienteMail'].", ".$contactos[$marca['Codigo']]."</br>";
}
}
 
function sendMail($mail){
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}